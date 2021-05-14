<?php

namespace App\Http\Controllers;

use App\Author;
use App\Course;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $authors = Author::all();
        $authors_all = [];

        foreach ($authors as $author) {
            $authors_all[strtoupper(mb_substr($author->name, 0, 1, "UTF-8"))][] = $author;
        }
        ksort($authors_all, SORT_STRING);


        foreach ($authors_all as $key => $auths) {
            $clone = $auths;
            // function cmp($a, $b)
            // {
            //     return strcmp($a["name"], $b["name"]);
            // }
            usort($clone, function ($a, $b) {
                return strcmp($a["name"], $b["name"]);
            });
            $authors_all[$key] = $clone;
        }

        $authors = $authors_all;
        return view('authors.index', compact('authors'));
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($slug)
    {
        $author = Author::all()->where('slug', '=', $slug)->first();
        if ($author) {
            $courses = $author->courses;
            return view('authors.show', [
                'author' => $author,
                'courses' => $courses->take(20),
                'total_courses' => count($courses),
            ]);
        }
        return redirect()->route('authors.index')->with('error', 'Author Not found');
    }

    public function authors_api()
    {
        $authors = Author::get();
        if (count($authors) == 0) {
            return new JsonResponse([
                'data' => []
            ], 404);
        }
        return new JsonResponse([
            'data' => $authors->toArray(),
        ], 200);
    }

    public function authors_has_api()
    {
        $authors = Author::has('courses')->get();
        return new JsonResponse([
            'data' => $authors->toArray(),
        ], 200);
    }

    public function update_api(Request $request, $id)
    {
        $author = Author::where('id', $id);
        if (count($author->get()) == 0) {
            return new JsonResponse([
                'status' => 'failed',
                'message' => 'software' . $author->first()->slug . 'was not found',
            ], 404);
        }
        $description = $request->get('description');
        if ($description) {
            $author->update(['description' => $description]);
        }
        return new JsonResponse([
            'status' => 'success',
            'message' => $author->first()->slug . ' is updated',
        ], 200);
    }
    //
}
