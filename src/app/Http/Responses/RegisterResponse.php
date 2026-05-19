<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        if($request->user()->email_verified_at === null ) {
            return redirect('/email/verify');
        } else {
            return redirect('/mypage/profile');
        }
    }
}
