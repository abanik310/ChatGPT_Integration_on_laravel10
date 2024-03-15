<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;


class UserController extends Controller
{
    public function view_login()
    {
        return view('login');
    }

    public function chat_page()
    {
        return view('chat_page');
    }

    public function check_login(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){

            return Response(['message' => $validator->errors()],401);
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
   
        if ($user && Auth::guard('web')->attempt($credentials)) 
        {
            $success =  $user->createToken('Chat_GPT_Integration')->plainTextToken; 
        
            //return Response(['token' => $success],200);
            session(['name' => $user->name, 'api_token' => $success]);

            return response()->view('chat_page');


        }

        return Response(['message' => 'email or password wrong'],401);
    }

    public function userDetails(): Response
    {
        if (Auth::check()) {

            $user = Auth::user();

            return Response(['data' => $user],200);
        }

        return Response(['data' => 'Unauthorized'],401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $request->session()->forget(['email', 'password']);
        $request->session()->flush();
        
        $user->currentAccessToken()->delete();
        Auth::logout();
        
        //return Response(['data' => 'User Logout successfully.'],200);
        return redirect()->intended('/login');


        
    }
}
