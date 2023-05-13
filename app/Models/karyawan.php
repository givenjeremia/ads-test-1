<?php

namespace App\Models;

use App\Models\cuti;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $keyType = 'string';
    protected $primaryKey = 'nomor_induk';
    public function cutis(){
        return $this->hasMany(cuti::class,'nomor_induk','nomor_induk');
        
    }
}
