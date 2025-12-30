<?php

namespace App\Http\Controllers\Recruiter;

use App\Events\MessageEvent;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                        'sender_id' => $msg->sender_id,
                        'message' => $msg->message,
                        'attachment' => $msg->attachment,
                        'attachment_name' => $msg->attachment_name,
                        'attachment_extension' => $msg->attachment_extension,
                        'attachment_type' => $msg->attachment_type,
                        'attachment_size' => $msg->attachment_size,
                        'created_at' => $msg->created_at->toDateTimeString(),
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
        try {
            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'message' => 'nullable|string', // message can be empty if attachment is sent
                'attachment' => 'nullable|file|max:10240', // max 10MB, adjust as needed
            ]);

            $attachmentData = null;

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $path = $file->store('attachments', 'public'); // store in storage/app/public/attachments

                $attachmentData = [
                    'attachment' => $path,
                    'attachment_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'attachment_extension' => $file->getClientOriginalExtension(),
                    'attachment_type' => $file->getMimeType(),
                    'attachment_size' => $file->getSize(),
                ];
            }

            $msg = Message::create(array_merge([
                'conversation_id' => $request->conversation_id,
                'sender_id' => auth()->id(),
                'message' => $request->message,
            ], $attachmentData ?? []));

            broadcast(new MessageEvent($msg))->toOthers();

            return response()->json(['status' => 'success', 'message' => $msg]);
        } catch (\Exception $e) {
            Log::error('Error sending message: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
