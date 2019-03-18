<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 14:33
 */

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;

class ApiMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $this->verifyToken($request);
        if (!$user) {
            $permissionDenied = [
                'message' => 'Permission denied'
            ];
            return response()->json($permissionDenied, 401);
        }
        $request->attributes->add(['user' => $user]);
        $request->auth = $user;
        return $next($request);
    }

    public function verifyToken(Request $request)
    {
        $token = $request->header('token');
        if (!$token) {
            $token = $request->input('token');
        }

        if (!$token || $token == 'null') {
            return false;
        }
        try {
            $decode_token = JWT::decode($token, env('KEY_TOKEN'), ['HS256']);
        } catch (ExpiredException $e) {
            return false;
        } catch (Exception $e) {
            return false;
        }
        $user = (array)$decode_token;
        return $user;
    }
}
