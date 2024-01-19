<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;


class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('messages');
    }

    //fetches all messages stores in database
    public function fetchMessages()
    {
        $messages = Message::with('user')->orderBy('created_at', 'asc')->get();

        error_log('Messages fetched successfully.');

        return $messages;
    }
    
    //saves message in database
     public function sendMessage(Request $request)
     {
        $user = auth()->user();
        $userName = $user->name;
        $message = $user->messages()->create([
            'message' => $request->input('message'),
            'name' => $userName
        ]);
        $message->save();
        return ['status' => 'Sent'];
    }

    //Deletes specific message
    public function deleteMessage(Message $message)
    {
        $message->delete();
        return response()->json(['status' => 'Deleted']);
    }
}
