<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;


class SuratPerjadin extends Model
{
    //
    protected $table = 'surat_perjadin';
    protected $primaryKey = 'spd_id';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('spd')->encode($this->attributes['spd_id']);
    }

    public function st()
    {
    	return $this->belongsTo('\App\SuratTugas', 'surat_tugas_id');
    }

    public function pegawai()
    {
        return $this->belongsTo('\App\Pegawai', 'pegawai_id');
    }

    public function pengikut()
    {
    	return $this->hasMany('\App\PengikutSpd', 'id_spd');
    }

    public function asal()
    {
        return $this->belongsTo('\App\TujuanDinas', 'kode_asal_berangkat');
    }

    public function pengeluaranLumpsum()
    {
        return $this->hasMany('\App\PengeluaranLumpsum', 'spd_id');
    }

    public function pengeluaranPenginapan()
    {
        return $this->hasMany('\App\PengeluaranPenginapan', 'spd_id');
    }

    public function pengeluaranRepresentatif()
    {
        return $this->hasMany('\App\PengeluaranRepresentatif', 'spd_id');
    }

    public function pengeluaranRiil()
    {
        return $this->hasMany('\App\PengeluaranRiil', 'spd_id');
    }

    public function pengeluaranTerbayar()
    {
        return $this->hasMany('\App\PengeluaranTerbayar', 'spd_id');
    }

    public function pengeluaranTransport()
    {
        return $this->hasMany('\App\PengeluaranTransport', 'spd_id');
    }

    public function pengeluaranUangHarian()
    {
        return $this->hasMany('\App\PengeluaranUangHarian', 'spd_id');
    }


    public function cekLaporan()
    {
        $rv = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        if ($this->st->kegiatan->jenis_kegiatan == 'biasa') {
            $laporan = Laporan::where('id_spd', $this->attributes['spd_id'])->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {
                $rv['status'] = true;
                $rv['data'] = $laporan;
            }

        }elseif ($this->st->kegiatan->jenis_kegiatan == 'dalam_kota_8jam') {
            $laporan = Laporan::where('surat_tugas_id', $this->st->st_id)->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {
                $rv['status'] = true;
                $rv['data'] = $laporan;
            }
        }elseif ($this->st->kegiatan->jenis_kegiatan == 'luar_negeri') {
            $laporan = Laporan::where('id_spd', $this->attributes['spd_id'])->get();
            //Sudah ada laporan
            if (count($laporan) > 0) {
                $rv['status'] = true;
                $rv['data'] = $laporan;
            }
        }else{
            $rv['message'] = 'Jenis kegiatan tidak dikenali: ' . $this->st->kegiatan->jenis_kegiatan;
        }

        return $rv;
    }
}
