<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurusan;

use App\Http\Resources\JurusanResource;

use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index()
    {
        //get all jurusan
        $jurusan = Jurusan::latest()->paginate(5);

        //return collection jurusan
        return new JurusanResource(true, 'List Data Jurusan', $jurusan);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nama_jurusan'     => 'required',
            'kode_jurusan'     => 'required',
            'akreditasi'   => 'required',
            'tahun_terbit'   => 'required',
            'ketua_jurusan'   => 'required',
        ]);

    
   
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
    
        $jurusan = Jurusan::create([
            'nama_jurusan'     => $request->nama_jurusan,
            'kode_jurusan'     => $request->kode_jurusan,
            'akreditasi'   => $request->akreditasi,
            'tahun_terbit'   => $request->tahun_terbit,
            'ketua_jurusan'   => $request->ketua_jurusan,
        ]);

        //return response
        return new JurusanResource(true, 'Data Jurusan Berhasil Ditambahkan!', $jurusan);
    }

        
    
    public function show($id)
    {
       
        $jurusan = Jurusan::find($id);

        //return single jurusan
        return new JurusanResource(true, 'Detail Data Jurusan!', $jurusan);
    }

    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'nama_jurusan'     => 'required',
            'kode_jurusan'     => 'required',
            'akreditasi'   => 'required',
            'tahun_terbit'   => 'required',
            'ketua_jurusan'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $jurusan = Jurusan::find($id);
           
        $jurusan->update([
                'nama_jurusan'     => $request->nama_jurusan,
                'kode_jurusan'     => $request->kode_jurusan,
                'akreditasi'   => $request->akreditasi,
                'tahun_terbit'   => $request->tahun_terbit,
                'ketua_jurusan'   => $request->ketua_jurusan,
            ]);

        //return response
        return new JurusanResource(true, 'Data Jurusan Berhasil Diubah!', $jurusan);
    }

    public function destroy($id)
    {

      
        $jurusan = Jurusan::find($id);

        $jurusan->delete();

        //return response
        return new JurusanResource(true, 'Data Jurusan Berhasil Dihapus!', null);
    }
}
