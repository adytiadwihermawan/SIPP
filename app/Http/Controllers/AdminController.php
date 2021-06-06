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
   
    // SALAH

    // function update(Request $request, $id){
    //     DB::table('users')
    //     ->where('id', $id)
    //     ->update([
    //       'nama_user'=>$request->input('nama_user'),
    //       'password'=> Hash::make($request->input('password')),
    //       'id_status'=>$request->input('role')
    //     ]);

    //     return redirect('datauser')->with('toast_success', 'Data Berhasil Diubah');
    // }

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
        
        return view('admin.datakelas', [
            'kelas' => $this->adminModel->Datakelas()
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
            return redirect('datauser')->with('berhasil', 'Data Berhasil Ditambahkan');
        }
        else{
            return back()->with('gagal', 'Ada terjadi kesalahan');
        }
     }

    // function peserta($id){
    //     $datas = DB::table('praktikum')
    //     ->where('id_praktikum', $id)
    //     ->first();

    //     $peserta = DB::table('users')
    //     ->whereNotIn('nama_user', ['admin'])
    //     ->pluck('nama_user', 'id');
   
    //     $data = [
    //         'Info'=> $datas,
    //         'data' => $peserta
    //     ];
    //     return view('admin.addpeserta', $data);
    // }

    function addpeserta(Request $request){

        $data = DB::table('users')
                ->get(); 

        return view('admin.addpeserta', [
            'Info' => $data
        ]);

        $request->validate([
            'id_praktikum'=>'required',
            'id_user'=>'required'
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

     
     
    // ----------------------- Edit User --------------------------\\

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

     
    // ------------------------------------------------- End CRUD Data Lab --------------------------------------- \\
     

}
