<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function registerUser(StoreUserRequest $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
//        $user->username = $request->username;
//        $picture = $request->photo->store('public/files');
//        $picture = str_replace('public','storage',$picture);
//        $user->photo = url($picture);
        $user->email = $request->email;
        $user->admin = 0;
        $user->verified = 0;
        $user->password = bcrypt($request->password);
        $user->funds = 1000;


        $user->save();
        $accessToken = $user->createToken('authToken');

        return response()->json([
            'success' => true,
            'message' => 'User created successfully!',
            'data' => $user,
            'access_token' => $accessToken->plainTextToken,
            'token_type' => 'Bearer'
        ], 200);
    }

    public function login(Request $request):  JsonResponse
    {

        $user = User::where('email','=',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'success' => false,
                'message' => 'Wrong Credentials!',
                'req' => $request->all(),
            ], 200);
        }
        else{
            $accessToken = $user->createToken('authToken');
            return response()->json([
                'success' => true,
                'message' => 'Logged in!',
                'user' => $user,
                'access_token' => $accessToken,
                'token_type' => 'Bearer'
            ], 200);
        }
    }

    public function index(){
        if(Auth::user()->admin){
        $verified = request()->verified;
        if($verified==0 && $verified!=null){
            $users = User::query()->where([['admin','=',0],['verified','=',0]])->get(['id','first_name','last_name','email','verified','funds']);
        }
        else if($verified==1){
            $users = User::query()->where([['admin','=',0],['verified','=',1]])->get(['id','first_name','last_name','email','verified','funds']);
        }
        else{
            $users = User::query()->where('admin','=',0)->get(['id','first_name','last_name','email','verified','funds']);
        }
            return response()->json([
                'success' => true,
                'message' => 'All users received',
                'data' => $users
            ],200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'unauthorized'
            ],403);
        }
    }

    public function verifyUser($id){
        if(Auth::user()->admin){
            $id = intval($id);

            $user = User::findOrFail($id);
            $user->verified = 1;
            $user->save();
            MailController::sendMail($user->email);
            return response()->json([
                'success' => true,
                'message' => 'User has been verified',
                'user' => $user
            ],200);
        }

        else{
                return response()->json([
                    'success' => false,
                    'message' => 'unauthorized'
                ],403);
            }

    }

    public function updateUser(Request $request){
        if(!Auth::user()->admin){
            return response()->json([
                    'success' => false,
                    'message' => 'unauthorized'],401
            );
        }

        else {
            $user = User::findOrFail($request->id);
            if($request->first_name) $user->first_name = $request->first_name;
            if($request->last_name) $user->last_name = $request->last_name;
            if($request->email) $user->email = $request->email;
            if($request->funds) $user->funds = $request->funds;
            $user->save();

            return response()->json([
                    'success' => true,
                    'message' => 'User updated',
                    'data' => $user]
            );

        }
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if(!Auth::user()->admin || $user->admin){
            return response()->json([
                    'success' => false,
                    'message' => 'unauthorized']
            );
        }
        $user->delete();

        return response()->json([
                'success' => true,
                'message' => 'User has been deleted']
        );

    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        if(!Hash::check($request->old_password, $user->password)){
            return response()->json([
                  'success' => false,
                  'message' => 'You have entered wrong password'
            ]);
        }
        else if($request->new_password !== $request->password_repeat){
            return response()->json([
                    'success' => false,
                    'message' => 'New passwords do not match'
            ]);
        }

        else{
            $user->password = bcrypt($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'password has been changed'
            ]);
        }

    }


}
