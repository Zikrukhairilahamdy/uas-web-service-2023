<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

use App\Http\Resources\MahasiswaResource;

use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function index()
    {
        //get all mahasiswa
        $mahasiswa = Mahasiswa::latest()->paginate(5);

        //return collection mahasiswa
        return new MahasiswaResource(true, 'List Data Mahasiswa', $mahasiswa);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'nim'     => 'required',
            'alamat'   => 'required',
            'no_hp'   => 'required',
            'angkatan'   => 'required',
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
    
        $mahasiswa = Mahasiswa::create([
            'nama'     => $request->nama,
            'nim'     => $request->nim,
            'alamat'   => $request->alamat,
            'no_hp'   => $request->no_hp,
            'angkatan'   => $request->angkatan,
        ]);

        //return response
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Ditambahkan!', $mahasiswa);
    }

        
    
    public function show($id)
    {
       
        $mahasiswa = Mahasiswa::find($id);

        //return single mahasiswa
        return new MahasiswaResource(true, 'Detail Data Mahasiswa!', $mahasiswa);
    }

    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'nim'     => 'required',
            'alamat'   => 'required',
            'no_hp'   => 'required',
            'angkatan'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $mahasiswa = Mahasiswa::find($id);
           
        $mahasiswa->update([
                'nama'     => $request->nama,
                'nim'     => $request->nim,
                'alamat'   => $request->alamat,
                'no_hp'   => $request->no_hp,
                'angkatan'   => $request->angkatan,
            ]);

        //return response
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mahasiswa);
    }

    public function destroy($id)
    {

      
        $mahasiswa = Mahasiswa::find($id);

        $mahasiswa->delete();

        //return response
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Dihapus!', null);
    }

}

