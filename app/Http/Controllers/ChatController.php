<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function __construct()
    {
        // Tüm işlemler için oturum kontrolü (giriş yapmış olma) zorunlu kılınır.
        $this->middleware('auth');
    }
    
    public function index()
    {
        return Message::all();
    }

    public function getRooms()
    {
        $rooms = Room::all(); // Tüm odaları alır
        return response()->json($rooms);
    }
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'body' => $request->body,
            'user_id' => Auth::id(), // Oturum açmış kullanıcının ID'sini ekler
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
