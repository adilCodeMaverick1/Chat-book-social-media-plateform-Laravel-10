<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckUserOwner
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
        $user = $request->route('user');

        if ($user && $user->id == auth()->id()) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'You are not authorized to edit this resume.');
    }
}
