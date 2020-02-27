<?php
/**
 * Created by PhpStorm.
 * User: BlueSky
 * Date: 2017-11-15
 * Time: 03:28 PM
 */

namespace App\Http\Middleware;

use Closure;

class LoginChecker
{
    public function handle($request, Closure $next)
    {
        $uid= session()->get(SESSION_UID);

        if(!isset($uid) && $uid == null)
        {
            return redirect('/admin/signin');
        }
        else
            return $next($request);
    }

}