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
    public function showLogin(Request $request){
        return response()->view('cms.auth.login');
    }

    public function login(Request $request){
        $validator = Validator($request->all(),[
            'guard' => 'string|in:admin,broker',
            'email'=> 'required|string|email',
            'password'=> 'required|string|min:1|max:20',
            'remember_me'=> 'required|boolean'
        ] , [
            'guard.in'=> 'Url is not correct, check and try again'
        ]);

        if(! $validator->fails()) {
            $credentials = ['email'=>$request->input('email'),'password'=>$request->input('password')];
                        if(Auth::guard('admin')->attempt($credentials,$request->input('remember_me'))) {
                            return response()->json([
                                'message' => 'Logged in successfully'
                            ], Response::HTTP_OK);
                        }else{
                            return response()->json([
                                'message' => 'Please check your email or password'
                            ], Response::HTTP_BAD_REQUEST);
                        }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    //Logout
    public function logout(Request $request)
    {
        // auth('admin')->logout();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login-view');
    }

}
