<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelHotel extends Model
{
    protected $table      = 'tbl_hotel';
    protected $primaryKey = 'id_hotel';


    protected $allowFields = ['id_jenjang', 'nama_hotel', 'alamat_hotel', 'akreditasi', 'status', 'coordinate', 'foto', 'id_provinsi', 'id_kabkot', 'id_kecamatan'];

    function __construct()
    {
        $this->db = db_connect();
    }

    function callHotel($id_hotel = false)
    {
        if ($id_hotel === false) {
            return $this->db->table('tbl_hotel')->get();
        } else {
            return $this->Where(['id_hotel' => $id_hotel])->get();
        }
    }

    function addHotel($addHotel)
    {
        return $this->db->table('tbl_hotel')->insert($addHotel);
    }

    public function updateHotel($data, $id_hotel)
    {
        return $this->db->table('tbl_hotel')->update($data, ['id_hotel' => $id_hotel]);
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
