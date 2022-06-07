<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\CourseAdded;
use App\Mail\CourseUpdatedMailer;
use App\Paid;
use App\User;
use Exception;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadDataAdded;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VoyagerCourseController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{

    // POST BR(E)AD
    public function update(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof \Illuminate\Database\Eloquent\Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope' . ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = $model->findOrFail($id);
        }

        // Check permission
        $this->authorize('edit', $data);


        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));
        $demanded_users = $request->get('sendMessageToDemandUsers');
        $course = Course::find($data->id);
        if (strlen(trim($demanded_users)) > 0) {
            $demanded_users = explode(",", $demanded_users);
            $users = User::whereIn('id', $demanded_users)->get();
            foreach ($users as $user) {
                $email = $user->email;
                if ($email)
                    Mail::to($email)->send(new CourseAdded($course));
            }
        }

        // set course videos
        $chapters = [];
        try {
            $previewFile = json_decode($course->previewFile)[0]->download_link;
            $course_path = str_replace("/preview.mp4", "", $previewFile);
            $chapters_file = $course_path . "/chapters.json";
            $chapters_file_content = Storage::disk('FTP')->get($chapters_file);
            if (strlen($chapters_file_content) > 0) {
                $chapters = json_decode($chapters_file_content)->chapters;
                foreach ($chapters as $chapter) {
                    foreach ($chapter->videos as $video) {
                        $video->id = create_hashed_data_if_not_exists($course->id . "," . $video->index);
                        $video->path = $course_path . "/" . $video->path;
                        if ($video->sub_fa) {
                            $video->sub_fa = $course_path . "/" . $video->sub_fa;
                        }
                        if ($video->sub_en) {
                            $video->sub_en = $course_path . "/" . $video->sub_en;
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $chapters = [$e->getMessage()];
        }

        Course::where('id', $course->id)->update([
            'sortingDate' => $course->updateDate ? $course->updateDate : $course->releaseDate,
            // 'videos' => json_encode($chapters),
            'videos' => $chapters,
        ]);


        if ($request->get('sendMessageToPaidUsers', false)) {
            $course_id = $data->id;
            $course = Course::find($course_id);
            $paids = Paid::where('type', '1')->where('item_id', $course_id)->get();
            foreach ($paids as $paid) {
                $email = $paid->user->email;
                if ($email)
                    Mail::to($email)->send(new CourseUpdatedMailer($course));
            }
        }

        // if (auth()->user()->can('browse', app($dataType->model_name))) {
        //     $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        // } else {
        //     $redirect = redirect()->back();
        // }

        return response()->json([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);

        // return $redirect->with([
        //     'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
        //     'alert-type' => 'success',
        // ]);
    }


    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        $demanded_users = $request->get('sendMessageToDemandUsers');
        $course = Course::find($data->id);
        if (strlen(trim($demanded_users)) > 0) {
            $demanded_users = explode(",", $demanded_users);
            $users = User::whereIn('id', $demanded_users)->get();
            foreach ($users as $user) {
                $email = $user->email;
                if ($email)
                    Mail::to($email)->send(new CourseAdded($course));
            }
        }

        // set course videos
        $chapters = [];
        try {
            $previewFile = json_decode($course->previewFile)[0]->download_link;
            $course_path = str_replace("/preview.mp4", "", $previewFile);
            $chapters_file = $course_path . "/chapters.json";
            $chapters_file_content = Storage::disk('FTP')->get($chapters_file);
            if (strlen($chapters_file_content) > 0) {
                $chapters = $chapters_file_content;
                $chapters = json_decode($chapters);
                foreach ($chapters as $chapter) {
                    foreach ($chapter->videos as $video) {
                        $video->id = create_hashed_data_if_not_exists($course->id . "-" . $video->index);
                        $video->full_path = $course_path . "/" . $video->path;
                    }
                }
            }
        } catch (Exception $e) {
            // $videos = $e->getMessage();
        }

        Course::where('id', $course->id)->update([
            'sortingDate' => $course->updateDate ? $course->updateDate : $course->releaseDate,
            'videos' => json_encode($chapters),
        ]);


        if (!$request->has('_tagging')) {

            // if (auth()->user()->can('browse', $data)) {
            //     $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            // } else {
            //     $redirect = redirect()->back();
            // }

            return response()->json([
                'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);

            // return $redirect->with([
            //     'message'    => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            //     'alert-type' => 'success',
            // ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
