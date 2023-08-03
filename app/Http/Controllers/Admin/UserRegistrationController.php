<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserRegistrationController extends Controller
{
    public function userRegisterController(Request $request)
    {


        if ($request->ismethod('post')) {
            $data = $request->all();
            $rules = [
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required|min:6'
            ];

            $validator =  Validator::make($data, $rules);
            if ($validator->fails()) {
                foreach ($validator->errors()->getMessages() as $key => $value) {
                    $a = array();
                    $a = [
                        'success' => false,
                        'message' => $value[0]
                    ];

                    return response()->json($a);
                    // die;
                }
            }

            function generateRandomString($length = 6)
            {
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                $randomString = '';

                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }

                return $randomString;
            }

            $user = new User();
            $user->email = $data['email'];
            $user->phone = $data['phone'];
            $user->name = $data['name'];
            $user->version = $data['version'];
            $user->unique_user_id = Str::substr($data['email'], 0, 3) . generateRandomString() . rand(9, 9999);
            $user->password = bcrypt($data['password']);
            $user->save();




            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = User::where('email', $data['email'])->first();
                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email', $data['email'])->update(['access_token' => $access_token]);
                $message = 'User Successfully Registerd';
                return response()->json(['message' => $message, 'access_token' => $access_token, 'unique_user_id' => $user->unique_user_id, 'success' => true,], 201);
            } else {
                $message = 'Oppss Something Went Wrong';
                return response()->json(['message' => $message, 'success' => false], 422);
            }
        }
    }

    public function userLoginController(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|exists:users',
                'password' => 'required'
            ];

            $validator =  Validator::make($data, $rules);
            if ($validator->fails()) {
                foreach ($validator->errors()->getMessages() as $key => $value) {
                    $a = array();
                    $a = [
                        'success' => false,
                        'message' => $value[0],
                    ];
                    return response()->json($a);
                }
            }

            //   User::where('email', $data['email'])->update(['device_id' => $data['device_id']]);

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = User::where('email', $data['email'])->first();
                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email', $data['email'])->update(['access_token' => $access_token]);
                $message = 'User Successfully Login';
                return response()->json([
                    'message' => $message,
                    'data' =>  $user,
                    'success' => true,
                ], 201);
            } else {
                $message = 'Ooops Something Went Wrong';
                return response()->json(['message' => $message, 'success' => false], 422);
            }
        }
    }
}
