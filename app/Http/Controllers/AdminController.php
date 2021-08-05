<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Praktikum;
use App\Models\Lab;
use App\Models\Status_user;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ---------------------------------------------- CRUD Data User ------------------------------------------------- \\

    public function datauser(){
        $user = User::leftJoin('status_user', 'status_user.id_status', '=', 'users.id_status')
                    ->simplePaginate(4);
        return view('admin.datauser', compact('user'));
    }


    // ----------------------- Add User --------------------------\\

    function adduser(Request $request){

        //return $request->input();
        $request->validate([
         'nama_user'=>'required',
         'id'=>'required|unique:users|min:0|not_in:0',
         'password'=>'required',
         'role'=>'required',
     ]);
 
     $query = User::insert([
          'nama_user'=>$request->input('nama_user'),
          'id'=>$request->input('id'),
          'password'=> Hash::make($request->input('password')),
          'id_status'=>$request->input('role')
     ]);
 
        if($query){
            return redirect('datauser')->with('berhasil', 'Data Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

    // ----------------------- Edit Data User ---------------------- \\

    function edit($id){  
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
   
        function update(Request $request){
            $request->validate([
                'id' => 'required',
                'nama_user' => 'required',
                'password' => 'required',
                'role' => 'required'
            ]);

            $update = User::where('id', $request->input('id'))
                        ->update([
                            'id'=>$request->input('id'),
                            'nama_user'=>$request->input('nama_user'),
                            'password'=>Hash::make($request->input('password')),
                            'id_status'=>$request->input('role')
                        ]);

            if($update){
                return redirect('datauser')->with('berhasil', 'Data Berhasil Diubah');
            }
            else{
                return back()->with('gagal', 'Ada terjadi kesalahan');
            }

        }

    // ----------------------- Delete Data User --------------------- \\

         function delete($id){
           $query = User::where('id', $id)->Delete();
            
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
    
    // ----------------------- Add Kelas dan Peserta Kelas --------------------------\\

    function addkelas(Request $request){

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

    function addpeserta(Request $request){

        $request->validate([
            'kelas'=>'required',
            'peserta'=>'required'
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

    function editkelas($id){  
        $edit = Praktikum::where('id_praktikum', $id)
                ->first();
           
        $data = [
            'Info'=> $edit,
        ];
        return view('admin.editkelas', $data);
    }

    // -------------------- Update Data Kelas----------------------- \\
    
    function updatekelas(Request $request){
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

        if($update){
            return redirect('datakelas')->with('berhasil', 'Data Berhasil Diubah');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }

    }

    // ----------------------- Delete Data Kelas --------------------- \\

    function deletekelas($id){
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

        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->get();

        return view('admin.datalab', [
            'lab' => $lab,
            'user' => $user
        ]);
    }

    // ----------------------- Add User --------------------------\\

    function addlab(Request $request){

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
            return back()->with('berhasil', 'Data Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

    // ----------------------- Edit User --------------------------\\

    function editlab($id){  
        $edit = Lab::where('id_laboratorium', $id)
                ->first();
        
        $user = User::leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
                    ->where('users.id_status', 2)
                    ->get();
                
        $data = [
            'Info'=> $edit,
            'user' => $user
        ];
        return view('admin.editlab', $data);
    }     

    // -------------------- Update Data Lab----------------------- \\
    
    function updatelab(Request $request){
        $request->validate([
            'id' => 'required',
            'nama_lab' => 'required',
            'kepalalab' => 'required'
        ]);

        $update = Lab::where('id_laboratorium', $request->input('id'))
                    ->update([
                        'id_laboratorium'=>$request->input('id'),
                        'nama_laboratorium'=>$request->input('nama_lab'),
                        'id_kepalalaboratorium'=>$request->input('kepalalab')
                    ]);

        if($update){
            return redirect('datalab')->with('berhasil', 'Data Berhasil Diubah');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }

    }

    // ----------------------- Delete Data Lab --------------------- \\

    function deletelab($id){
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
