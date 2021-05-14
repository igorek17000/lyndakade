<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MyEvent;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Message;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Pusher\Pusher;
use Pusher\PusherException;


class ChatsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return Factory|RedirectResponse|Response|Redirector|View
     */
    public function index()
    {
        if (Auth::check()) {
//        $users = User::where('id', '!=', Auth::id())->get();
            $users = DB::select("select users.id,
                                         users.name,
                                         users.firstName,
                                         users.lastName,
                                         users.email,
                                         users.avatar,
                                         count(is_read) as unread
                                            from users
                                            Left JOIN messages ON
                                                users.id = messages.from
                                                and
                                                is_read = 0
                                                and
                                                messages.to = " . Auth::id() . "
                                                where users.id != " . Auth::id() . "
                                                group by users.id, users.name, users.avatar, users.firstName, users.lastName, users.email");

            return view('admin.index', [
                'users' => $users,
            ]);
        }
        return redirect()->route('root.home');
    }

    public function getMessage($user_id)
    {
        $my_id = Auth::id();

        /*
         * when click to see message selected user's messages will be read, update
         */
        Message::where(['from' => $user_id, 'to' => $my_id])->update(['is_read' => 1]);


        /*
         * getting all message for selected user
         * getting those message which is
         *              from = Auth::id() and to = user_id
         *      OR
         *              from = user_id and from = Auth::id()
         */
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from', $my_id)->where('to', $user_id);
        })->orWhere(function ($query) use ($user_id, $my_id) {
            $query->where('from', $user_id)->where('to', $my_id);
        })->get();

        return view('messages.index', [
            'messages' => $messages,
        ]);
    }

    /**
     * @param Request $request
     * @throws PusherException
     */
    public function sendMessage(Request $request)
    {
        $from = Auth::id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true,
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options,
        );
        $data = ['from' => $from, 'to' => $to];
        $pusher->trigger('my-channel', 'my-event', $data);

//        event(new MyEvent($from, $to, $message));
    }

}
