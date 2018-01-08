<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::all();

        $data['users'] = User::all()->toArray();
        return view('chat/chat', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|max:255'
        ]);

        $message = new Message();
        $message->text = $request->message;
        $message->user_id = Auth::user()->id;
        $message->save();

        $data['users'] = User::all()->toArray();

        //$data['messages'] = Message::all();
        $data['messages'] = Message::all()->each(function ($item, $key){
            $item['user'] = $item->user->toArray();
            return $item;
        })->toArray();
        // dd($data);
        return view('chat/chat' , $data);
    }
}
