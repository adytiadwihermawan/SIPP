<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proses_praktikum;
use App\Models\User;
use App\Models\Statusform;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;

class UserController extends Controller
{
    public function dashboardMhs()
    {
        return view('auth.dashboard');
    }

    public function mhsProfile()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('mhs.profile', compact('course'));
    }

    public function mhsPresensi()
    {
       $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('mhs.presensi', compact('course'));
    }


    function matkul()
    {
        $course = Praktikum::get();

        return view('mhs.matkullayout', compact('course'));
    }

    // public function formdaftar()
    // {
    //     $status = Statusform::select('statusform')->first();
    //     if($status == 1)
    //     {
    //         return redirect('mhs.dashboard');
    //     }
    //     else
    //     {
    //         return redirect('mhs.formdaftar');
    //     }
    // }

    public function dsnProfile()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('dsn.profile', compact('course'));
    }

    public function dsnPresensi()
    {
       $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

       return view('dsn.presensi', compact('course'));
    }
        
    public function dashboardDsn()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('dsn.home', compact('course'));
    }

    public function matkulDsn($id)
    {
        $course = Proses_praktikum::leftJoin('pertemuan', 'proses_praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
        ->leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)
        ->get();
    
        return view('dsn.matakuliah', compact('course'));

    }

    // public  function dropZone(Request $request)  
    // {  
    //     $file = $request->file('file');  
    //     $fileName = time().'.'.$file->extension(); 
    //     $file->move(public_path('file'),$fileName);  
    //     return response()->json(['success'=>$fileName]);  
    // }

    public function upload(Request $request){
        $request->validate([
        '_file' => 'required|mimes:ppt,txt,xlx,xls,doc,docx,pdf|max:2048'
        ]);

        $fileModel = new Materi;

        if($request->file()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path), $newname);

            $fileModel->name = $request->_file->getClientOriginalName();
            $fileModel->save();

            return back()
            ->with('success','File has been uploaded.');
        }
        // $path = 'uploads/';
        // $newname = Helper::renameFile($path, $request->file('_file')>getClientOriginalName());

        // $upload = $request->_file->move(public_path($path), $newname);
        // if($upload){
        //     $post = new Materi();
        //     $post->name = $newname;
        //     $post->save();
        //     echo 'Berhasil';
        // }else{
        //     echo 'Gagal';
        // }
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