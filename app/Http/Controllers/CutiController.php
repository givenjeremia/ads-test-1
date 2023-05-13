<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\cuti;
use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = cuti::all();
        $karyawan = karyawan::all();
        return view('cuti.index',compact('data','karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'lama_cuti' => 'required|integer',
            'keterangan' => 'required',
            'tanggal_cuti' => 'required|date',
        ]);
        if ($validator->fails()) {
            return redirect()->route('cuti.index')->with('status_failed', $validator->errors());
        } 
        else{
            $new = new cuti();
            $new->tanggal_cuti = $request->tanggal_cuti;
            $new->lama_cuti = $request->lama_cuti;
            $new->keterangan = $request->keterangan;
            $karyawan = karyawan::find($request->karyawan);
            $karyawan->cutis()->save($new);
            return redirect()->route('cuti.index')->with('status_success', 'Data Berhasil Di Tambah');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuti $cuti)
    {
        //
        $validator = Validator::make($request->all(), [
            'lama_cuti' => 'required|integer',
            'keterangan' => 'required',
            'tanggal_cuti' => 'required|date',
            'karyawan'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->route('cuti.index')->with('status_failed', $validator->errors());
        } 
        else{
            $cuti->tanggal_cuti = $request->tanggal_cuti;
            $cuti->lama_cuti = $request->lama_cuti;
            $cuti->keterangan = $request->keterangan;
            $cuti->nomor_induk = $request->karyawan;
            $cuti->save();
            return redirect()->route('cuti.index')->with('status_success', 'Data Berhasil Di Ubah');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuti $cuti)
    {
        //
        try {    
            $cuti->delete();
            return redirect()->route('cuti.index')->with('status_success', 'Data Cuti Berhasil Di Delete');
        } catch (\Throwable $th) {
            return redirect()->route('cuti.index')->with('status_failed', 'Pastikan Data Child SUdah Hilang Atau Tidak Behubungan');
        }
    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = cuti::find($id);
        $karyawan = karyawan::all();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('cuti.getEditForm', compact('data','karyawan'))->render()
        ), 200);
    }

    public function cutiKaryawan(){
        $cuti = new cuti();
        return view('cuti.karyawan_cuti',['data'=>$cuti->getKaryawanByTotalCuti(0)]);
    }

    public function cutiLebihDariSekali(){
        $cuti = new cuti();
        return view('cuti.karyawan_cuti_lebih_satu',['data'=>$cuti->getKaryawanByTotalCuti(1)]);
    }

    public function sisaCuti(){
        $cuti = new cuti();
        return view('cuti.karyawan_sisa_cuti',['data'=>$cuti->getSisaCutiKaryawan(karyawan::all())]);
    }
   

}
