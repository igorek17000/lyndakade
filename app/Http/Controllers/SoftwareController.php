<?php

namespace App\Http\Controllers;

use App\Course;
use App\LearnPath;
use App\Software;
use App\Subject;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SoftwareController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['search',]]);
    }

    public function software_api()
    {
        $software = Software::get();
        if (!$software) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $software->toArray(),
        ], 200);
    }

    public function set_software_api(Request $request)
    {
        $search_key = $request->get('search_key');
        $search_value = $request->get('search_value');
        if (!$search_key || !$search_value) {
            return new JsonResponse([
                'status' => 'failed',
                'message' => 'no search key was defined',
            ], 404);
        }
        $id = $request->get('id');
        $title = $request->get('title');
        $slug = $request->get('slug');
        $description = $request->get('description');
        $software = Software::where($search_key, $search_value);
        if (count($software->get()) == 0)
            return new JsonResponse([
                'status' => 'failed',
                'message' => 'software' . $slug . 'was not found',
            ], 404);

        if ($title)
            $software->update(['title' => $title]);
        if ($slug)
            $software->update(['slug' => $slug]);
        if ($description)
            $software->update(['description' => $description]);
        if ($id)
            $software->update(['id' => $id]);
        return new JsonResponse([
            'status' => 'success',
            'message' => $slug . ' is updated',
        ], 200);
    }
    public function software_has_api()
    {
        $software = Software::has('courses')->get();
        return new JsonResponse([
            'data' => $software->toArray(),
        ], 200);
    }
}
