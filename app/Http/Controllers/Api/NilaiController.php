<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;

use App\Http\Resources\NilaiResource;

use Illuminate\Support\Facades\Validator;

class NilaiController extends Controller
{
    public function index()
    {
        //get all nilai
        $nilai = Nilai::latest()->paginate(5);

        //return collection nilai
        return new NilaiResource(true, 'List Data Nilai', $nilai);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'absen'     => 'required',
            'tugas'     => 'required',
            'harian'   => 'required',
            'uts'   => 'required',
            'uas'   => 'required',
        ]);

       
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
    
        $nilai = Nilai::create([
            'absen'     => $request->absen,
            'tugas'     => $request->tugas,
            'harian'   => $request->harian,
            'uts'   => $request->uts,
            'uas'   => $request->uas,
        ]);

        //return response
        return new NilaiResource(true, 'Data Nilai Berhasil Ditambahkan!', $nilai);
    }

        
    
    public function show($id)
    {
       
        $nilai = Nilai::find($id);

        //return single nilai
        return new NilaiResource(true, 'Detail Data nilai!', $nilai);
    }

    public function update(Request $request, $id)
    {
      
        $validator = Validator::make($request->all(), [
            'absen'     => 'required',
            'tugas'     => 'required',
            'harian'   => 'required',
            'uts'   => 'required',
            'uas'   => 'required',
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $nilai = Nilai::find($id);
           
        $nilai->update([
                'absen'     => $request->absen,
                'tugas'     => $request->tugas,
                'harian'   => $request->harian,
                'uts'   => $request->uts,
                'uas'   => $request->uas,
            ]);

        //return response
        return new NilaiResource(true, 'Data Nilai Berhasil Diubah!', $nilai);
    }

    public function destroy($id)
    {

      
        $nilai = Nilai::find($id);

        $nilai->delete();

        //return response
        return new NilaiResource(true, 'Data Nilai Berhasil Dihapus!', null);
    }
}
