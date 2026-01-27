<?php

namespace App\Http\Controllers\Recruiter;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with(['sender', 'conversation'])->where('receiver_id', auth()->id())->latest()->get();
        return view('recruiter.offers.index', compact('offers'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $offer = Offer::where('receiver_id', auth()->id())->findOrFail($id);
        $offer->update(['status' => $request->status]);

        // Optional: Send a follow-up message back
        $statusLabel = ucfirst($request->status);
        $message = Message::create([
            'conversation_id' => $offer->conversation_id,
            'sender_id' => auth()->id(),
            'message' => "I have {$request->status} the offer: {$offer->title}",
            'type' => 'text',
        ]);

        broadcast(new MessageEvent($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => "Offer {$request->status} successfully",
        ]);
    }
}
