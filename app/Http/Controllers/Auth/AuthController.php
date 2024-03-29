<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function showLogin(Request $request, $guard){
        return response()->view('cms.auth.login',['guard'=>$guard]);
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
                        if(Auth::guard($request->input('guard'))->attempt($credentials,$request->input('remember_me'))) {
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

    
    public function editPassword(Request $request)
    {
        return response()->view('cms.auth.edit-password');
    }


    public function updatePassword(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'broker';
        $validator =Validator($request->all() , [
            'password'=> 'required|string|current_password:'.$guard,
            'new_password'=> 'required|string|min:3|max:25|confirmed',
            'new_password_confirmation'=> 'required|string|min:3|max:25',
        ]);

        if(! $validator->fails())
        {
            $user = auth($guard)->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSaved = $user->save();
            return response()->json([
                'message' =>$isSaved ? 'Password changed successfully' : 'Password changed failed'
            ], $isSaved ? Response::HTTP_OK :  Response::HTTP_BAD_REQUEST);
        } else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }



    public function editProfile(Request $request)
    {
        $user = auth($this->getGuardName())->user();
        return response()->view('cms.auth.edit-profile' , ['user' => $user]);
    }


    public function updateProfile(Request $request)
    {
        $guard = $this->getGuardName();
        $table = $guard == 'admin' ? 'admins' : 'brokers' ;
        $validator =Validator($request->all() , [
            'name'=> 'required|string|min:3|max:45',
            'email'=> "required|string|email|unique:$table,email,".auth($guard)->id()
        ]);

        if(! $validator->fails())
        {
            $user = auth($guard)->user();
            $user->name =$request->input('name');
            $user->email =$request->input('email');
            $isSaved = $user->save();
            return response()->json([
                'message' =>$isSaved ? 'Profile updated successfully' : 'Profile update failed'
            ], $isSaved ? Response::HTTP_OK :  Response::HTTP_BAD_REQUEST);
        }
        else{
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    
    }


// table is the provider

    //Logout
    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' :'broker';
        // auth('admin')->logout();
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login-view',$guard);
    }

    private function getGuardName() : String{
       return auth('admin')->check() ? 'admin' : 'broker' ;
    }

}
