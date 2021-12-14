<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
use Illuminate\Support\Str;

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
        $data = Roles::join('users', 'roles.id_user', 'users.id')->get();
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
       $course = Proses_praktikum::leftJoin('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')->where('id_user', Auth::user()->id)->get();

        return view('asist.presensi', compact('course'));
    }

   public function matkulAsisten($nama_praktikum)
    {
        $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

        $cekid = Wadahpresensi::first();

        // dd($cekid);

        $kelas = Praktikum::where('id_praktikum',  $cek->id_praktikum)->get();

        $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

        $presensi = Presensi::get();
        
        $proses_praktikum = Pertemuan::join('roles', 'pertemuan.id_praktikum', '=', 'roles.id_praktikum')
                            ->where('pertemuan.id_praktikum', $cek->id_praktikum)
                            ->where('id_user', Auth::user()->id)
                            ->get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();
    
        $data_materi = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        $data_tugas = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        // dd($data);
        $course = [
            'course'=>$proses_praktikum,
            'course1'=>$course1,
            'mk'=>$kelas,
            'data_materi'=>$data_materi,
            'absen'=>$absen,
            'presensi'=>$presensi,
            'data_tugas'=>$data_tugas,
            'cekid'=>$cekid
        ];

        // dd($course);
        return view('asist.matakuliah', $course);

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

    public function matkulDsn($nama_praktikum)
    {

        $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

        $cekid = Wadahpresensi::first();

        // dd($cekid);

        $kelas = Praktikum::where('id_praktikum',  $cek->id_praktikum)->get();

        $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

        // dd($absen);

        $presensi = Presensi::get();

        
        $proses_praktikum = Pertemuan::join('proses_praktikum', 'pertemuan.id_praktikum', '=', 'proses_praktikum.id_praktikum')
                            ->where('proses_praktikum.id_praktikum', $cek->id_praktikum)
                            ->where('id_user', Auth::user()->id)
                            ->get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

        // dd($course1);
    
        $data_materi = Materi::join('pertemuan', 'materi.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        $data_tugas = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', '=', 'pertemuan.id_pertemuan')
                        ->get();

        // dd($data_tugas);
        $course = [
            'course'=>$proses_praktikum,
            'course1'=>$course1,
            'mk'=>$kelas,
            'data_materi'=>$data_materi,
            'absen'=>$absen,
            'presensi'=>$presensi,
            'data_tugas'=>$data_tugas,
            'cekid'=>$cekid
        ];

        // dd($course);
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
            $path = 'storage';
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

         $validator = \Validator::make($request->all(),[
                'id'=>'required',
                '_file',
                'judul_tugas'=>'required',
                'deskripsi',
                'wmp'=>'required|after:' . Carbon::now(),
                'wap'=>'required|after:wmp',
                'wcp'=>'nullable|after:wap'
            ],[
                'id.required'=>"Pertemuan tidak boleh kosong",
                'judul_tugas.required'=>"Judul tugas tidak boleh kosong",
                'wmp.required'=>"Waktu mulai pengumpulan tidak boleh kosong",
                'wmp.after'=>"Waktu pengumpulan tidak boleh melewati waktu anda sekarang",
                'wap.required'=>"Waktu akhir pengumpulan tidak boleh kosong",
                'wap.after'=>"Waktu akhir pengumpulan tidak boleh mendahului waktu mulai pengumpulan",
                'wcp.after'=>"Waktu cut-offf tidak boleh mendahului waktu akhir pengumpulan"
        ]);
        // dd($cek);
        $fileModel = new Wadah_tugas;
       
        if($validator->passes()) {
            if(empty($request->input('_file'))){
                $fileModel->id_pertemuan= $request->id;
                $fileModel->judul_tugas = $request->judul_tugas;
                $fileModel->deskripsi_tugas = $request->deskripsi;
                $fileModel->waktu_mulai = $request->wmp;
                $fileModel->waktu_selesai = $request->wap;
                $fileModel->waktu_cutoff = $request->wcp;
                
                $query = $fileModel->save(); 
            }else{
                $path = 'storage';
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
            }

            if($query){
                return response()->json(['status'=>1,'msg'=>'File Berhasil Diunggah']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
            }
        }else{
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
   }

   public function downloadFile(Request $request, $file)
   {
        $path = 'storage/'.$file;
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

    public function editpertemuan(Request $request){

        $data = Pertemuan::where('id_pertemuan', $request->id)
                ->first();
        return response()->json($data);
    }

    public function editabsen(Request $request){

        $data = Wadahpresensi::where('id_wadah', $request->id)
                ->first();
        return response()->json($data);
    }

    public function edittugas(Request $request){

        $data = Wadah_tugas::where('id_wadahtugas', $request->id)
                ->first();
        return response()->json($data);
    }

    public function viewrekap(Request $request, $nama_praktikum, $id){

        $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

        $cekid = $id;

        // dd($cekid);

        $presensi = Presensi::rightJoin('users', function($join) use($cekid){
                        $join->on('users.id', '=', 'presensi.id_user');
                        $join->where('id_wadah', $cekid);
                    })
                    ->join('proses_praktikum', 'users.id', 'proses_praktikum.id_user')
                    ->where('id_status', 4)
                    ->where('proses_praktikum.id_praktikum', $cek->id_praktikum)
                    ->get();

        // dd($presensi);

        $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->leftjoin('presensi', 'wadahpresensi.id_wadah', 'presensi.id_wadah')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();
        // dd($absen);

        $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $cek->id_praktikum)
                                ->get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

        $mk = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

        if ($request->ajax()) {
            
            return Datatables::of($presensi)
                    ->addColumn('nama', function($row){
                        return $row->nama_user;
                    })
                    ->addColumn('nim', function($row){
                        return $row->username;
                    })
                    ->addColumn('keterangan', function($row){
                        if($row->id_wadah){
                            return "Hadir";
                            
                        }else{
                            return "Tanpa Keterangan";
                        }
                    })
                    ->rawColumns(['keterangan'])
                    ->make(true);
            }
        return view('dsn.rekap', compact(['presensi', 'absen', 'course', 'course1', 'mk', 'cekid']));
    }

    public function viewrekapasisten(Request $request, $nama_praktikum, $id){

        $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

        $cekid = $id;

        // dd($cekid);

        $presensi = Presensi::rightJoin('users', function($join) use($cekid){
                        $join->on('users.id', '=', 'presensi.id_user');
                        $join->where('id_wadah', $cekid);
                    })
                    ->join('proses_praktikum', 'users.id', 'proses_praktikum.id_user')
                    ->where('id_status', 4)
                    ->where('proses_praktikum.id_praktikum', $cek->id_praktikum)
                    ->get();

        // dd($presensi);

        $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->leftjoin('presensi', 'wadahpresensi.id_wadah', 'presensi.id_wadah')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();
        // dd($absen);

        $course = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->where('pertemuan.id_praktikum', $cek->id_praktikum)
                                ->get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

        $mk = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

        if ($request->ajax()) {
            
            return Datatables::of($presensi)
                    ->addColumn('nama', function($row){
                        return $row->nama_user;
                    })
                    ->addColumn('nim', function($row){
                        return $row->username;
                    })
                    ->addColumn('keterangan', function($row){
                        if($row->id_wadah){
                            return "Hadir";
                            
                        }else{
                            return "Tanpa Keterangan";
                        }
                    })
                    ->rawColumns(['keterangan'])
                    ->make(true);
            }
        return view('asist.rekap', compact(['presensi', 'absen', 'course', 'course1', 'mk', 'cekid']));
    }

    public function updatePertemuan(Request $request){

        $validator = \Validator::make($request->all(),[
                'id_pertemuan',
                'nama_pertemuan'=>'required',
                'deskripsi'
            ],[
                'nama_pertemuan.required'=>"Nama pertemuan tidak boleh kosong",
        ]);

        
        if($validator->passes()) {

            $update = Pertemuan::where('id_pertemuan', $request->input('id_pertemuan'))
                                ->update([
                                    'id_pertemuan'=>$request->input('id_pertemuan'),
                                    'nama_pertemuan'=>$request->input('nama_pertemuan'),
                                    'deskripsi'=>$request->input('deskripsi')
                            ]);

            // $update = Pertemuan::updateOrCreate([
            //     'id_pertemuan'=>$request->id
            //     ],
            //     [
            //         'nama_pertemuan'=>$request->nama_pertemuan,
            //         'deskripsi'=>$request->deskripsi,
            //     ]);
            // dd($update);
            if(!$update){
                    return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal memperbaharui pertemuan']);
                }                
                else{
                    return response()->json(['status'=>1,'msg'=>'Data Berhasil Diperbaharui']);
                }
            }
        else{
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }

    public function updateTugas(Request $request){

          $validator = \Validator::make($request->all(),[
                'id',
                'id_pertemuan',
                '_file',
                'judul_tugas'=>'required',
                'deskripsi',
                'wmp'=>'required|after:yesterday',
                'wap'=>'required|after:wmp',
                'wcp'=>'nullable|after:wap'
            ],[
                'judul_tugas.required'=>"Judul tugas tidak boleh kosong",
                'wmp.required'=>"Waktu mulai pengumpulan tidak boleh kosong",
                'wmp.after'=>"Waktu pengumpulan tidak boleh melewati waktu kemarin",
                'wap.required'=>"Waktu akhir pengumpulan tidak boleh kosong",
                'wap.after'=>"Waktu akhir pengumpulan tidak boleh mendahului waktu mulai pengumpulan",
                'wcp.after'=>"Waktu cut-offf tidak boleh mendahului waktu akhir pengumpulan"
        ]);
        // dd($cek);
       
        if($validator->passes()) {
            if(empty($request->input('_file'))){
                $update = Wadah_tugas::where('id_wadahtugas', $request->input('id'))
                            ->update([
                                'id_pertemuan'=>$request->input('id_pertemuan'),
                                'judul_tugas'=>$request->input('judul_tugas'),
                                'deskripsi_tugas'=>$request->input('deskripsi'),
                                'waktu_mulai'=>$request->input('wmp'),
                                'waktu_selesai'=>$request->input('wap'),
                                'waktu_cutoff'=>$request->input('wcp')
                        ]);

            }else{
                $path = 'storage';
                $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());

                $filePath = $request->_file->move(public_path($path), $newname);

                $update = Wadah_tugas::where('id_wadahtugas', $request->input('id'))
                            ->update([
                                'id_pertemuan'=>$request->input('id_pertemuan'),
                                'file_tugas'=>$request->input('_file')->getClientOriginalName(),
                                'judul_tugas'=>$request->input('judul_tugas'),
                                'deskripsi_tugas'=>$request->input('deskripsi'),
                                'waktu_mulai'=>$request->input('wmp'),
                                'waktu_selesai'=>$request->input('wap'),
                                'waktu_cutoff'=>$request->input('wcp')
                        ]);
            }

            if($update){
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Diubah']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Tidak Ada Perubahan Data']);
            }
        }else{
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    } 

        public function dsnPartisipan($nama_praktikum)
        {
        
            $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

            $cekid =  Wadahpresensi::first();

            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->leftjoin('roles', 'users.id', '=', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $cek->id_praktikum)
                         ->orwhere('roles.id_praktikum', $cek->id_praktikum)
                         ->select('nama_user', 'status', 'username')
                         ->groupBy('nama_user', 'status', 'username')
                         ->orderBy('status', 'asc')
                         ->get();
            // dd($data);
            $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

            $kelas = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

            $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

            $presensi = Presensi::get();

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
                'cekid'=>$cekid,
                'data'=>$data,
                'absen'=>$absen,
                'presensi'=>$presensi,
                'course1'=>$course1,
            ];
            return view('dsn.participants', $cek);
        }

         public function asistPartisipan($nama_praktikum)
        {
            $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

            $cekid =  Wadahpresensi::first();

            $data = User::join('proses_praktikum', 'users.id', '=', 'proses_praktikum.id_user')
                         ->leftjoin('roles', 'users.id', '=', 'roles.id_user')
                         ->join('status_user', 'users.id_status', 'status_user.id_status') 
                         ->where('proses_praktikum.id_praktikum', $cek->id_praktikum)
                         ->orwhere('roles.id_praktikum', $cek->id_praktikum)
                         ->select('username', 'nama_user', 'status')
                         ->groupBy('username', 'nama_user', 'status')
                         ->orderBy('status', 'asc')
                         ->get();
            // dd($data);
            $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

            $kelas = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

            $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

            $presensi = Presensi::get();
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
                'cekid'=>$cekid,
                'data'=>$data,
                'absen'=>$absen,
                'presensi'=>$presensi,
                'course1'=>$course1,
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

            // $cek = Wadah_tugas::where("judul_tugas", "like", "%".$nama."%")->first();

            $grade = Uploadtugas::join('wadah_tugas', 'uploadtugas.id_wadahtugas', 'wadah_tugas.id_wadahtugas')
                                ->join('users', 'uploadtugas.id_user', 'users.id')
                                ->leftjoin('nilai', 'uploadtugas.id_tugas', 'nilai.id_tugas')
                                ->where('uploadtugas.id_wadahtugas', $id)
                                // ->groupBy('uploadtugas.id_wadahtugas')
                                ->get();
            // dd($grade);
            if ($request->ajax()) {
            return Datatables::of($grade)
                    ->addColumn('nama', function($row){
                                return $row->nama_user;
                            })
                    ->addColumn('nim', function($row){
                                return $row->username;
                            })
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
                        
                            $pecah = explode(".", $row->namafile_tugas);
                            $ekstensi = $pecah[1];
                            if ($ekstensi == "docx" || $ekstensi == "pdf" || $ekstensi == "ppt"){
                                $btn = "<a href='/downloadfile".$row->namafile_tugas."' data-id='" . $row->id_user . "' title='download'>$row->namafile_tugas</a>";
                            } else {
                                $btn = "<a href='/storage/$row->namafile_tugas' target='_blank' data-id='" . $row->id_user . "' title='view'>$row->namafile_tugas</a>";
                            }
                            return $btn;
                    })
                    ->rawColumns(['nama', 'nim','grade', 'file'])
                    ->make(true);
            }
            $mk = Praktikum::join('pertemuan', 'praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
                                ->join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                                ->where('wadah_tugas.id_wadahtugas', $id)
                                ->get();

            $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->get();

            $cekid = Wadahpresensi::first();

            $presensi = Presensi::get();

            $course1 = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                                ->where('wadah_tugas.id_wadahtugas', $id)
                                ->get();

            return view('dsn.grades', compact('grade','mk', 'absen', 'cekid', 'presensi', 'course1'));
        }
        
        public function asistGrade(Request $request, $id)
        {
            $grade = Uploadtugas::join('wadah_tugas', 'uploadtugas.id_wadahtugas', 'wadah_tugas.id_wadahtugas')
                                ->join('users', 'uploadtugas.id_user', 'users.id')
                                ->leftjoin('nilai', 'uploadtugas.id_tugas', 'nilai.id_tugas')
                                ->where('uploadtugas.id_wadahtugas', $id)
                                // ->groupBy('uploadtugas.id_wadahtugas')
                                ->get();
            // dd($grade);
            if ($request->ajax()) {
            return Datatables::of($grade)
                    ->addColumn('nama', function($row){
                                return $row->nama_user;
                            })
                    ->addColumn('nim', function($row){
                                return $row->username;
                            })
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
                        
                            $pecah = explode(".", $row->namafile_tugas);
                            $ekstensi = $pecah[1];
                            if ($ekstensi == "docx" || $ekstensi == "pdf" || $ekstensi == "ppt"){
                                $btn = "<a href='/downloadfile".$row->namafile_tugas."' data-id='" . $row->id_user . "' title='download'>$row->namafile_tugas</a>";
                            } else {
                                $btn = "<a href='/storage/$row->namafile_tugas' target='_blank' data-id='" . $row->id_user . "' title='view'>$row->namafile_tugas</a>";
                            }
                            return $btn;
                    })
                    ->rawColumns(['nama', 'nim','grade', 'file'])
                    ->make(true);
            }
            $mk = Praktikum::join('pertemuan', 'praktikum.id_praktikum', '=', 'pertemuan.id_praktikum')
                                ->join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                                ->where('wadah_tugas.id_wadahtugas', $id)
                                ->get();

            $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->get();

            $cekid = Wadahpresensi::first();

            $presensi = Presensi::get();

            $course1 = Pertemuan::join('praktikum', 'pertemuan.id_praktikum', '=', 'praktikum.id_praktikum')
                                ->join('wadah_tugas', 'pertemuan.id_pertemuan', 'wadah_tugas.id_pertemuan')
                                ->where('wadah_tugas.id_wadahtugas', $id)
                                ->get();

            return view('asist.grades', compact('grade','mk', 'absen', 'cekid', 'presensi', 'course1'));
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
                            ->where('uploadtugas.id_wadahtugas', $id)
                            ->where('id_user', Auth::user()->id)
                            ->get();
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

        $input_data = $request->all();

        $validator = \Validator::make(
        $input_data, [
        '_file.*' => 'required|file|mimes:xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff'
        ],[
            '_file.*.required' => 'Please upload file',
            '_file.*.mimes' => 'Only xlsx,xls,csv,jpg,jpeg,png,bmp,doc,docx,pdf,tif,tiff images are allowed',

        ]
        );

        if($request->hasFile('_file')) {
            foreach ($request->file('_file') as $file) {
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('storage'), $fileName); 
                $files = $fileName;
                $save = new Uploadtugas;
        

        $save->id_praktikum = $request->id;
        $save->id_user = $request->id_user;
        $save->id_wadahtugas = $request->id_wadahtugas;
        $save->namafile_tugas = $files;
        $save->waktu_submit = Carbon::now()->format('Y-m-d H:i:s');
        $query = $save->save();
         }


        //  $query = Uploadtugas::create([
        //             'id_praktikum'=>$request->id,
        //             'id_user'=>$request->id_user,
        //             'id_wadahtugas'=>$request->id_wadahtugas,
        //             'namafile_tugas'=> $files,
        //             'waktu_submit'=>Carbon::now()->format('Y-m-d H:i:s')
        //     ]);

            if($query){
                return response()->json(['status'=>1,'msg'=>'File Berhasil Diunggah']);
            }                
            else{
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
            }
        }
   }

   public function rekapAbsen(Request $request, $nama_praktikum)
   {
       $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

       $cekid = Wadahpresensi::first();

       $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

        $presensi = Presensi::get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

        $mk = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

         if ($request->ajax()) {
            return Datatables::of($absen)
                    ->addIndexColumn()
                    ->addColumn('hari', function($row){
                            if(empty($row->hari_praktikum)){
                                return "-";
                            }else{
                                return $row->hari_praktikum;
                            }
                        
                    })
                    ->addColumn('jam', function($row){
                            if(empty($row->jam_praktikum)){
                                return "-";
                            }else{
                                return date('H:i', strtotime($row->jam_praktikum));
                            }
                    })
                    ->addColumn('pertemuan', function($row){
                            return $row->urutanpertemuan;
                    })
                    ->addColumn('tanggal', function($row){
                            return $row->tanggal->format('l, j F Y');
                    })
                    ->addColumn('materi', function($row){
                            return $row->keterangan;
                    })
                    ->addColumn('waktu', function($row){
                            $keterangan = "Mulai Berlaku
                                           <br>
                                           ".$row->waktu_mulai->format('l, j F Y')." jam
                                           <br>
                                           ".$row->waktu_mulai->format('H:i')."
                                           <br>
                                           s.d
                                           <br>
                                           ".$row->waktu_berakhir->format('l, j F Y')." jam
                                           <br>
                                           ".$row->waktu_berakhir->format('H:i')."";
                            return $keterangan;
                    })
                    ->addColumn('action', function($row){

                             $btn = "<a href='/rekap/".$row->nama_praktikum."/$row->id_wadah' class='btn btn-info view' data-id='" . $row->id_wadah ."' title='view'><i class='fas fa-edit'>View</i></a>";

                             $btn .= " <a href='javascript:void(0)' class='editpresensi btn  btn-success' data-id='" . $row->id_wadah . "' title='edit'><i class='fa fa-edit'>Edit</i></a>";

                             $btn .= " <a href='javascript:void(0)' class='deletepresensi btn  btn-danger' data-id='" . $row->id_wadah . "' title='delete'><i class='fa fa-trash'>Delete</i></a>";

                            return $btn;
                        
                    })
                    ->rawColumns(['hari', 'jam', 'pertemuan', 'tanggal', 'materi', 'waktu', 'action'])
                    ->make(true);
        }
        
       return view('dsn.presensi',  compact(['cekid', 'mk', 'absen', 'presensi', 'course1']));
   }


    public function rekapAsisten(Request $request, $nama_praktikum)
   {
       $cek = Praktikum::where("nama_praktikum", "like", "%".$nama_praktikum."%")->first();

       $cekid = Wadahpresensi::first();

       $absen = Wadahpresensi::join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->where('wadahpresensi.id_praktikum', $cek->id_praktikum)
                            ->get();

        $presensi = Presensi::get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $cek->id_praktikum)
                                ->get();

        $mk = Praktikum::where('id_praktikum', $cek->id_praktikum)->get();

         if ($request->ajax()) {
            return Datatables::of($absen)
                    ->addIndexColumn()
                    ->addColumn('hari', function($row){
                            if(empty($row->hari_praktikum)){
                                return "-";
                            }else{
                                return $row->hari_praktikum;
                            }
                        
                    })
                    ->addColumn('jam', function($row){
                            if(empty($row->jam_praktikum)){
                                return "-";
                            }else{
                                return date('H:i', strtotime($row->jam_praktikum));
                            }
                    })
                    ->addColumn('pertemuan', function($row){
                            return $row->urutanpertemuan;
                    })
                    ->addColumn('tanggal', function($row){
                            return $row->tanggal->format('l, j F Y');
                    })
                    ->addColumn('materi', function($row){
                            return $row->keterangan;
                    })
                    ->addColumn('waktu', function($row){
                            $keterangan = "Mulai Berlaku
                                           <br>
                                           ".$row->waktu_mulai->format('l, j F Y')." jam
                                           <br>
                                           ".$row->waktu_mulai->format('H:i')."
                                           <br>
                                           s.d
                                           <br>
                                           ".$row->waktu_berakhir->format('l, j F Y')." jam
                                           <br>
                                           ".$row->waktu_berakhir->format('H:i')."";
                            return $keterangan;
                    })
                    ->addColumn('action', function($row){

                             $btn = "<a href='/rekap/".$row->nama_praktikum."/$row->id_wadah' class='btn btn-info view' data-id='" . $row->id_wadah ."' title='view'><i class='fas fa-edit'>View</i></a>";

                             $btn .= " <a href='javascript:void(0)' class='editpresensi btn  btn-success' data-id='" . $row->id_wadah . "' title='edit'><i class='fa fa-edit'>Edit</i></a>";

                             $btn .= " <a href='javascript:void(0)' class='deletepresensi btn  btn-danger' data-id='" . $row->id_wadah . "' title='delete'><i class='fa fa-trash'>Delete</i></a>";

                            return $btn;
                        
                    })
                    ->rawColumns(['hari', 'jam', 'pertemuan', 'tanggal', 'materi', 'waktu', 'action'])
                    ->make(true);
        }
        
       return view('asist.presensi',  compact(['cekid', 'mk', 'absen', 'presensi', 'course1']));
   }


   public function updateAbsen(Request $request){
        $validator =   \Validator::make($request->all(),[
            'id' => 'required',
            'pertemuan',
            'tanggal' => 'required',
            'materi',
            'wmp' => 'required|after:' . Carbon::now(),
            'wap' => 'required|after:wmp'
        ],[
            'tanggal.required'=>"tanggal tidak boleh kosong",
            'wmp.required'=>"waktu mulai presensi tidak boleh kosong",
            'wmp.after'=>"Waktu pengumpulan tidak boleh melewati waktu anda sekarang",
            'wap.required'=>"waktu akhir presensi tidak boleh kosong",
            'wap.after'=>"Waktu akhir pengumpulan tidak boleh mendahului waktu mulai pengumpulan",
        ]);

    if($validator->passes()){

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
                return response()->json(['status'=>0,'msg'=>'Tidak Ada Perubahan Data yang Dilakukan']);
            }                
            else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Diperbaharui']);
            }
        }
    else{
           return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
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

        $folderPath = public_path('storage');
        
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
        $query = Uploadtugas::where('id_tugas', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

     public function deleteabsen($id){
        $query = Wadahpresensi::where('id_wadah', $id)->Delete();
         
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
            'mk2'=>'nullable|different:mk1',
            'nmk2',
            '_file'=>'required',
            ],[
                'number.required'=>"No Hp tidak boleh kosong",
                'ipk.required'=>"IPK tidak boleh kosong",
                'mk1.required'=>"Pilih salah satu matkul",
                'nmk1.required'=>"Pilih nilai matkul",
                'mk2.different'=>"MK 1 dan MK 2 harus beda",
                'nmk2.required'=>"Pilih nilai matkul",
                '_file.required'=>"Upload Transkrip Nilai"
        ]);
        // dd($validator);
        if($validator->fails()) {
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);

        }else{          
            
            $path = 'storage';
            $newname = Helper::renameFile($path, $request->file('_file')->getClientOriginalName());
            $filePath = $request->_file->move(public_path($path, $newname));

            // $fileName = $file->getClientOriginalName();
            //     $file->move(public_path('storage'), $fileName);     

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
