<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use App\Models\Praktikum;
use App\Models\Pertemuan;
use App\Models\Proses_praktikum;
use App\Models\User;
use App\Models\Statusform;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\Roles;
use App\Models\Uploadtugas;
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

    public function mhsPresensi($id)
    {
       $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->get();

        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        $kelas = Praktikum::where('id_praktikum', $id)->get();

        $datas = [
            'course'=>$course,
            'data'=>$data,
            'mk'=>$kelas
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
        $course = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();
        
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
        $kelas = Praktikum::where('id_praktikum', $id)->get();
        
        $proses_praktikum = Pertemuan::join('roles', 'pertemuan.id_praktikum', '=', 'roles.id_praktikum')
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
                    'id'=>'required',
                    '_file' => 'required|mimes:pptx,txt,xlx,xls,doc,docx,pdf,ppsx,xlxs',
                    'judul_materi'=>'required',
                    'deskripsi'
                ]);
        // dd($request->all());
        $fileModel = new Materi;

        if($request->all()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path), $newname);

            $fileModel->id_pertemuan= $request->id;
            $fileModel->namafile_materi = $request->_file->getClientOriginalName();
            $fileModel->judul_materi = $request->judul_materi;
            $fileModel->deskripsi_file = $request->deskripsi;
            $query = $fileModel->save();

            if($query){
                return response()->json(['status'=>1,'msg'=>'File Berhasil Diunggah']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
            }
        }
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
                    'deskripsi'=>'required'
                ]);
        // dd($request->all());
            $query = Pertemuan::insert([
                        'id_praktikum'=>$request->input('id'),
                        'nama_pertemuan'=>$request->input('nama_pertemuan'),
                        'deskripsi'=>$request->input('deskripsi')
                    ]);
    //    dd($query);
            if(!$query){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal membuat pertemuan']);
            }                
            else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Ditambahkan']);
            }
        }

    public function updatePertemuan(Request $request){
        $request->validate([
            'id' => 'required',
            'nama_pertemuan' => 'required',
            'deskripsi' => 'required'
        ]);

        $update = Pertemuan::where('id_pertemuan', $request->input('id'))
                            ->update([
                                'id_pertemuan'=>$request->input('id'),
                                'nama_pertemuan'=>$request->input('nama_pertemuan'),
                                'deskripsi'=>$request->input('deskripsi')
                        ]);
        // dd($update);
        if(!$update){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal memperbaharui pertemuan']);
            }                
            else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Diperbaharui']);
            }

    }

        public function dsnPartisipan($id)
        {
            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->leftjoin('roles', 'users.id', '=', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->orwhere('roles.id_praktikum', $id)
                         ->get();
            // dd($data);
            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $id)
                                ->get();

            $kelas = Praktikum::where('id_praktikum', $id)->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('Aksi', function($data)
                {
                    $button = "<button class='edit btn btn-success' style='text-align: center' id='".$data->id."'>View</button>";
                    return $button;
                })
                ->rawColumns(['Aksi'])
                ->make(true);
            }

            $cek = [
                'mk'=>$kelas,
                'data'=>$data,
                'course'=>$course
            ];
            return view('dsn.participants', $cek);
        }

         public function asistPartisipan($id)
        {
            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->leftjoin('roles', 'users.id', '=', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->orwhere('roles.id_praktikum', $id)
                         ->get();

            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $id)
                                ->get();

            $kelas = Praktikum::where('id_praktikum', $id)->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('Aksi', function($data)
                {
                    $button = "<button class='edit btn btn-success' style='text-align: center' id='".$data->id."'>View</button>";
                    return $button;
                })
                ->rawColumns(['Aksi'])
                ->make(true);
            }

            $cek = [
                'mk'=>$kelas,
                'data'=>$data,
                'course'=>$course
            ];
            return view('asist.participants', $cek);
        }

        public function partisipan($id)
        {
            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->get();

            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $id)
                                ->get();

            $kelas = Praktikum::where('id_praktikum', $id)->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->make(true);
            }

            $cek = [
                'mk'=>$kelas,
                'data'=>$data,
                'course'=>$course
            ];
            return view('mhs.partisipan', $cek);
        }


         public function dsnGrade($id)
        {
            $data = Uploadtugas::join('materi', 'uploadtugas.id_materi', '=', 'materi.id_materi')
                         ->join('users', 'uploadtugas.id_user', 'users.id') 
                         ->where('materi.id_pertemuan', $id)
                         ->get();

            
            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();

            $kelas = Praktikum::join('pertemuan', 'praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('Grade', function($data)
                {
                    $button = "<button class='edit btn btn-danger' data-remote='false' data-toggle='modal' data-target='#nilai' style='text-align: center' id='".$data->id_materi."'>Grade</button>";
                    return $button;
                })
                ->addColumn('Edit', function($data)
                {
                    $btn = "<button class='edit btn btn-success' style='text-align: center' id='".$data->id_materi."'>Edit</button>";
                    return $btn;
                })
                ->rawColumns(['Grade', 'Edit']) 
                ->make(true);
            }

            $cek = [
                'mk'=>$kelas,
                'grade'=>$data,
                'course'=>$course
            ];
            // dd($cek);
            return view('dsn.grades', $cek);
        }
        
        public function asistGrade($id)
        {
            $data = Uploadtugas::join('materi', 'uploadtugas.id_materi', '=', 'materi.id_materi')
                         ->join('users', 'uploadtugas.id_user', 'users.id') 
                         ->where('materi.id_pertemuan', $id)
                         ->get();

            
            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();

            $kelas = Praktikum::join('pertemuan', 'praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();
            // dd($data);
            if(request()->ajax()){
                return datatables()->of($data)
                ->addColumn('Grade', function($data)
                {
                    $button = "<button class='edit btn btn-danger' data-toggle='modal' data-target='#nilai' style='text-align: center' id='".$data->id_materi."'>Grade</button>";
                    return $button;
                })
                ->addColumn('Edit', function($data)
                {
                    $btn = "<button class='edit btn btn-success' style='text-align: center' id='".$data->id_materi."'>Edit</button>";
                    return $btn;
                })
                ->rawColumns(['Grade', 'Edit']) 
                ->make(true);
            }

            $cek = [
                'mk'=>$kelas,
                'grade'=>$data,
                'course'=>$course
            ];
            // dd($cek);
            return view('asist.grades', $cek);
        }

    public function buatAbsen(Request $request)
    {
        $request->validate([
                    'id',
                    'pertemuan',
                    'tanggal'=>'required',
                    'materi'=>'required',
                    'wmp'=>'required',
                    'wap'=>'required'
                ]);
        //  dd($request->all());
        $query = Wadahpresensi::insert([
                        'id_praktikum'=>$request->input('id'),
                        'urutanpertemuan'=>$request->input('pertemuan'),
                        'keterangan'=>$request->input('materi'),
                        'waktu_mulai'=>$request->input('wmp'),
                        'waktu_berakhir'=>$request->input('wap'),
                        'tanggal'=>$request->input('tanggal')
                    ]);
        // dd($query);
        if($query){
            return response()->json(['status'=>1,'msg'=>'Absen berhasil dibuat']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }
            
    }

    public function deletemateri($id){
        $query = Materi::where('id_pertemuan', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

    public function nilai(Request $request){

        $rules = [
         'nilai' => 'required',
         'id_materi' => [
             'required',
             Rule::unique('nilai', 'id_materi')
            ],
         'id_user' => [
             'required',
             Rule::unique('nilai', 'id_user')
         ],
        ];
        

       $validator = \Validator::make($request->all(), $rules, [
            'nilai.required' => "Masukkan Nilai Tugas"
    ]);
       if( $validator->passes()){
        
            $query = Nilai::insert([
                            'nilai'=>$request->input('nilai'),
                            'id_materi'=>$request->input('id_materi'),
                            'id_user'=>$request->input('id_user')
                        ]);
        if($query){
                return response()->json(['status'=>1,'msg'=>'Nilai berhasil diinput']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
            }
        }
    else{          
        return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

    }
}
