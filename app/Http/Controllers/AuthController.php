<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email|max:191',
            'password' => 'required|min:8',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken($user->email . '_Token', [''])->plainTextToken;

            return response()->json([
                'status' => 200,
                'token' => $token,
                'email' => $user->email,
                'message' => 'Your Are Register With Success ^-^',
            ]);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email|max:191',
            'password' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 422,
                    'message' => 'The provided credentials are incorrect'
                ]);
            } else {

                if ($user->role_as == 1) {
                    $role = 'admin';

                    $token = $user->createToken($request->email . '_AdminToken', ['server:admin'])->plainTextToken;
                } else {
                    $role = 'user';

                    $token = $user->createToken($request->email . '_Token', [''])->plainTextToken;
                }

                return response()->json([
                    'status' => 200,
                    'token' => $token,
                    'email' => $user->email,
                    'role' => $role,
                    'id' => $user->id,
                    'message' => 'Your Are Login With Success ^-^',
                ]);
            }
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'You Logout ^-^',
        ]);
    }
}
