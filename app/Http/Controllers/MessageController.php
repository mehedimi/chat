<?php

namespace App\Http\Controllers;

use App\Events\ChatEvent;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    public function index()
    {
    	return view('home');
    }

    public function showMessages()
    {
    	return Message::with('user')->orderBy('id', 'desc')->limit(50)->get();
    }

    public function create(Request $request)
    {
    	$message = $request->user()->messages()->create($request->all());
    	Event::fire(new ChatEvent(array_merge($message->toArray(), ['user' => $request->user()]) ));
    }
}
