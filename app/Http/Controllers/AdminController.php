<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Praktikum;
use App\Models\Proses_Praktikum;
use App\Models\Lab;
use App\Models\Pertemuan;
use App\Models\Status_user;
use App\Models\Roles;
use App\Models\Rekrutasisten;
use App\Models\Data_asisten;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\PesertaImport;
use App\Models\Wadahform;
use App\Models\Statusform;
use Barryvdh\DomPDF\Facade;
use DataTables;


use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

      public function adminDashboard()
    {
        $data = Praktikum::first();
        return view('admin.home', compact('data'));
    }

    // ---------------------------------------------- CRUD Data User ------------------------------------------------- \\

    public function datauser(Request $request){

        $data = Praktikum::first();

        if ($request->ajax()) {
            $data = User::join('status_user', 'status_user.id_status', 'users.id_status')
                        ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        if($row->id_status == 1){
                           $btn = " <a href='edituser/".$row->id."' class='edit btn  btn-success' data-id='" . $row->id . "' title='edit'><i class='fa fa-edit'></i></a>";
                        }
                        else{
                             $btn = " <a href='edituser/".$row->id."' class='edit btn  btn-success' data-id='" . $row->id . "' title='edit'><i class='fa fa-edit'></i></a>";

                             $btn .= " <a href='javascript:void(0)' class='deleteuser btn  btn-danger' data-id='" . $row->id . "' title='delete'><i class='fa fa-trash'></i></a>";
                        }
                            return $btn;
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.datauser', compact('data'));
    }

    public function tambahuser()
    {
        $data = Praktikum::first();
        return view('admin.tambahuser', compact('data'));
    }


    // ----------------------- Add User --------------------------\\

    public function fileImport(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'file' => [
             'required',
             'mimes:xlsx'
            ],
        ], [
            'file.required' => "Import File Excel",
            'file.mimes' => "File harus bertipe xlsx"
        ]);
    
        if( $validator->passes()){
           
         $query = Excel::import(new UsersImport, $request->file('file')->store('temp'));

            if( !$query ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to add user in database', 'timeOut' => 5000]);
            }else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Ditambahkan', 'timeOut' => 3000]);
            }
        }       
        else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }

    public function adduser(Request $request){
     $rules = [
         'nama_user' => 'required',
         'id' => [
             'required',
             'unique:users,username',
             'min:8',
             'not_in:0'
            ],
         'password' => [
             'required',
             'min:8',           // must be at least 8 characters in length
             'alpha_dash'      // can't contain space
         ],
         'role' => 'required'
        ];

    $validator = \Validator::make($request->all(), $rules, [
            'nama_user.required' => "Masukkan Nama Pengguna",
            'id.unique' => "Id User Sudah Terdaftar",
            'id.required' => "Masukkan Id User",
            'id.min' => "Id User Minimal 8 Karakter",
            'password.required' => "Masukkan Password",
            'password.min' => "Password Minimal 8 Karakter",
            'password.alpha_dash' => "Password Tidak Boleh Memuat Spasi",
            'role.required' => "Pilih Role Pengguna"
    ]);
    
    if( $validator->passes()){
           
        $query = User::insert([
                'nama_user'=>$request->input('nama_user'),
                'username'=>$request->input('id'),
                'password'=> Hash::make($request->input('password')),
                'id_status'=>$request->input('role')
            ]);
            if( !$query ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to add user in database', 'timeOut' => 5000]);
            }else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Ditambahkan', 'timeOut' => 3000]);
            }
        }       
        else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }
     

    // ----------------------- Edit Data User ---------------------- \\

    public function edit($id){  
        $edit = User::where('id', $id)
                ->first();
        // dd($edit)
        $view = Status_User::get();

        $data = Praktikum::first();

        // dd($data[0]->id_praktikum);
        return view('admin.edituser', [
            'Info'=> $edit,
            'list' => $view,
            'data'=>$data
        ]);
    }


    // -------------------- Update Data User----------------------- \\
   
    public function update(Request $request){

            $rules = [
                'id' => 'required',
                'username'=>'required',
                'nama_user' => 'required',
                'password',
                'role' => 'required'
                ];

            $validator = \Validator::make($request->all(), $rules, [
                    'username.required' => "Masukkan NIM/NIP Pengguna",
                    'nama_user.required' => "Masukkan Nama Pengguna"
            ]);
            if( $validator->passes()){
           
            
            if(empty($request->input('password'))){
                $update = User::where('id', $request->input('id'))
                        ->update([
                            'id'=>$request->input('id'),
                            'username'=>$request->input('username'),
                            'nama_user'=>$request->input('nama_user'),
                            'id_status'=>$request->input('role')
                        ]);
            }
            else{
                $update = User::where('id', $request->input('id'))
                        ->update([
                            'id'=>$request->input('id'),
                            'username'=>$request->input('username'),
                            'nama_user'=>$request->input('nama_user'),
                            'password'=>Hash::make($request->input('password')),
                            'id_status'=>$request->input('role')
                        ]);
            }
                if($update){
                    return response()->json(['status'=>1,'msg'=>'Data User Berhasil Diperbaharui', 'timeOut' => 3000]);
                }
                else{
                    return response()->json(['status'=>0,'msg'=>'Tidak Ada Perubahan Data yang Dilakukan', 'timeOut' => 5000]);
                }
            }       
            else{          
                return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
            }
            
        }

    // ----------------------- Delete Data User --------------------- \\

        public function deleteuser(Request $request)
    {
        $data = User::where('id', $request->id)->delete();
        return response()->json(['text' => 'User Berhasil Dihapus'], 200);
    }

        
    // ----------------------------------------- End CRUD Data User ------------------------------------------------ \\

    // ----------------------------------------- CRUD Data Kelas ----------------------------------------------------- \\
  
    public function datakelas(Request $request){

        $data = Praktikum::first();

        if ($request->ajax()) {
            $data = Praktikum::get();
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                            $btn = "<a href='tambahpeserta/".$row->id_praktikum."' class='btn btn-primary' data-id='" . $row->id_praktikum . "' title='tambahpesertakelas'>
					                    <i class='fa fa-plus'></i> Peserta Kelas </a>";

                            $btn .= "<a href='tambahasisten/".$row->id_praktikum."' class='btn btn-info' data-id='" . $row->id_praktikum . "' title='tambahasistenkelas'>
					                    <i class='fa fa-plus'></i> Asisten Kelas </a>";

                            $btn .= " <a href='editkelas/".$row->id_praktikum."' class='edit btn  btn-success' data-id='" . $row->id_praktikum . "' title='edit'><i class='fa fa-edit'></i>Edit</a>";

                            $btn .= " <a href='javascript:void(0)' class='deletekelas btn  btn-danger' data-id='" . $row->id_praktikum . "' title='delete'><i class='fa fa-trash'></i>Hapus</a>";
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        // dd($data);

        return view('admin.datakelas', compact('data'));
    }
    
    
    // ----------------------- Add Kelas, Asisten dan Peserta Kelas --------------------------\\

    public function pesertakelas(Request $request, $id){

        $cek = Proses_praktikum::where('id_praktikum', $id)->pluck('id_user')->all();

        $member = User::whereNotIn('nama_user', ['admin'])
                    ->whereNotIn('id', $cek)
                    ->pluck('nama_user', 'id');


        $data = Praktikum::where('id_praktikum', $id)->first();

        if ($request->ajax()) {
            
        $data = Praktikum::join('proses_praktikum', 'praktikum.id_praktikum', '=', 'proses_praktikum.id_praktikum')
                    ->join('users', 'proses_praktikum.id_user', '=', 'users.id')
                    ->where('praktikum.id_praktikum', $id)
                    ->where('id_status', '!=', 3)
                    ->get();
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                             $btn = " <a href='javascript:void(0)' class='deletepeserta btn  btn-danger' data-id='" . $row->id_proses . "' title='delete'><i class='fa fa-trash'></i></a>";
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.addpesertakelas', [
            'member'=>$member,
            'data'=>$data
        ]);
    }

    public function deletepeserta(Request $request)
    {
        $data = Proses_praktikum::where('id_proses', $request->id)->delete();
        return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
    }

    public function asistenkelas(Request $request, $id){

        $cek = Roles::where('id_praktikum', $id)->pluck('id_user')->all();

        $member = User::whereNotIn('nama_user', ['admin'])
                    ->whereNotIn('id', $cek)
                    ->where('id_status', '!=', 2)
                    ->pluck('nama_user', 'id');


        $data = Praktikum::where('id_praktikum', $id)->first();

        if ($request->ajax()) {    
        $data = Roles::join('praktikum', 'roles.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->join('users', 'roles.id_user', '=', 'users.id')
                    ->where('roles.id_praktikum', $id)
                    ->where('roles.id_status', '=', 3)
                    ->get();
            return Datatables::of($data)
                    ->addColumn('action', function($row){
                             $btn = " <a href='javascript:void(0)' class='deleteasisten btn  btn-danger' data-id='" . $row->id_role . "' title='delete'><i class='fa fa-trash'></i></a>";
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.addasistenkelas', [
            'member'=>$member,
            'data'=>$data
        ]);
    }

    public function addkelas(Request $request){

     $validator = \Validator::make($request->all(), [
         'nama_praktikum' => 'required|unique:praktikum,nama_praktikum',
         'tahun_ajaran' => 'required',
         'nama_pertemuan' => 'required'
        ], [
            'nama_praktikum.required' => "Masukkan Nama Praktikum",
            'nama_praktikum.unique'=>"Kelas Sudah Terdaftar",
            'tahun_ajaran.required' => "Masukkan Tahun Ajaran"
    ]);

    if( $validator->passes()){
           
        $post = $request->all();

        $data = new Praktikum;
        $data->nama_praktikum = $post['nama_praktikum'];
        $data->tahun_ajaran = $post['tahun_ajaran'];
        $query = $data->save();
        
        Pertemuan::insert([
                'id_praktikum'=>DB::getPdo()->lastInsertId(),
                'nama_pertemuan'=>$request->input('nama_pertemuan')
            ]);

            if( !$query ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to add user in database', 'timeOut' => 5000]);
            }else{
                return response()->json(['status'=>1,'msg'=>'Kelas Berhasil Ditambahkan', 'timeOut' => 3000]);
            }
        }       
        else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
     }

     public function tambahkelas()
     {
         $data = Praktikum::first();

        return view('admin.tambahkelas', compact('data'));
     }

     public function addasisten(Request $request){

        $request->validate([
            'id'=>'required',
            'peserta'=>'required',
            'role' => 'required',
        ]);

        Data_asisten::insert([
            'id_praktikum'=>$request->input('id'),
            'id_user'=>$request->input('peserta')
        ]);

        $query = Roles::insert([
            'id_praktikum'=>$request->input('id'),
            'id_user'=>$request->input('peserta'),
            'id_status'=>$request->input('role')
        ]);


        if($query){
            return response()->json(['status'=>1,'msg'=>'Peserta Kelas berhasil ditambahkan']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }
    }

    public function deleteasisten(Request $request)
    {
        $data = Roles::where('id_role', $request->id)->delete();
        return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
    }

    public function fileImportPeserta(Request $request) 
    {
        $validator = \Validator::make($request->all(), [
            'file' => [
             'required',
             'mimes:xlsx'
            ],
        ], [
            'file.required' => "Import File Excel",
            'file.mimes' => "File harus bertipe xlsx"
        ]);
    
        if( $validator->passes()){
           
         $query = Excel::import(new PesertaImport, $request->file('file')->store('temp'));

            if( !$query ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to add user in database']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Peserta Berhasil Ditambahkan']);
            }
        }       
        else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }

    public function addpeserta(Request $request){

        $request->validate([
            'id'=>'required',
            'peserta'=>'required'
        ]);

        $query = Proses_praktikum::insert([
            'id_praktikum'=>$request->input('id'),
            'id_user'=>$request->input('peserta')
        ]);

        if($query){
            return response()->json(['status'=>1,'msg'=>'Peserta Kelas berhasil ditambahkan']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }
    }

     
     
    // ----------------------- Edit Kelas --------------------------\\

    public function editkelas($id){  
        $edit = Praktikum::where('id_praktikum', $id)
                ->first();
        
        $data = Praktikum::first();
           
        $data = [
            'Info'=> $edit,
            'data'=>$data
        ];
        return view('admin.editkelas', $data);
    }

    // -------------------- Update Data Kelas----------------------- \\
    
    public function updatekelas(Request $request){
        $request->validate([
            'id' => 'required',
            'nama_prak' => 'required',
            'thn_ajar' => 'required'
        ]);

        $update = Praktikum::where('id_praktikum', $request->input('id'))
                            ->update([
                                'id_praktikum'=>$request->input('id'),
                                'nama_praktikum'=>$request->input('nama_prak'),
                                'tahun_ajaran'=>$request->input('thn_ajar')
                        ]);
        // dd($update);
        if($update){
              return response()->json(['status'=>1,'msg'=>'Data Berhasil Diubah']);
        }
        else{
            return back()->with('gagal', 'Tidak Ada Perubahan Data yang Dilakukan');
        }

    }

    // ----------------------- Delete Data Kelas --------------------- \\

     public function deletekelas(Request $request)
    {
        $data = Praktikum::where('id_praktikum', $request->id)->delete();
        return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
    }
     

    // ----------------------------------------- End CRUD Data Kelas ------------------------------------------------ \\

    // --------------------------------------------------- CRUD Data Lab ------------------------------------------- \\
      
    public function datalab(Request $request){
        $data = Praktikum::first();
         if ($request->ajax()) {
            $data = Lab::leftJoin('users', 'users.id', '=', 'lab.id_kepalalaboratorium')
                        ->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                             $btn = " <a href='editlab/".$row->id_laboratorium."' class='edit btn  btn-success' data-id='" . $row->id_laboratorium . "' title='edit'><i class='fa fa-edit'></i></a>";
                             $btn .= " <a href='javascript:void(0)' class='deletelab btn  btn-danger' data-id='" . $row->id_laboratorium . "' title='delete'><i class='fa fa-trash'></i></a>";
                            return $btn;
                        
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.datalab', compact('data'));
    }

    public function lab(){
        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->get();
        $data =  Praktikum::first();
        return view('admin.tambahlab', [
            'user'=>$user,
            'data'=>$data
        ]);
    }

    // ----------------------- Add User --------------------------\\

    public function addlab(Request $request){

        //return $request->input();
        $request->validate([
         'nama_lab'=>'required',
         'id'=>'required',
     ]);
            
        $query = Lab::insert([
            'nama_laboratorium'=>$request->input('nama_lab'),
            'id_kepalalaboratorium'=> $request->input('id')
        ]);
    
        if($query){
            return response()->json(['status'=>1,'msg'=>'Lab Berhasil Ditambahkan', 'timeOut' => 3000]);
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

    // ----------------------- Edit User --------------------------\\

    public function editlab($id){  
        $edit = Lab::where('id_laboratorium', $id)
                ->get();
        
        $data = Praktikum::first();
        
        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->select('users.id', 'nama_user')
                    ->distinct()
                    ->get();
                
        $data = [
            'Info'=> $edit,
            'user' => $user,
            'data'=>$data
        ];
        // dd($data);
        return view('admin.editlab', $data);
    }     

    // -------------------- Update Data Lab----------------------- \\
    
    public function updatelab(Request $request){
        $request->validate([
            'id' => 'required',
            'nama_lab' => 'required',
            'kepalalab' => 'required'
        ]);
        // dd($request);
        $update = Lab::where('id_laboratorium', $request->input('id'))
                    ->update([
                        'id_laboratorium'=>$request->input('id'),
                        'nama_laboratorium'=>$request->input('nama_lab'),
                        'id_kepalalaboratorium'=>$request->input('kepalalab')
                    ]);
        // dd($update);
        if($update){
            return response()->json(['status'=>1,'msg'=>'Data Berhasil Diubah']);
        }
        else{
            return back()->with('gagal', 'Tidak Ada Perubahan Data yang Dilakukan');
        }

    }

    // ----------------------- Delete Data Lab --------------------- \\

    public function deletelab(Request $request)
    {
        $data = Lab::where('id_laboratorium', $request->id)->delete();
        return response()->json(['text' => 'Data Berhasil Dihapus'], 200);
    }
    // ------------------------------------------------- End CRUD Data Lab --------------------------------------- \\


    
    public function openpendaftaran(Request $request)
    {
        $mkwadahform = Wadahform::pluck('id_praktikum')->all();

        $mk = Praktikum::whereNotIn('id_praktikum', $mkwadahform)
                    ->get();
        $data = Praktikum::first();

        $status = Statusform::first();

        if ($request->ajax()) {
            $data = Wadahform::join('praktikum', 'wadahform.id_praktikum', 'praktikum.id_praktikum')
                        ->get();;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = " <button class='delete btn  btn-danger' data-id='" . $row->id_form . "' >Delete</button>";
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      

        return view('admin.bukapendaftaran', [
            'mk'=>$mk,
            'data'=>$data,
            'status'=>$status
        ]);
    }

    public function tambahMK(Request $request)
    {
        $request->validate([
                    'mk1'=>'required'
                ]);
        //  dd($request->all());
        $query = Wadahform::insert([
                        'id_praktikum'=>$request->input('mk1')
                    ]);
        // dd($query);
        if($query){
            return response()->json(['status'=>1,'msg'=>'MK Asisten berhasil ditambah']);
        }                
        else{
            return response()->json(['status'=>0,'msg'=>'Something went wrong, Gagal upload file']);
        }
    }

    public function hapus(Request $request)
    {
        $data = Wadahform::where('id_form', $request->id)->delete();
        return response()->json(['text' => 'Mata Kuliah Berhasil Dihapus'], 200);
    }

    public function updateform(Request $request){

            $validator = \Validator::make($request->all(), [
                'id' => 'required',
                'status' => [
                    'required',
                    'unique:statusform,statusform'
                    ]
                ], [
                    'status.unique'=>'Status Masih Sama'
            ]);

        if( $validator->passes()){

            $update = Statusform::where('id_statusform', $request->input('id'))
                        ->update([
                            'id_statusform'=>$request->input('id'),
                            'statusform'=>$request->input('status'),
                        ]);

            if($update){
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Diubah']);
            }
            else{
                return response()->json(['status'=>0,'msg'=>'Tidak Ada Perubahan Data']);
            }
        }
        else{
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }

        }

    public function viewcalon(Request $request){
        $data = Praktikum::first();

         if ($request->ajax()) {
            $data = Rekrutasisten::with(['praktikum1', 'praktikum2'])
                             ->join('users', 'rekrutasisten.id_user', 'users.id')
                             ->get();
            return Datatables::of($data)
                    ->addColumn('praktikumpilihan1', function($row){
                           return $row->praktikum1->nama_praktikum;
                    })
                    ->addColumn('praktikumpilihan2', function($row){
                        if(empty($row->praktikum2->nama_praktikum)){
                            return "-";
                        }else{
                           return $row->praktikum2->nama_praktikum;
                        }
                    })
                    ->addColumn('nilai2', function($row){
                        if(empty($row->nilai_pilihan2)){
                            return "-";
                        }else{
                            return $row->nilai_pilihan2;
                        }
                    })
                    ->addColumn('file', function($row){
                           return $btn = "<a href='/downloadfile".$row->filetranskripnilai."' title='download'>$row->filetranskripnilai</a>";
                    })
                    ->rawColumns(['praktikumpilihan1', 'praktikumpilihan2', 'nilai2', 'file'])
                    ->make(true);
        }
        return view('admin.daftarcalonasisten', compact('data'));
    }

    public function rekapasisten(Request $request){
        $data = Praktikum::first();

         if ($request->ajax()) {
            $data = Data_asisten::join('users', 'data_asisten.id_user', 'users.id')
                                ->join('praktikum', 'data_asisten.id_praktikum', 'praktikum.id_praktikum')
                                ->get();
            return Datatables::of($data)
                    ->addColumn('nama', function($row){
                        return $row->nama_user;
                    })
                    ->addColumn('nim', function($row){
                        return $row->username;
                    })
                    ->addColumn('praktikum', function($row){
                        return $row->nama_praktikum;
                    })
                    ->addColumn('tahunajaran', function($row){
                        return $row->tahun_ajaran;
                    })
                    ->addColumn('print', function($row){
                           return $btn = " <button class='print btn  btn-info' data-id='" . $row->id_dataasisten . "' ><i class='fas fa-print'></i></button>";
                    })
                    ->rawColumns(['nama', 'nim', 'praktikum', 'tahunajaran', 'print'])
                    ->make(true);
        }
        return view('admin.rekapasisten', compact('data'));
    }

    public function sertifikat(Request $request)
    {
        $data = Data_asisten::join('users', 'data_asisten.id_user', 'users.id')
                            ->join('praktikum', 'data_asisten.id_praktikum', 'praktikum.id_praktikum')
                            ->where('id_dataasisten', $request->id)
                            ->first();

        $pdf = Facade::loadView('sertifikat', compact('data'))->setPaper('a4', 'landscape');
    
        \Storage::put('public/pdf/SERTIFIKAT '.$data->nama_user.' PRAKTIKUM '.$data->nama_praktikum.'.pdf', $pdf->output());
        
        $path = 'storage/pdf/SERTIFIKAT '.$data->nama_user.' PRAKTIKUM '.$data->nama_praktikum.'.pdf';

        return response()->download(public_path($path));
    }

}