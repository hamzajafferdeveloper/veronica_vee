<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Log;

class ChatController extends Controller
{
    public function getOrCreateConversation($userId)
    {
        $authId = auth()->id();

        $conversation = Conversation::whereHas('participants', function ($q) use ($authId) {
            $q->where('user_id', $authId);
        })
            ->whereHas('participants', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'type' => 'recruiter_model',
                'created_by' => $authId,
            ]);

            ConversationParticipant::insert([
                ['conversation_id' => $conversation->id, 'user_id' => $authId],
                ['conversation_id' => $conversation->id, 'user_id' => $userId],
            ]);
        }

        return response()->json([
            'conversation_id' => $conversation->id
        ]);
    }

    public function messages(Request $request, $conversationId)
    {
        if ($request->ajax()) {
            $messages = Message::where('conversation_id', $conversationId)
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function ($msg) {
                    return [
                        'id' => $msg->id,
                        'message' => $msg->message,
                        'sender_id' => $msg->sender_id,
                        'time' => $msg->created_at->format('h:i A'),
                    ];
                });

            return response()->json($messages);
        }

        return view('recruiter.chat.index');
    }

    public function index()
    {
        return view('recruiter.chat.index');
    }

    public function getProfessional()
    {
        try {
            return response()->json(
                User::role('professional')->with('model')->get()
            );
        } catch (\Exception $e) {
            Log::error('Error getting professionals: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function send(Request $request)
    {
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string'
        ]);

        $msg = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $msg
        ]);
    }
}
