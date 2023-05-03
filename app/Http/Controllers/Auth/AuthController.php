<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin(){
        return response()->view('cms.auth.login');
    }

    public function login(Request $request){
        $validator = Validator($request->all(),[
            'email'=> 'required|string|email',
            'password'=> 'required|string|min:1|max:20',
            'remember_me'=> 'required|boolean'
        ]);

        if(! $validator->fails()) {
            $credentials = ['email'=>$request->input('email'),'password'=>$request->input('password')];
                        if(Auth::guard('admin')->attempt($credentials,$request->input('remember_me'))) {
                            return response()->json([
                                'message' => 'Logged in successfully'
                            ], Response::HTTP_OK);
                        }else{
                            return response()->json([
                                'message' => $validator->getMessageBag()->first()
                            ], Response::HTTP_BAD_REQUEST);
                        }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
