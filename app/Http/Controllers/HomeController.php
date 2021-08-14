<?php

namespace App\Http\Controllers;
use Pusher\Pusher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function authenticate(Request $request) {
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;


        $pusher = new Pusher('81eb55255e8fcd908510', 'aa25f36b9d99332db1f0', '1249773', [
            'cluster' => 'eu',
            'encrypted' => true
        ]);

        $presence_data = ['name' => auth()->user()->name];
        $key = $pusher->presenceAuth($channelName, $socketId, auth()->id(), $presence_data);

        return response($key);
    }
}
