<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with(['receiver', 'conversation'])->latest()->get();
        return view('admin.offers.index', compact('offers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'receiver_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $offer = Offer::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'conversation_id' => $request->conversation_id,
            'title' => $request->title,
            'description' => $request->description,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'message' => "I have sent you an offer: {$request->title}",
            'type' => 'offer',
            'offer_id' => $offer->id,
        ]);

        $message->load('offer');

        broadcast(new MessageEvent($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => 'Offer sent successfully',
            'data' => $message->load('offer')
        ]);
    }
}
