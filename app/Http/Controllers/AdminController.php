<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Praktikum;
use App\Models\Proses_Praktikum;
use App\Models\Lab;
use App\Models\Status_user;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ---------------------------------------------- CRUD Data User ------------------------------------------------- \\

    public function datauser(Request $request){
        $search = $request->input('search');
        $user = User::leftJoin('status_user', 'status_user.id_status', '=', 'users.id_status')
                    ->where('username', 'Like', "%{$search}%")
                    ->orWhere('nama_user', 'Like', "%{$search}%")
                    ->orWhere('status_user.status', 'Like', "%{$search}%")
                    ->orderBy('users.id_status', 'asc')
                    ->simplePaginate(10);
        return view('admin.datauser', compact('user'));
    }


    // ----------------------- Add User --------------------------\\

    public function adduser(Request $request){

        //return $request->input();
    //     $request->validate([
    //      'nama_user'=>'required',
    //      'id'=>'required|unique:users|min:0|not_in:0',
    //      'password'=>'required',
    //      'role'=>'required',
    //  ]);

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
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in database']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Data Berhasil Ditambahkan']);
            }
        }       
        else{          
            return response()->json(['status'=>0, 'error'=>$validator->errors()->toArray()]);
        }
    }
     

    // ----------------------- Edit Data User ---------------------- \\

    public function edit($id){  
        $edit = User::where('id', $id)
                ->find($id);

        $view = Status_User::get();
                
        $data = [
            'Info'=> $edit,
            'list' => $view
        ];
        return view('admin.edituser', $data);
    }


    // -------------------- Update Data User----------------------- \\
   
    public function update(Request $request){
            $request->validate([
                'id' => 'required',
                'nama_user' => 'required',
                'password' => 'required',
                'role' => 'required'
            ]);

            $update = User::where('username', $request->input('id'))
                        ->update([
                            'username'=>$request->input('id'),
                            'nama_user'=>$request->input('nama_user'),
                            'password'=>Hash::make($request->input('password')),
                            'id_status'=>$request->input('role')
                        ]);

            if($update){
                return redirect('datauser')->with('berhasil', 'Data Berhasil Diubah');
            }
            else{
                return back()->with('gagal', 'Tidak Ada Perubahan Data yang Dilakukan');
            }

        }

    // ----------------------- Delete Data User --------------------- \\

    public function delete($id){
           $query = User::where('id', $id)->delete();
            
            if($query){
                return back()->with('berhasil', 'Data Berhasil Dihapus');
            }
            else{
                return back()->with('gagal', 'Ada terjadi kesalahan');
            }
        }

        
    // ----------------------------------------- End CRUD Data User ------------------------------------------------ \\

    // ----------------------------------------- CRUD Data Kelas ----------------------------------------------------- \\
  
    public function datakelas(){

        $peserta = User::whereNotIn('nama_user', ['admin'])
                    ->pluck('nama_user', 'id');

        $datakelas = Praktikum::simplePaginate(5);

        return view('admin.datakelas', [
            'kelas' => $datakelas,
            'member' => $peserta
        ]);
    }
    
    
    // ----------------------- Add Kelas, Asisten dan Peserta Kelas --------------------------\\

    public function pesertakelas(){

        $peserta = User::whereNotIn('nama_user', ['admin'])
                    ->pluck('nama_user', 'id');

        $kelas = Praktikum::get();

        $datakelas = Proses_praktikum::join('praktikum', 'proses_praktikum.id_praktikum', '=', 'praktikum.id_praktikum')
                    ->join('users', 'proses_praktikum.id_user', '=', 'users.id')
                    ->where('id_status', '!=', 3)
                    ->orderBy('proses_praktikum.id_praktikum', 'asc')
                    ->simplePaginate(10);


        return view('admin.addpesertakelas', [
            'kelas' => $kelas,
            'member' => $peserta,
            'data' => $datakelas
        ]);
    }

    public function asistenkelas(){

        $peserta = User::whereNotIn('nama_user', ['admin'])
                    ->pluck('nama_user', 'id');

        $datakelas = Praktikum::get();

        return view('admin.addasistenkelas', [
            'kelas' => $datakelas,
            'member' => $peserta
        ]);
    }

    public function addkelas(Request $request){

        //return $request->input();
        $request->validate([
         'nama_praktikum'=>'required',
         'tahun_ajaran'=>'required',
     ]);
 
        $query = Praktikum::insert([
            'nama_praktikum'=>$request->input('nama_praktikum'),
            'tahun_ajaran'=>$request->input('tahun_ajaran')
        ]);
    
        if($query){
            return redirect('datakelas')->with('berhasil', 'Data Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

     public function addasisten(Request $request){

        $request->validate([
            'kelas'=>'required',
            'peserta'=>'required|unique:roles,id_user',
            'role' => 'required',
        ]);

        $query = Roles::insert([
            'id_praktikum'=>$request->input('kelas'),
            'id_user'=>$request->input('peserta'),
            'id_status'=>$request->input('role')
        ]);

        if($query){
            return redirect('datakelas')->with('berhasil', 'Peserta Kelas Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
    }

    public function addpeserta(Request $request){

        $request->validate([
            'kelas'=>'required',
            'peserta'=>'required|unique:proses_praktikum,id_user'
        ]);

        $query = Proses_praktikum::insert([
            'id_praktikum'=>$request->input('kelas'),
            'id_user'=>$request->input('peserta')
        ]);

        if($query){
            return redirect('datakelas')->with('berhasil', 'Peserta Kelas Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
    }

     
     
    // ----------------------- Edit Kelas --------------------------\\

    public function editkelas($id){  
        $edit = Praktikum::where('id_praktikum', $id)
                ->first();
           
        $data = [
            'Info'=> $edit,
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
            return redirect('datakelas')->with('berhasil', 'Data Berhasil Diubah');
        }
        else{
            return back()->with('gagal', 'Tidak Ada Perubahan Data yang Dilakukan');
        }

    }

    // ----------------------- Delete Data Kelas --------------------- \\

    public function deletekelas($id){
        $query = Praktikum::where('id_praktikum', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }

    // ----------------------------------------- End CRUD Data Kelas ------------------------------------------------ \\

    // --------------------------------------------------- CRUD Data Lab ------------------------------------------- \\
      
    public function datalab(){
        $lab = Lab::leftJoin('users', 'users.id', '=', 'lab.id_kepalalaboratorium')
                  ->simplePaginate(5);

        return view('admin.datalab', compact('lab'));
    }

    public function lab(){
        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->get();
        return view('admin.tambahlab', compact('user'));
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
            return redirect('datalab')->with('berhasil', 'Data Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

    // ----------------------- Edit User --------------------------\\

    public function editlab($id){  
        $edit = Lab::where('id_laboratorium', $id)
                ->get();
        
        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->select('users.id', 'nama_user')
                    ->distinct()
                    ->get();
                
        $data = [
            'Info'=> $edit,
            'user' => $user
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
            return redirect('datalab')->with('berhasil', 'Data Berhasil Diubah');
        }
        else{
            return back()->with('gagal', 'Tidak Ada Perubahan Data yang Dilakukan');
        }

    }

    // ----------------------- Delete Data Lab --------------------- \\

    public function deletelab($id){
        $query = Lab::where('id_laboratorium', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }
    // ------------------------------------------------- End CRUD Data Lab --------------------------------------- \\
}