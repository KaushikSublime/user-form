<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use File;
use App\User;
use App\Files;

class UserController extends Controller
{
    public function save(Request $request)
    {
         $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone'=>'nullable|string',
            'address'=>'nullable|string',
            'zip'=>'nullable|numeric|digits:6',
        ]);
        $is_existing_user = User::where('email', '=', $request->input('email'))->first();
        if(isset($is_existing_user)){
            $res_data = array(
                'success'=>false,
                'message'=>'email already exist',
                'data'=>null
            );
           return $res_data;
        }
        $user_data = new User;
        $user_data->name = $request->input('name');
        $user_data->email = $request->input('email');
        $user_data->address = $request->input('address');
        $user_data->phone = $request->input('phone');
        $user_data->zip = $request->input('zip');
        $user_data->save();
        $user_profile = $request->file('profile');
        if($user_profile) {
            $fileName = $user_data->id.'-'.$request->file('profile')->getClientOriginalName();
            Storage::disk('local')->put($fileName,File::get($user_profile));
            $file_data = new Files;
            $file_data->location = $fileName;
            $file_data->type = 'profile';
            $file_data->user_id = $user_data->id;
            $file_data->save();
        }
        $user_doc = $request->file('license_doc');
        if($user_doc) {
            $fileName = $user_data->id.'-'.$request->file('license_doc')->getClientOriginalName();
            Storage::disk('local')->put($fileName,File::get($user_doc));
            $file_data = new Files;
            $file_data->location = $fileName;
            $file_data->type = 'license_doc';
            $file_data->user_id = $user_data->id;
            $file_data->save();
        }
        $res_data = array(
            'success'=>true,
            'message'=>'user created successfully',
            'data'=>$user_data
        );
        return $res_data;
    }
}
