<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Room;
use Exception;
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
        $user = Auth::user();
    
        // Odayı bul
        $room = Room::find($id);
    
        // Oda bulunamadıysa veya kullanıcı bu odaya erişim yetkisine sahip değilse
        if (!$room || ($user->id !== $room->user_id && !$room->users()->where('user_id', $user->id)->exists())) {
            // Yetkisiz erişim, 403 Forbidden hata sayfası göster
            abort(403, 'Bu odaya erişim yetkiniz yok.');
        }
    
        return Inertia::render('Dashboard/Room',["id"=>$id]);
    }

    public function getRooms()
    {

        $user = Auth::User();

        $rooms = Room::where('user_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
        return response()->json($rooms);
    }

    public function addRoom()
    {
        try{

            $room = new Room();
            $room->save();
    
            return response()->json($room);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
