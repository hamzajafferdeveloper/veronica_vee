<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        return view('admin.chat.index');
    }

    public function getOrCreateConversation($userId)
    {
        try {
            $authId = auth()->id();

            $conversation = Conversation::whereHas('participants', fn($q) => $q->where('user_id', $authId))
                ->whereHas('participants', fn($q) => $q->where('user_id', $userId))
                ->first();

            if (!$conversation) {
                $user = User::findOrFail($userId);
                $type = 'admin_model';
                if ($user->hasRole('recruiter')) {
                    $type = 'admin_recruiter';
                }

                $conversation = Conversation::create([
                    'type' => $type,
                    'created_by' => $authId,
                ]);

                ConversationParticipant::insert([
                    ['conversation_id' => $conversation->id, 'user_id' => $authId],
                    ['conversation_id' => $conversation->id, 'user_id' => $userId],
                ]);
            }

            return response()->json(['conversation_id' => $conversation->id]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['error' => 'Error creating conversation'], 500);
        }
    }

    public function messages(Request $request, $conversationId)
    {
        if ($request->ajax()) {
            $messages = Message::where('conversation_id', $conversationId)
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(fn($msg) => [
                    'id' => $msg->id,
                    'sender_id' => $msg->sender_id,
                    'message' => $msg->message,
                    'attachment' => $msg->attachment,
                    'attachment_name' => $msg->attachment_name,
                    'attachment_extension' => $msg->attachment_extension,
                    'attachment_type' => $msg->attachment_type,
                    'attachment_size' => $msg->attachment_size,
                    'created_at' => $msg->created_at->toDateTimeString(),
                ]);

            return response()->json($messages);
        }

        return view('admin.chat.index');
    }

    public function getUsers()
    {
        try {
            $users = User::role(['recruiter', 'professional'])
                ->with(['recruiter', 'model', 'roles'])
                ->get();

            Log::info('Admin Chat getUsers found: ' . $users->count());

            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('Error getting users: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function send(Request $request)
    {
        try {
            Log::info('Send request received', $request->all());

            $request->validate([
                'conversation_id' => 'required|exists:conversations,id',
                'message' => 'nullable|string',
                'attachment' => 'nullable|file|max:10240',
            ]);

            $attachmentData = null;

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $path = $file->store('attachments', 'public');

                $attachmentData = [
                    'attachment' => $path,
                    'attachment_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'attachment_extension' => $file->getClientOriginalExtension(),
                    'attachment_type' => $file->getMimeType(),
                    'attachment_size' => $file->getSize(),
                ];
            }

            $messageData = [
                'conversation_id' => $request->conversation_id,
                'sender_id' => auth()->id(),
                'message' => $request->message,
            ];

            if ($attachmentData) {
                $messageData = array_merge($messageData, $attachmentData);
            }

            $msg = Message::create($messageData);

            broadcast(new MessageEvent($msg))->toOthers();

            return response()->json(['status' => 'success', 'message' => $msg]);
        } catch (\Exception $e) {
            Log::error('Error in ChatController@send: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
