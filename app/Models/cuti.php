<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cuti extends Model
{
    use HasFactory;
    protected $table = 'cuti';

    public function karyawan(){
        return $this->belongsTo(karyawan::class,'nomor_induk');
    }

    public function getKaryawanByTotalCuti($total){
        $karyawan = karyawan::all();
        $data = [];
        foreach ($karyawan as $k){
            if(count($k->cutis) > $total){
                array_push($data,$k);
            }
        }
        return $data;
    }

    public function getSisaCutiKaryawan($karyawan)
    {
        $date_now = Carbon::now();
        $data = [];
        foreach ($karyawan as $item) {
            $jatah_cuti = 12;
            foreach ($item->cutis as $value) {
                $myDate = $value->tanggal_cuti;
                $date = Carbon::createFromFormat('Y-m-d', $myDate)->format('Y');
                if($date == $date_now->year){
                    $jatah_cuti--;
                }
            }
            $karyawan_with_sisa_cuti = [
                'nomor_induk'=> $item->nomor_induk, 
                'nama'=>$item->nama,
                'sisa_cuti'=>$jatah_cuti
            ];
            array_push($data,$karyawan_with_sisa_cuti);
        }

        return $data;
    }

}
