<?php

namespace Satudata\Hargaberlaku\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HargaBerlaku extends Model
{
    protected $table = 'hargaberlaku';
    protected $primaryKey = 'hargaberlakuid';
    public $timestamps = false;

    public static function hargaberlakuById($id)
    {
        return DB::table('hargaberlaku')
            ->select(DB::raw('*'))
            ->where('hargaberlakukotakode',$id)
            ->where('hargaberlakustatus',1)
            ->where('hargaberlakulogid')
            ->orderBy('hargaberlakuid', 'ASC');
    }

    public static function year()
    {
        $nYear = Date('Y');
        $sYear = $nYear - 5;

        return DB::table('hargaberlaku')
            ->select(DB::raw(' EXTRACT(YEAR FROM hargaberlakutgl) as tahun'))
            ->whereBetween('hargaberlakutgl', array($sYear.'-01-01', $nYear.'-12-31'))
            ->groupBy('tahun');
    }

    public static function kotakode()
    {
        return DB::table('hargaberlaku')
            ->select(DB::raw('hargaberlakukotakode, kota_nama'))
            ->join('master_kota','master_kota.kota_kode','=','hargaberlaku.hargaberlakukotakode')
            ->groupBy(array('hargaberlakukotakode', 'kota_nama'));
    }
}
