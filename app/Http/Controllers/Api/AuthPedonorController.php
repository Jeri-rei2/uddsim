<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;

class AuthPedonorController extends Controller
{
    //
    // public function PostData(Request $request)
    // {
    //     $client = new Client();
    //     $username = $request->usere;
    //     $password = $request->passe;
    //         $url = 'http://192.168.3.235:8181/api/login';

    //     $params = [
    //         "usere" => $username,
    //         "passe" => $password
    //     ];

    //     $response = $client->request('POST', $url, [
    //         'json' => $params
    //     ]);
    //     $token = $response->json('token');

    //     return json_decode($response->getBody());
    // }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        dd($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        // if (! Auth::attempt($request->only('email', 'password'))) {
        //     return response()->json([
        //         'message' => 'Unauthorized'
        //     ], 401);
        // }

        // $user = User::where('email', $request->email)->firstOrFail();


        // return response()->json([
        //     'message' => 'Login success',
        //     'access_token' => $token,
        //     'token_type' => 'Bearer'
        // ]);

        $user = Auth::Attempt($request->all());
        if ($user) {
            $user = Auth::user();
            // $token->token = Str::random(100);
            $token = $user->createToken('auth_token')->plainTextToken;

            $user->save();
            // $user->makeVisible('api_token');

            return response()->json([
                'response_code' => 200,
                'success' => true,
                'message' => 'Login Berhasil',
                'token' => $token
            ]);
        }else{
            return response()->json([
                'response_code' => 404,
                'message' => 'Username atau Password Tidak Ditemukan!'
            ]);
        }
        return response()->json([
            'message' => 'Password Anda tidak cocok.',
        ], 401);
    }



    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'logout success'
        ]);
    }

}
