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


        
        }
    }
}

//attempt : هيه عملية تجرى إما على
//Response::HTTP_BAD_REQUEST :Symfony\componet\.. لما تكتب هذه استدعي مكتبة 
// if(Auth::guard... : ال اوت بتعمل هاش لوحدها وبتطابق ال الايميل مع الايميل والباس مع الباسورد طبعا الهاش معمول في الداتا بيز تعتك