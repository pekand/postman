<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\AccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->json()->all();

        $user = User::where("email", $data['username'])->first();

        if($user == null) {
            return new JsonResponse(["action"=>"Access denied"], 403);
        }

        if(!password_verify($data['password'], $user->password)) {
            return new JsonResponse(["action"=>"Access denied"], 403);
        }

        $accessToken = new AccessToken();
        $accessToken->user()->associate($user);
        $accessToken->save();

        return [
            'action'=>'login',
            'access_token'=>$accessToken->access_token,
        ];
    }

    public function logout(Request $request)
    {
        $access_token = $request->header('Authorization');
        $accessToken = AccessToken::where('access_token', $access_token)->first();
        $accessToken->delete();

        return [
            'action'=>'logout'
        ];
    }

    public function user(Request $request)
    {
        $access_token = $request->header('Authorization');
        $accessToken = AccessToken::where('access_token', $access_token)->first();

        return [
            "action"=>"user",
            "user"=>$accessToken->user()->get(),
        ];
    }
}
