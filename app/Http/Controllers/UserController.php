<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proses_praktikum;
use App\Models\User;
use App\Models\Statusform;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboardMhs()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('mhs.home', compact('course'));
    }

    public function formdaftar()
    {
        $status = Statusform::select('statusform')->first();
        if($status == 1)
        {
            return redirect('mhs.dashboard');
        }
        else
        {
            return redirect('mhs.formdaftar');
        }
    }

    public function dashboardDsn()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('dsn.home', compact('course'));
    }

    function updateFoto(Request $request)
    {
        $path = 'users/images/';
        $file = $request->file('user_pic');
        $new_name = 'User Image_'.date('Ymd').uniqid().'.jpg';


        // Upload foto baru 
        $upload = $file->move(public_path($path), $new_name);

        if(!$upload)
        {
            return response()->json(['status'=>0, 'msg'=>'Something went wrong, upload new picture failed']);
        }
        else{
            //ambil foto lama
            $oldPic = User::find(Auth::user()->id)->getAttributes()['fotouser'];

            if($oldPic != ''){
                if(\File::exists(\public_path($path.$oldPic))){
                    \File::delete(\public_path($path.$oldPic));
                }
            }

            //update db
            $update = User::find(Auth::user()->id)->update(['fotouser'=>$new_name]);

            if(!$update){
                return response()->json(['status'=>0, 'msg'=>'Something went wrong, updating picture in db failed']);
            }else{
                return response()->json(['status'=>1, 'msg'=>'Foto Profil Berhasil Diubah']);
            }
        }
    }


    function gantiPassword(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'current_password'=>[
                    'required', function($attribute, $value, $fail){
                        if( !\Hash::check($value, Auth::user()->password) ){
                            return $fail(__('Password Salah'));
                        }
                    },
                    'min:8',
                    'max:30'
                ],
                'new_password'=>'required|min:8|max:30',
                'cnew_password'=>'required|same:new_password'
            ],[
                'current_password.required'=>"Enter your current password",
                'current_password.min'=>"Password Minimal 8 Karakter",
                'current_password.max'=>"Password Maksimal 30 Karakter",
                'new_password.required'=>"Enter your new password",
                'new_password.min'=>"New Password Minimal 8 Karakter",
                'new_password.max'=>"New Password Maksimal 30 Karakter",
                'cnew_password.required'=>"ReEnter your new password",
                'cnew_password.same'=>"New Password dan Confirm New Password Harus Sama"
        ]);

        if( $validator->passes()){
            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->new_password)]);

            if( !$update ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
        }else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }
}