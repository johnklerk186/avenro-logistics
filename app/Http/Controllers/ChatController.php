<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function adminIndex()
    {
        return view('admin.chat.index');
    }

    public function getSessions()
    {
        try {
            Log::info('Fetching chat sessions');
            
            $sessions = Chat::select('session_id', 'user_name', 'user_email')
                ->selectRaw('MAX(created_at) as last_message_at')
                ->selectRaw('MIN(created_at) as created_at')
                ->selectRaw('COUNT(*) as message_count')
                ->groupBy('session_id', 'user_name', 'user_email')
                ->orderBy('last_message_at', 'desc')
                ->get()
                ->map(function ($session) {
                    return [
                        'id' => $session->session_id,
                        'name' => $session->user_name,
                        'email' => $session->user_email,
                        'status' => $this->getChatStatus($session->session_id),
                        'created_at' => $session->created_at,
                        'last_message_at' => $session->last_message_at,
                        'message_count' => $session->message_count
                    ];
                });

            Log::info('Found ' . $sessions->count() . ' chat sessions');
            return response()->json($sessions);
        } catch (\Exception $e) {
            Log::error('Error fetching chat sessions: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch chat sessions'], 500);
        }
    }

    public function getMessages(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string'
            ]);

            Log::info('Fetching messages for session: ' . $request->session_id);

            $messages = Chat::where('session_id', $request->session_id)
                ->orderBy('created_at', 'asc')
                ->get()
                ->map(function ($message) {
                    return [
                        'id' => $message->id,
                        'message' => $message->message,
                        'user_name' => $message->user_name,
                        'is_admin' => $message->is_admin,
                        'created_at' => $message->created_at
                    ];
                });

            Log::info('Found ' . $messages->count() . ' messages');
            return response()->json($messages);
        } catch (\Exception $e) {
            Log::error('Error fetching messages: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch messages'], 500);
        }
    }

    public function initiateChat(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255'
            ]);

            $sessionId = Str::uuid();
            Log::info('Initiating new chat session', [
                'session_id' => $sessionId,
                'name' => $request->name,
                'email' => $request->email
            ]);

            $chat = Chat::create([
                'session_id' => $sessionId,
                'user_name' => $request->name,
                'user_email' => $request->email,
                'message' => "Chat session started",
                'is_admin' => false
            ]);

            return response()->json([
                'session_id' => $sessionId,
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            Log::error('Error initiating chat: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initiate chat'], 500);
        }
    }

    public function userSendMessage(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string',
                'message' => 'required|string',
                'user_name' => 'required|string',
                'user_email' => 'required|email'
            ]);

            Log::info('User sending message', [
                'session_id' => $request->session_id,
                'user_name' => $request->user_name
            ]);

            $chat = Chat::create([
                'session_id' => $request->session_id,
                'message' => $request->message,
                'is_admin' => false,
                'user_name' => $request->user_name,
                'user_email' => $request->user_email
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error sending user message: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }

    public function adminSendMessage(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string',
                'message' => 'required|string'
            ]);

            Log::info('Admin sending message', [
                'session_id' => $request->session_id,
                'admin_id' => Auth::id()
            ]);

            $chat = Chat::create([
                'session_id' => $request->session_id,
                'message' => $request->message,
                'is_admin' => true,
                'user_name' => Auth::user()->name ?? 'Admin',
                'user_email' => Auth::user()->email ?? 'admin@example.com'
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error sending admin message: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }

    public function endChat(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|string'
            ]);

            Log::info('Ending chat session', [
                'session_id' => $request->session_id,
                'admin_id' => Auth::id()
            ]);

            Chat::create([
                'session_id' => $request->session_id,
                'message' => "Chat session ended by admin",
                'is_admin' => true,
                'user_name' => Auth::user()->name ?? 'Admin',
                'user_email' => Auth::user()->email ?? 'admin@example.com'
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Error ending chat: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to end chat'], 500);
        }
    }

    public function deleteChat($session_id)
    {
        try {
            Log::info('Deleting chat session', [
                'session_id' => $session_id,
                'admin_id' => Auth::id()
            ]);

            $deleted = Chat::where('session_id', $session_id)->delete();

            if ($deleted) {
                return response()->json(['status' => 'success', 'message' => 'Chat session deleted successfully']);
            } else {
                return response()->json(['error' => 'Chat session not found'], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting chat: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete chat'], 500);
        }
    }

    private function getChatStatus($sessionId)
    {
        try {
            $lastMessage = Chat::where('session_id', $sessionId)
                ->orderBy('created_at', 'desc')
                ->first();

            if (!$lastMessage) {
                return 'ended';
            }

            if ($lastMessage->message === "Chat session ended by admin") {
                return 'ended';
            }

            if ($lastMessage->created_at->diffInHours(now()) > 24) {
                return 'ended';
            }

            return 'active';
        } catch (\Exception $e) {
            Log::error('Error getting chat status: ' . $e->getMessage());
            return 'ended';
        }
    }
}
