<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::query()->find(Auth::user()->id);

        if (is_null($user)) {
            session()->flash('warning', 'У вас нет прав администратора');
            return redirect()->back();
        }

        if (!$user->is_admin) {
            session()->flash('warning', 'У вас нет прав администратора');
            return redirect()->back();//здесь был index
        }

        if (!$user->is_working_now)
        {
            session()->flash('warning', 'Ваше рабочее время уже закончилось!');
            return redirect()->back();//здесь был index
        }




        return $next($request);
    }
}
