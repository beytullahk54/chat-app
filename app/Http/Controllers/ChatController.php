<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChatController extends Controller
{

    public function __construct()
    {
        // Tüm işlemler için oturum kontrolü (giriş yapmış olma) zorunlu kılınır.
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        return Message::where("room_id","=",$id)->get();
    }
    
    public function room($id)
    {
        return Inertia::render('Dashboard/Room',["id"=>$id]);
    }

    public function getRooms()
    {
        $rooms = Room::all(); // Tüm odaları alır
        return response()->json($rooms);
    }
    public function sendMessage(Request $request,$id)
    {
        $message = Message::create([
            'body' => $request->body,
            'room_id' => $id,
            'user_id' => Auth::id(), // Oturum açmış kullanıcının ID'sini ekler
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
