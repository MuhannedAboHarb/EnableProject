<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('auth.login');
    }


    public function login(Request $request){
        $validator=Validator($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string|min:1|max:20',
            'remember_me'=> 'required|boolean',
        ]);

        if($validator->fails())
        {
            $credentials= ['email'=>$request->input('email'), 'password'=>$request->input('password')];
                if(Auth::guard('admin')->attempt($credentials,$request->input('remember_me')))
                {
                    return response()->json([
                        'message'=> 'Logged in Successfully '
                    ], Response::HTTP_OK);
                } 
                else 
                {
                    return response()->json([
                        'message'=> $validator->getMessageBag()->first()
                    ], Response::HTTP_BAD_REQUEST);
                }
        } 
        
        else 
        {
            return response()->json([
                'message'=> $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

//attempt : هيه عملية تجرى إما على
//Response::HTTP_BAD_REQUEST :Symfony\componet\.. لما تكتب هذه استدعي مكتبة 
// if(Auth::guard... : ال اوت بتعمل هاش لوحدها وبتطابق ال الايميل مع الايميل والباس مع الباسورد طبعا الهاش معمول في الداتا بيز تعتك