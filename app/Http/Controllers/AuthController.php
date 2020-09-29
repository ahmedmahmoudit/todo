<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;

class AuthController extends Controller {


    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse [string] message
     */
    public function register( Request $request )
    {
        $validator = Validator::make( $request->all(), [
            'email'      => 'required|string|email|unique:users',
            'name' => 'required|string',
            'password'   => 'required|string|confirmed'
        ] );

        if ( $validator->fails() )
        {
            return response()->json( [
                'message' => $validator->messages()->first(),
            ], 422 );
        }

        $user = new User( [
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => bcrypt( $request->password )
        ] );

        $user->save();

        return response()->json( [
            'message' => 'Successfully created user!'
        ], 201 );
    }

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse [string] expires_at
     */
    public function login( Request $request )
    {
        $request->validate( [
            'email'       => 'required|string|email',
            'password'    => 'required|string',
            'remember_me' => 'boolean'
        ] );

        $credentials = request( ['email', 'password'] );
        if ( !Auth::attempt( $credentials ) )
        {
            return response()->json( [
                'message' => 'Unauthorized'
            ], 401 );
        }

        $user = $request->user();
        $tokenResult = $user->createToken( 'Personal Access Token' );
        $token = $tokenResult->token;

        $token->save();

        return response()->json( [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ] );

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout( Request $request )
    {
        $request->user()->token()->revoke();

        return response()->json( [
            'message' => 'Successfully logged out'
        ] );
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user( Request $request )
    {
        return response()->json( $request->user() );
    }
}
