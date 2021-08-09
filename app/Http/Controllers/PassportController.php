<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PassportController extends Controller
{

        /**
         * Handles Registration Request
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(Request $request)
        {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);


            if($validator->fails()){
               return response()->json([
            $validator->errors(), "status"=> 409
               ]);
             }else{
                $user = User::create([
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);

                $token = $user->createToken('S-register')->accessToken;

                return response()->json(['token' => $token, "status"=> 200]);
             }


        }

        /**
         * Handles Login Request
         *
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function login(Request $request)
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (auth()->attempt($credentials)) {
                $token = auth()->user()->createToken('S-login')->accessToken;
                return response()->json(['token' => $token, "status"=> 200 ]);
            } else {
                return response()->json(['error' => 'UnAuthorised', "status"=> 401]);
            }
        }

        /**
         * Returns Authenticated User Details
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function details()
        {
            return response()->json(['user' => auth()->user()], 200);
        }

        public function logout(Request $request)
{
    $request->user()->token()->revoke();
    return response()->json([
        'message' => 'Successfully logged out'
    ]);
}
    }





