<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = karyawan::all();
        // dd($data);
        return view('karyawan.index', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);
        if ($validator->fails()) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => false,
                    'msg' => $validator->errors(),
                ], 400);
            } else {
                return redirect()->route('karyawan.index')->with('status_failed', $validator->errors());
            }
        } else {
            // get Nomor Induk
            $sql = 'SELECT MAX(SUBSTRING(nomor_induk, -3))+1 AS ni_new FROM `karyawan`';
            $ni_new = DB::table('karyawan')->selectRaw('MAX(SUBSTRING(nomor_induk, -3))+1 AS ni_new')->value('ni_new');
            $nomor_induk_baru = 'IP06' . str_pad($ni_new, 3, "0", STR_PAD_LEFT);
            //
            $new = new karyawan();
            $new->nomor_induk = $nomor_induk_baru;
            $new->nama = $request->nama;
            $new->alamat = $request->alamat;
            $new->tanggal_lahir = $request->tanggal_lahir;
            $new->tanggal_bergabung = $request->tanggal_bergabung;
            $new->save();

            if ($request->is('api/*')) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Data Berhasil Di Tambah',
                    'data' => $new
                ], 200);
            } else {
                return redirect()->route('karyawan.index')->with('status_success', 'Data Berhasil Di Tambah');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(karyawan $karyawan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, karyawan $karyawan)
    {
        //

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'tanggal_bergabung' => 'required|date',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => false,
                'msg' => $validator->errors(),
            ], 400);

        } else {

            $karyawan->nama = $request->nama;
            $karyawan->alamat = $request->alamat;
            $karyawan->tanggal_lahir = $request->tanggal_lahir;
            $karyawan->tanggal_bergabung = $request->tanggal_bergabung;

            $karyawan->save();
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Data Berhasil Di Ubah',
                    'data' => $karyawan
                ], 200);
            } else {
                return redirect()->route('karyawan.index')->with('status_success', 'Data Berhasil Di Ubah');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(karyawan $karyawan)
    {
        //
        try {    
            $karyawan->delete();
            return redirect()->route('karyawan.index')->with('status_success', 'Data Karyawan Berhasil Di Delete');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('status_failed', 'Pastikan Data Child SUdah Hilang Atau Tidak Behubungan');
        }

    }

    public function getEditForm(Request $request)
    {
        $id = $request->get('id');
        $data = Karyawan::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('karyawan.getEditForm', compact('data'))->render()
        ), 200);
    }

    public function karyawanPertamaGabung()
    {
        $data = karyawan::orderBy('tanggal_bergabung')->take(3)->get();
        return view('karyawan.index', compact('data'));
    }

   

}
