<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelSekolah extends Model
{
    protected $table      = 'tbl_sekolah';
    protected $primaryKey = 'id_sekolah';


    protected $allowFields = ['id_jenjang', 'nama_sekolah', 'alamat_sekolah', 'akreditasi', 'status', 'coordinate', 'foto', 'id_provinsi', 'id_kabkot', 'id_kecamatan'];

    function __construct()
    {
        $this->db = db_connect();
    }

    function callSekolah($id_sekolah = false)
    {
        if ($id_sekolah === false) {
            return $this->db->table('tbl_sekolah')->get();
        } else {
            return $this->Where(['id_sekolah' => $id_sekolah])->get();
        }
    }

    function addSekolah($addSekolah)
    {
        return $this->db->table('tbl_sekolah')->insert($addSekolah);
    }

    public function updateSekolah($data, $id_sekolah)
    {
        return $this->db->table('tbl_sekolah')->update($data, ['id_sekolah' => $id_sekolah]);
    }



    // Jenjang
    public function allJenjang()
    {
        return $this->db->table('tbl_jenjang')->orderBy('id_jenjang', 'ASC')->get()->getResultArray();
    }

    // PROVINSI
    public function allProvinsi()
    {
        return $this->db->table('tbl_provinsi')->orderBy('id_provinsi', 'ASC')->get()->getResultArray();
    }
    // KABUPATEN/KOTA
    public function allKabupaten($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')->where('id_provinsi', $id_provinsi)->get()->getResultArray();
    }
    // KECAMATAN
    public function allKecamatan($id_kecamatan)
    {
        return $this->db->table('tbl_kecamatan')->where('id_kabupaten', $id_kecamatan)->get()->getResultArray();
    }
    // KELURAHAN
    public function allKelurahan($id_kelurahan)
    {
        return $this->db->table('tbl_kelurahan')->where('id_kecamatan', $id_kelurahan)->get()->getResultArray();
    }
}
