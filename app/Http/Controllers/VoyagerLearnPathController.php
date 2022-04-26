<?php

namespace App\Http\Controllers;

use App\Course;
use App\LearnPath;
use App\Mail\CourseAdded;
use App\Mail\CourseUpdatedMailer;
use App\Mail\LearnPathAdded;
use App\Mail\LearnPathUpdate;
use App\Paid;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadDataAdded;
use Illuminate\Support\Facades\Mail;

class VoyagerLearnPathController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
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

        // $data->courses = $data->_courses;

        unset($data->_courses);

        // dd($request, $slug, $dataType->editRows, $data);

        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        $path = LearnPath::find($data->id);
        if ($path->users) {
            foreach ($path->users as $user) {
                $email = $user->email;
                if ($email)
                    Mail::to($email)->send(new LearnPathUpdate($path));
            }
        }

        // $total_duration_m = 0;
        $courses_id = [];
        foreach (json_decode($path->courses) as $course) {
            $courses_id[] = $course->id;
            // $total_duration_m += ($course->durationHours * 60) + $course->durationMinutes;
        }
        $total_duration_m = Course::whereIn('id', $courses_id)->sum('durationHours') * 60;
        $total_duration_m += Course::whereIn('id', $courses_id)->sum('durationMinutes');

        $duration_h = (int)($total_duration_m / 60);
        $duration_m = (int)($total_duration_m % 60);

        LearnPath::where('id', $data->id)->update([
            'courses_id' => implode(',', $courses_id),
            'duration_h' => $duration_h,
            'duration_m' => $duration_m,
        ]);

        if ($request->get('sendMessageToPaidUsers', false)) {
            $paids = Paid::where('type', '2')->where('item_id', $data->id)->get();
            foreach ($paids as $paid) {
                $email = $paid->user->email;
                if ($email)
                    Mail::to($email)->send(new LearnPathUpdate($path));
            }
        }
        if (auth()->user()->can('browse', app($dataType->model_name))) {
            $redirect = redirect()->route("voyager.{$dataType->slug}.index");
        } else {
            $redirect = redirect()->back();
        }

        return $redirect->with([
            'message'    => __('voyager::generic.successfully_updated') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
            'alert-type' => 'success',
        ]);
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

        $path = LearnPath::find($data->id);
        if ($path->users) {
            foreach ($path->users as $user) {
                $email = $user->email;
                if ($email)
                    Mail::to($email)->send(new LearnPathAdded($path));
            }
        }

        // $total_duration_m = 0;
        $courses_id = [];
        foreach (json_decode($path->courses) as $course) {
            $courses_id[] = $course->id;
            // $total_duration_m += ($course->durationHours * 60) + $course->durationMinutes;
        }
        $total_duration_m = Course::whereIn('id', $courses_id)->sum('durationHours') * 60;
        $total_duration_m += Course::whereIn('id', $courses_id)->sum('durationMinutes');

        $duration_h = (int)($total_duration_m / 60);
        $duration_m = (int)($total_duration_m % 60);

        LearnPath::where('id', $data->id)->update([
            'courses_id' => implode(',', $courses_id),
            'duration_h' => $duration_h,
            'duration_m' => $duration_m,
        ]);

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new') . " {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
