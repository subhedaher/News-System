<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('contact', ['categories' => $categories]);
    }

    public function message(Request $request)
    {
        $validator = validator($request->all(), [
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string'
        ]);
        if (!$validator->fails()) {
            Message::create([
                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),
                'email' => $request->input('email'),
                'message' => $request->input('message'),
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Send Message Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getMessages(Request $request)
    {
        $this->authorize('Read-Messages', $request->user());
        $messages = Message::orderBy('created_at', 'desc')->get();
        foreach ($messages as $message) {
            $message->read_at = now();
            $message->save();
        }

        return view('cms.messages.index', ['messages' => $messages]);
    }

    public function deleteMessage(Request $request, $id)
    {
        $this->authorize('Delete-Message');
        $countRows = Message::destroy($id);
        return response()->json([
            'status' => $countRows,
            'message' => $countRows ? 'Deleted Message Successfully' : 'Deleted Message Failed!'
        ], $countRows ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
