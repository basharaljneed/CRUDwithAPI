<?php

namespace App\Http\Controllers;
use App\Http\Controllers\perapitrait;

use App\Models\personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PersonalController extends Controller
{
    use perapitrait;


    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $response['token'] =  $user->createToken($request->email)->plainTextToken;
            $response['name'] =  $user->name;


            return $this->infopers($response, 'User successfully logged-in.', 201);
        } else {
            // return $this->infopers('Validation error.', $validator->errors(), 400);
            // return $this->errorResponse('Unauthorized.', ['error' => 'Unauthorized'], 403);
            return $this->infopers('Unauthorized.', ['error' => 'Unauthorized'], 403);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            // 'device_name' => 'required'
        ]);

        if ($validator->fails()) {

            return $this->infopers('Validation error.', $validator->errors(), 400);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        $response['token'] =  $user->createToken($request->email)->plainTextToken;
        $response['name'] =  $user->name;

        return $this->infopers($response, 'User created successfully.', 200);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        

        return $this->infopers('null','Logout successfully.',504);
    }

   }
