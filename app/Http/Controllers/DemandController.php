<?php

namespace App\Http\Controllers;

use App\Demand;
use App\Mail\DemandMailer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return RedirectResponse|Response
     */
    public function index()
    {
        return redirect()->route('root.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('demands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $title = $request->get('title');
        $author = $request->get('author');
        $link = $request->get('link');
        $d = null;

        if (!empty($link)) {
            $d = new Demand([
                'link' => $link,
            ]);
            $d->save();
        } else if (!empty($title) && !empty($author)) {
            $d = new Demand([
                'title' => $title,
                'author' => $author,
            ]);
            $d->save();
        } else {
            return back()->with('errors', 'عنوان و مدرس نیاز است. یا لینک درس را وارد کنید.');
        }

        $d->user()->associate(Auth::user());
        $d->save();
        // dd($request, $title, $author, $link, $d);

        // sending email
        $email = env('DEMAND_RECEIVER');
        if ($email)
            Mail::to($email)->send(new DemandMailer($d));
        $email = Auth::user()->email;
        if ($email)
            Mail::to($email)->send(new DemandMailer($d, Auth::user()));

        return redirect()->route('root.home')->with('status', 'درخواست با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
