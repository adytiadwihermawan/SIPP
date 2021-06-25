<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adminModel;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    // ---------------------------------------------- CRUD Data User ------------------------------------------------- \\

    public function datauser(){
        
        return view('admin.datauser', [
            'user' => $this->adminModel->Datauser()
        ]);
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
 
     $query = DB::table('users')->insert([
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
        $edit = DB::table('users')
                ->where('id', $id)
                ->first();
           
        $data = [
            'Info'=> $edit,
            'list' => $this->adminModel->Editdata()
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

            $update = DB::table('users')
                        ->where('id', $request->input('id'))
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
           $query = DB::table('users')->where('id', $id)->Delete();
            
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

        $peserta = DB::table('users')
        ->whereNotIn('nama_user', ['admin'])
        ->pluck('nama_user', 'id');

        return view('admin.datakelas', [
            'kelas' => $this->adminModel->Datakelas(),
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
 
        $query = DB::table('praktikum')->insert([
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

    // function peserta(){
    //     $datas = DB::table('praktikum')
    //     ->first();

    //     $peserta = DB::table('users')
    //     ->whereNotIn('nama_user', ['admin'])
    //     ->pluck('nama_user', 'id');
   
    //     $data = [
    //         'Info'=> $datas,
    //         'member' => $peserta
    //     ];
    //     return view('admin.addpeserta', $data);
    // }

    function addpeserta(Request $request){

        $request->validate([
            'kelas'=>'required',
            'peserta'=>'required'
        ]);

        $query = DB::table('proses_praktikum')->insert([
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
        $edit = DB::table('praktikum')
                ->where('id_praktikum', $id)
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

        $update = DB::table('praktikum')
                    ->where('id_praktikum', $request->input('id'))
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
        $query = DB::table('praktikum')->where('id_praktikum', $id)->Delete();
         
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
        
        return view('admin.datalab', [
            'lab' => $this->adminModel->Datalab(),
            'user' => $this->adminModel->Datauserlab()
        ]);
    }

    // ----------------------- Add User --------------------------\\

    function addlab(Request $request){

        //return $request->input();
        $request->validate([
         'nama_lab'=>'required',
         'id'=>'required',
     ]);
            
        $query = DB::table('lab')->insert([
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
        $edit = DB::table('lab')
                ->where('id_laboratorium', $id)
                ->first();
           
        $data = [
            'Info'=> $edit,
            'user' => $this->adminModel->Datauserlab()
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

        $update = DB::table('lab')
                    ->where('id_laboratorium', $request->input('id'))
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
        $query = DB::table('lab')->where('id_laboratorium', $id)->Delete();
         
         if($query){
             return back()->with('berhasil', 'Data Berhasil Dihapus');
         }
         else{
             return back()->with('gagal', 'Ada terjadi kesalahan');
         }
     }
    // ------------------------------------------------- End CRUD Data Lab --------------------------------------- \\
     

}
