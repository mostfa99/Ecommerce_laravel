<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'device_name' => ['required'],
            'abilities' => 'required',

        ]);
        // dd($request);
        // $user = Auth::user();
        $user = User::where('email', $request->username)
            ->orWhere('mobile', $request->username)
            ->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return Response::json([
                'message' => 'invalid username or password combination'
            ], 401);
        }
        //   $token = $user->createToken($request->name, $request->abilities);
        $abilities = $request->input('abilities', ['*']);
        if ($abilities && is_string($abilities)) {
            $abilities = explode(',', $abilities);
        }
        $token = $user->createToken($request->device_name, $abilities);
        return Response::json([
            'token' =>  $token->plainTextToken,
            // 'token' =>  $token,
            'user' => $user,
            'message' => 'Personal access token created successfully.'
            /* 'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_avatar' => $user->avatar,
            'user_is_admin' => $user->is_admin,
            'user_is_active' => $user->is_active,
            'user_is_superuser' => $user->is_superuser,
            'user_is_staff' => $user->is_staff,
            'user_is_authenticated' => $user->is_authenticated,
            'user_is_anonymous' => $user->is_anonymous,
            'user_is_guest' => $user->is_guest,
            'user_is_blocked' => $user->is_blocked,
            'user_is_deleted' => $user->is_deleted,
            'user_is_banned' => $user->is_banned,
            'user_is_suspended' => $user->is_suspended,
            'user_is_inactive' => $user->is_inactive,
            'user_is_rejected' => $user->is_rejected,
            'user_is_pending' => $user->is_pending,
            'user_is_pending_activation' => $user->is_pending_activation,
            'user_is_pending_password_reset' => $user->is_pending_password_reset,
            'user_is_pending_password_change' => $user->is_pending_password_change,
            'user_is_pending_email_verification' => $user->is_pending_email_verification,
            'user_is_pending_email_change' => $user->is_pending_email_change,
*/
        ]);
        /*
        return response()->json([
            'token' => $token->plainTextToken,
            'message' => 'Personal access token created successfully.'
        ]);

        */
    }
    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
        // Revoke all tokens...
        // $user->tokens()->delete();

        // Revoke the token that was used to authenticate the current request...
        $user->currentAccessToken()->delete();

        // Revoke a specific token...
        // by will defined $id as parameters
        // $user->tokens()->where('id', $tokenId)->delete();
    }
}
