<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

    public function show()
    {
        $messages = Message::all();

        if ($messages) {
            return response()->json([
                'status' => 200,
                'messages' => $messages,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Table Empty !!',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|max:191',
            'title' => 'required|max:191',
            'message' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {
            $message = Message::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'title' => $request->input('title'),
                'message' => $request->input('message'),
            ]);


            return response()->json([
                'status' => 200,
                'message' => 'Created With Successfully ^-^',
            ]);
        }
    }

    public function delete($id)
    {
        $messages = Message::find($id);

        if ($messages) {
            $messages->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted With Successfully ^-^',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Message Not Found 404 ^+^',
            ]);
        }
    }
}
