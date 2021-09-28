<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
use App\Models\Wadah_tugas;
use App\Models\Wadahpresensi;
use App\Models\Wadahform;
use App\Models\Presensi;
use App\Models\Rekrutasisten;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use DataTables;
use App\DataTables\NilaiDataTable;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

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

    // public function mhsPresensi($id)
    // {
    //    $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
    //                 ->where('id_status', '=', 3)
    //                 ->Where('id_user', '=', Auth::user()->id)
    //                 ->get();

    //     $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

    //     $kelas = Praktikum::where('id_praktikum', $id)->get();

    //     $datas = [
    //         'course'=>$course,
    //         'data'=>$data,
    //         'mk'=>$kelas
    //     ];
    //     return view('mhs.presensi', $datas);
    // }


    public function matkulMhs($id)
    {
        $kelas = Praktikum::where('id_praktikum', $id)->get();
        
        $proses_praktikum = Pertemuan::join('proses_praktikum', 'pertemuan.id_praktikum', '=', 'proses_praktikum.id_praktikum')
                            ->where('pertemuan.id_praktikum', $id)
                            ->where('id_user', Auth::user()->id)
                            ->get();
        // dd($proses_praktikum);
         $data_materi = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        $data_tugas = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();
        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'mk'=>$kelas,
            'data_materi'=>$data_materi,
            'data_tugas'=>$data_tugas
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
        // dd($proses_praktikum);
         $data_materi = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        $data_tugas = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();
        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'mk'=>$kelas,
            'data_materi'=>$data_materi,
            'data_tugas'=>$data_tugas
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
    
        $data_materi = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        $data_tugas = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();
        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'mk'=>$kelas,
            'data_materi'=>$data_materi,
            'data_tugas'=>$data_tugas
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
                    '_file' => 'required',
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

   public function uploadTugas(Request $request){

        $request->validate([
                    'id'=>'required',
                    '_file',
                    'judul_tugas'=>'required',
                    'deskripsi',
                    'wmp'=>'required',
                    'wap'=>'required',
                    'wcp'
                ]);
        // dd($request->all());
        $fileModel = new Wadah_tugas;

        if($request->all()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path), $newname);

            $fileModel->id_pertemuan= $request->id;
            $fileModel->file_tugas = $request->_file->getClientOriginalName();
            $fileModel->judul_tugas = $request->judul_tugas;
            $fileModel->deskripsi_tugas = $request->deskripsi;
            $fileModel->waktu_mulai = $request->wmp;
            $fileModel->waktu_selesai = $request->wap;
            $fileModel->waktu_cutoff = $request->wcp;
            
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
            // dd($cek);
            return view('asist.participants', $cek);
        }

        public function partisipan($id)
        {
            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->join('roles', 'users.id', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->orWhere('roles.id_praktikum', $id)
                         ->where('proses_praktikum.id_proses', $id)
                         ->get();
            // dd($data);
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

            // $nilai = Nilai::join('uploadtugas', 'nilai.id_user')

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
                    if($data)
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

     public function deletetugas($id){
        $query = Wadah_tugas::where('id_pertemuan', $id)->Delete();
         
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

     public function tampilTugas($id){  
        $kelas = Praktikum::join('pertemuan', 'praktikum.id_praktikum', 'pertemuan.id_praktikum')
                            ->where('id_pertemuan', $id)
                            ->get();

        $nama_dosen = Proses_praktikum::join('users', 'proses_praktikum.id_user', 'users.id')
                                      ->join('pertemuan', 'proses_praktikum.id_praktikum', 'pertemuan.id_praktikum')
                                      ->where('pertemuan.id_pertemuan', $id)
                                      ->where('id_status', 2)
                                      ->get();

        $nama_asisten = Roles::join('users', 'roles.id_user', 'users.id')
                             ->join('pertemuan', 'roles.id_praktikum', 'pertemuan.id_praktikum')
                             ->where('pertemuan.id_pertemuan', $id)
                             ->where('roles.id_status', 3)
                             ->get();

        $data = Pertemuan::join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                        ->where('wadah_tugas.id_pertemuan', $id)
                        ->get();

        $assign = Uploadtugas::join('wadah_tugas', 'uploadtugas.id_wadahtugas', 'wadah_tugas.id_wadahtugas')
                            ->where('wadah_tugas.id_pertemuan', $id)
                            ->first();
           
        $data = [
            'mk'=>$kelas,
            'nama_dosen'=>$nama_dosen,
            'nama_asisten'=>$nama_asisten,
            'data'=>$data,
            'assign'=>$assign
        ];
        return view('mhs.kumpultugas', $data);
    }

    public function kumpulTugas(Request $request){

        $request->validate([
                    'id'=>'required',
                    'id_user'=>'required',
                    'id_wadahtugas'=>'required',
                    '_file' => 'required'
                ]);
        // dd($request->all());
        $fileModel = new Uploadtugas;

        if($request->all()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path), $newname);
            
            $fileModel->id_praktikum = $request->id;
            $fileModel->id_user = $request->id_user;
            $fileModel->id_wadahtugas = $request->id_wadahtugas;
            $fileModel->namafile_tugas = $request->_file->getClientOriginalName();
            $fileModel->waktu_submit = Carbon::now()->format('Y-m-d H:i:s');
            $query = $fileModel->save();

            if($query){
                return response()->json(['status'=>1,'msg'=>'File Berhasil Diunggah']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
            }
        }
   }

   public function dataAbsen($id)
   {
       $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $id)
                            ->simplePaginate(16);

        $kelas = Praktikum::where('id_praktikum', $id)->get();

        $cek = Presensi::join('wadahpresensi', 'presensi.id_wadah', 'wadahpresensi.id_wadah')
                        ->where('presensi.id_user', Auth::user()->id)
                        ->first();

        $currentTime = Carbon::now();
        $absen = [
            'mk'=>$kelas,
            'absen'=>$absen,
            'cek'=>$cek,
            'waktu'=>$currentTime
        ];

       return view('mhs.presensi',  $absen);
   }

   public function signature(Request $request)
    {

        $request->validate([
                    'signed'=>'required',
                    'id_user'=>'required',
                    'id_wadah'=>'required'
                ]);

        $folderPath = public_path('uploads/');
        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);

        $signature = uniqid() . '.'.$image_type;
           
        $file = $folderPath . $signature;

        file_put_contents($file, $image_base64);
        
        $save = new Presensi;
                
        if($request->all()) {
        
        setlocale(LC_ALL, 'IND');
        $save->fotottd_presensi = $signature;
        $save->id_user = $request->id_user;
        $save->waktu_presensi = Carbon::now()->format('Y-m-d H:i:s');
        $save->id_wadah = $request->id_wadah;
        $save->save();

        return back()->with('success', 'success Full upload signature');
    
        }
    }

    public function deletesubmission($id){
        $query = uploadtugas::where('id_tugas', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

     public function formasisten()
     {
         $form = Statusform::first();

         $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')
                                    ->where('proses_praktikum.id_user', Auth::user()->id)->get();

         $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->where('id_status', '=', 3)
                    ->Where('id_user', '=', Auth::user()->id)
                    ->first();

         $matakuliah = Wadahform::join('praktikum', 'wadahform.id_praktikum', 'praktikum.id_praktikum')
                                ->get();

        $datas = [
            'form'=>$form,
            'data'=>$data,
            'course'=>$course,
            'mk'=>$matakuliah
        ];

         return view('mhs.daftarasisten', $datas);
     }

     public function daftar(Request $request)
     {
         $validator = \Validator::make($request->all(),[
             'id_user',
            'number'=>'required',
            'ipk'=>'required',
            'mk1'=>'required',
            'nmk1'=>'required',
            'mk2'=>'required|different:mk1',
            'nmk2'=>'required',
            '_file'=>'required',
            ],[
                'number.required'=>"No Hp tidak boleh kosong",
                'ipk.required'=>"IPK tidak boleh kosong",
                'mk1.required'=>"Pilih salah satu matkul",
                'nmk1.required'=>"Pilih nilai matkul",
                'mk2.required'=>"Pilih salah satu matkul",
                'mk2.different'=>"MK 1 dan MK 2 harus beda",
                'nmk2.required'=>"Pilih nilai matkul",
                '_file.required'=>"Upload Transkrip Nilai"
        ]);
        // dd($validator);
        if($validator->fails()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }else{          
            
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            // $fileName = time().'_'.$request->_file->getClientOriginalName();
            // $filePath = $request->file('_file')->storeAs('uploads', $fileName, 'public');
            $filePath = $request->_file->move(public_path($path, $newname));

            $daftar = new Rekrutasisten;

            $daftar->id_user = $request->id_user;
            $daftar->praktikum_pilihan1 = $request->mk1;
            $daftar->nilai_pilihan1 = $request->nmk1;
            $daftar->praktikum_pilihan2 = $request->mk2;
            $daftar->nilai_pilihan2 = $request->nmk2;
            $daftar->IPK = $request->ipk;
            $daftar->Nohp = $request->number;
            $daftar->filetranskripnilai = $request->_file->getClientOriginalName();
            $query = $daftar->save();

            if($query){
                return response()->json(['status'=>1,'msg'=>'Form Berhasil Disubmit']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal submit form']);
            }
        }
     }

}
