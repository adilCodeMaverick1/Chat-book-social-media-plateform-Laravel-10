<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\SocialLink;

class CheckSocialLinkOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $socialLink = SocialLink::find($request->route('id'));

        if ($socialLink && $socialLink->user_id == auth()->id()) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'You are not authorized to edit these social links.');
    }
}
