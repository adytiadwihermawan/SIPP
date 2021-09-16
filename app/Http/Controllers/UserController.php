<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use App\Models\Praktikum;
use App\Models\Pertemuan;
use App\Models\Proses_praktikum;
use App\Models\User;
use App\Models\Statusform;
use App\Models\Materi;
use App\Models\Roles;
use App\Models\Wadahpresensi;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use DataTables;

class UserController extends Controller
{
    public function dashboardMhs()
    {
        $mk = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')
                                    ->where('proses_praktikum.id_user', Auth::user()->id)->get();
        
        $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->first();
        // dd($mk);
        $datas = [
            'course'=>$mk,
            'data'=>$data
        ];
        return view('mhs.home', $datas);
    }

    public function mhsProfile()
    {
        $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->get();

        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        $datas = [
            'course'=>$course,
            'data'=>$data
        ];
        return view('mhs.profile', $datas);
    }

    public function mhsPresensi()
    {
       $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->get();

        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        $datas = [
            'course'=>$course,
            'data'=>$data
        ];
        return view('mhs.presensi', $datas);
    }


    public function matkulMhs($id)
    {
        $kelas = Praktikum::where('id_praktikum', $id)->get();
        
        $proses_praktikum = Pertemuan::join('proses_praktikum', 'pertemuan.id_praktikum', '=', 'proses_praktikum.id_praktikum')
                            ->where('pertemuan.id_praktikum', $id)
                            ->where('id_user', Auth::user()->id)
                            ->get();
        // dd($proses_praktikum);
        $data = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->where('pertemuan.id_pertemuan', $id)
                        ->get();
        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'mk'=>$kelas,
            'data'=>$data
        ];
        // dd($course);
        return view('mhs.matakuliah', $course);

    }

     public function asistDashboard()
    {
        $data = Roles::get();
        return view('auth.dashboard', compact('data'));
    }

    public function asistHome()
    {
        $course = Proses_praktikum::join('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();
        
        $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->get();
        // dd($data);
        $datas = [
            'course'=>$course,
            'data'=>$data
        ];
        return view('asist.home', $datas);
    }

    public function asistPresensi()
    {
       $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('asist.presensi', compact('course'));
    }

    public function matkulAsisten($id)
    {
        $praktikum = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                            ->where('praktikum.id_praktikum', $id)
                            ->get();
      
        $data = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->where('pertemuan.id_praktikum', $id)
                        ->get();

        $course = [
            'course'=>$praktikum,
            'datas'=>$data
        ];
    
        return view('asist.matakuliah', $course);

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
        $kelas = Praktikum::where('id_praktikum', $id)->get();
        
        $proses_praktikum = Pertemuan::join('proses_praktikum', 'pertemuan.id_praktikum', '=', 'proses_praktikum.id_praktikum')
                            ->where('pertemuan.id_praktikum', $id)
                            ->where('id_user', Auth::user()->id)
                            ->get();
    
        $data = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();
        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'mk'=>$kelas,
            'data'=>$data
        ];
                        
        // $icons = [
        //         'pdf' => 'pdf',
        //         'doc' => 'word',
        //         'docx' => 'word',
        //         'xls' => 'excel',
        //         'xlsx' => 'excel',
        //         'ppt' => 'powerpoint',
        //         'pptx' => 'powerpoint',
        //         'txt' => 'text',
        //         'png' => 'image',
        //         'jpg' => 'image',
        //         'jpeg' => 'image',
        //     ];
        // dd($course);
        return view('dsn.matakuliah', $course);

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
        'id',
        '_file' => 'required|mimes:pptx,txt,xlx,xls,doc,docx,pdf,ppsx'
        ]);

        $fileModel = new Materi;

        if($request->file()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path), $newname);

            $fileModel->namafile_materi= $request->_file->getClientOriginalName();
            $fileModel->save();

            return back()
            ->with('success','File has been uploaded.');}
        // // }
        // $path = 'uploads/';
        // $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
        // $id = $request->input('id');
        // $upload = $request->_file->move(public_path($path), $newname);
         
        // if($upload){
        //     $post = new Materi();
        //     $post->nama = $newname;
        //     $post->id_pertemuan = $id;
        //     dd($post);
        //     $post->save();
        //     echo 'Berhasil';
        // }else{
        //     echo 'Gagal';
        // }
   }

   public function downloadFile(Request $request, $file)
   {
        $path = 'uploads/'.$file;
        // dd($path);
        return response()->download(public_path($path));
   }

   public function updateFoto(Request $request)
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
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in database']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
        }else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }

  function buatPertemuan(Request $request)
        {
            $request->validate([
                    'id'=>'required',
                    'nama_pertemuan'=>'required',
                    'deskripsi'=>'required',
                ]);
        // dd($request->all());
            $query = Pertemuan::insert([
                        'id_praktikum'=>$request->input('id'),
                        'nama_pertemuan'=>$request->input('nama_pertemuan'),
                        'deskripsi'=>$request->input('deskripsi')
                    ]);
    //    dd($query);
            if($query){
                return redirect()->route('matkulDsn', [$request->input('id')])->with('berhasil', 'Data Berhasil Ditambahkan');
            }                
            else{
                return back()->with('gagal', 'Ada terjadi kesalahan');
            }
        }

        public function dataTable($id)
        {
            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->get();

            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $id)
                                ->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('Aksi', function($data)
                {
                    $button = "<button class='edit btn btn-danger' style='text-align: center' id='".$data->id."'>Edit</button>";
                    $button .= "<button class='delete btn btn-danger' style='text-align: center' id='".$data->id."'>Delete</button>";
                    return $button;
                })
                ->rawColumns(['Aksi'])
                ->make(true);
            }

            $cek = [
                'data'=>$data,
                'course'=>$course
            ];
            return view('dsn.participants', $cek);
        }

    public function buatAbsen(Request $request)
    {
        $request->validate([
                    'id',
                    'tanggal'=>'required',
                    'materi'=>'required',
                    'wmp'=>'required',
                    'wap'=>'required'
                ]);
        //  dd($request->all());
        $query = Wadahpresensi::insert([
                        'id_pertemuan'=>$request->input('id'),
                        'keterangan'=>$request->input('materi'),
                        'waktu_mulai'=>$request->input('wmp'),
                        'waktu_berakhir'=>$request->input('wap'),
                        'tanggal'=>$request->input('tanggal')
                    ]);
        // dd($query);
        if($query)
        {
            return back()
            ->with('success','data has been uploaded.');
        }
    }

}