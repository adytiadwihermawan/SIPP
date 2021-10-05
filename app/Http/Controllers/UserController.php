<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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
    }
    public function dsnProfile()
    {
        $course = Proses_praktikum::leftJoin('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('dsn.profile', compact('course'));
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
            'data_tugas'=>$data_tugas,
        ];
        return view('dsn.matakuliah', $course);

    }

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
        // dd($cek);
        $fileModel = new Wadah_tugas;
        if($request->all()) {
            $path = 'uploads/';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());

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
                         ->select('nama_user', 'status')
                         ->groupBy('nama_user', 'status')
                         ->orderBy('status', 'asc')
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
                'course'=>$course,
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
                         ->select('nama_user', 'status')
                         ->groupBy('nama_user', 'status')
                         ->orderBy('status', 'asc')
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
            $data = User::join('proses_praktikum', 'users.id', 'proses_praktikum.id_user')
                         ->leftjoin('roles', 'users.id', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $id)
                         ->orWhere('roles.id_praktikum', $id)
                         ->select('nama_user', 'status')
                         ->groupBy('nama_user', 'status')
                         ->orderBy('status', 'asc')
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


         public function dsnGrade(Request $request, $id)
        {
            $grade = Uploadtugas::join('wadah_tugas', 'uploadtugas.id_wadahtugas', 'wadah_tugas.id_wadahtugas')
                                ->join('users', 'uploadtugas.id_user', 'users.id')
                                ->leftjoin('nilai', 'uploadtugas.id_tugas', 'nilai.id_tugas')
                                ->where('wadah_tugas.id_pertemuan', $id)
                                ->select(
                                    'uploadtugas.id_tugas', 
                                    'nilai', 
                                    'username', 
                                    'nama_user', 
                                    'namafile_tugas', 
                                    'uploadtugas.id_wadahtugas')
                                ->get();
            // dd($grade);
            if ($request->ajax()) {
            return Datatables::of($grade)
                    ->addColumn('grade', function($row){
                        if($row->nilai){
                            $nilai = $row->nilai;
                            return $nilai;
                            
                        }else{
                            $btn =  "
                             <a data-id='".$row->id_tugas."' class='idtugas'>
                             <button class='grade btn btn-info' data-toggle='modal' data-target='#nilai' style='text-align: center' id='".$row->id_tugas."'>Grade</button>
                             </a>";
                            return $btn;
                        }
                    })
                    ->addColumn('file', function($row){
                        $btn = "<a href='/downloadfile".$row->namafile_tugas."' data-id='" . $row->id_tugas . "' title='edit'>$row->namafile_tugas</a>";
                        return $btn;
                    })
                    ->rawColumns(['grade', 'file'])
                    ->make(true);
            }
            $mk = Praktikum::join('pertemuan', 'praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();

            $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_pertemuan', $id)
                                ->get();

            return view('dsn.grades', [
                'grade'=>$grade,
                'mk'=>$mk,
                'course'=>$course,
            ]);
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
        $post = $request->all();

        $data = new Wadahpresensi;
        $data->id_praktikum = $post['id'];
        $data->urutanpertemuan = $post['pertemuan'];
        $data->keterangan = $post['materi'];
        $data->waktu_mulai = $post['wmp'];
        $data->waktu_berakhir = $post['wap'];
        $data->tanggal = $post['tanggal'];
        $query = $data->save();
        // dd($query);
        if($query){
            return response()->json(['status'=>1,'msg'=>'Absen berhasil dibuat']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }
            
    }

    public function deletemateri($id){
        $query = Materi::where('id_materi', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

     public function deletetugas($id){
        $query = Wadah_tugas::where('id_wadahtugas', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

    public function nilai(Request $request){
        
       $request->validate([
                    'id'=>'required',
                    'nilai'=>'required',
                ]);
        //  dd($request->all());
        $query = Nilai::insert([
                        'id_tugas'=>$request->input('id'),
                        'nilai'=>$request->input('nilai'),
                    ]);
        // dd($query);
        if($query){
            return response()->json(['status'=>1,'msg'=>'Tugas Berhasil di Nilai']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }

    }

     public function tampilTugas($id_praktikum, $id_pertemuan, $id){  
        $kelas = Praktikum::join('pertemuan', 'praktikum.id_praktikum', 'pertemuan.id_praktikum')
                            ->where('pertemuan.id_pertemuan', $id_pertemuan)
                            ->get();

        $nama_dosen = Proses_praktikum::join('users', 'proses_praktikum.id_user', 'users.id')
                                      ->join('pertemuan', 'proses_praktikum.id_praktikum', 'pertemuan.id_praktikum')
                                      ->where('pertemuan.id_praktikum', $id_praktikum)
                                      ->where('id_status', 2)
                                      ->select('nama_user')
                                      ->groupBy('nama_user')
                                      ->get();

        $nama_asisten = Roles::join('users', 'roles.id_user', 'users.id')
                             ->join('pertemuan', 'roles.id_praktikum', 'pertemuan.id_praktikum')
                             ->where('pertemuan.id_praktikum', $id_praktikum)
                             ->where('roles.id_status', 3)
                             ->select('nama_user')
                             ->groupBy('nama_user')
                             ->get();

        $data = Pertemuan::join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                        ->where('wadah_tugas.id_wadahtugas', $id)
                        ->get();

        $assign = Uploadtugas::join('wadah_tugas', 'uploadtugas.id_wadahtugas', 'wadah_tugas.id_wadahtugas')
                            ->where('wadah_tugas.id_wadahtugas', $id)
                            ->first();
        //    dd($data);
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

   public function rekapAbsen(Request $request, $id)
   {
       $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $id)
                            ->simplePaginate(16);

        $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $id)
                                ->get();
                                
        $presensi = Presensi::rightjoin('users', 'presensi.id_user', 'users.id')
                                ->leftjoin('roles', 'presensi.id_user', 'roles.id_user')
                                ->leftjoin('proses_praktikum', 'users.id', 'proses_praktikum.id_user')
                                ->select('nama_user', 'id', 'username', 'users.id_status')
                                ->groupBy('nama_user', 'id', 'username', 'users.id_status')
                                ->where('proses_praktikum.id_praktikum', $id)
                                ->where('users.id_status', 4)
                                ->get();
        
                            // dd($presensi);
        $kelas = Praktikum::where('id_praktikum', $id)->get();
        if ($request->ajax()) {
            return Datatables::of($presensi)
                    ->addColumn('keterangan', function($row){
                        if($row->id_user){
                            return "Hadir";
                            
                        }else{
                            return "Tanpa Keterangan";
                        }
                    })
                    ->rawColumns(['keterangan'])
                    ->make(true);
            }

        // dd($currentTime);
        $absen = [
            'mk'=>$kelas,
            'absen'=>$absen,
            'course'=>$course
        ];

       return view('dsn.presensi',  $absen);
   }

   public function updateAbsen(Request $request){
        $request->validate([
            'id' => 'required',
            'pertemuan',
            'tanggal' => 'required',
            'materi',
            'wmp' => 'required',
            'wap' => 'required'
        ]);

        $update = Wadahpresensi::where('id_wadah', $request->input('id'))
                            ->update([
                                'id_wadah'=>$request->input('id'),
                                'urutanpertemuan'=>$request->input('pertemuan'),
                                'tanggal'=>$request->input('tanggal'),
                                'keterangan'=>$request->input('materi'),
                                'waktu_mulai'=>$request->input('wmp'),
                                'waktu_berakhir'=>$request->input('wap')
                        ]);
        // dd($update);
        if(!$update){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal memperbaharui pertemuan']);
            }                
            else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Diperbaharui']);
            }
    }

   public function dataAbsen($id)
   {

       $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $id)
                            ->simplePaginate();

        $kelas = Praktikum::where('id_praktikum', $id)->get();

        $cek = Presensi::join('wadahpresensi', 'presensi.id_wadah', 'wadahpresensi.id_wadah')
                        ->where('presensi.id_user', Auth::user()->id)
                        ->get();
                        // ->get(['presensi.id_wadah', 'fotottd_presensi'])->toArray();
        // dd($cek);

        $currentTime = Carbon::now();
        // dd($currentTime);
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
