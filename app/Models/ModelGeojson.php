<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelGeojson extends Model
{
    protected $table      = 'tbl_wilayah';
    protected $primaryKey = 'id';


    protected $allowFields = ['kode_wilayah', 'nama_wilayah', 'geojson', 'warna'];

    function __construct()
    {
        $this->db = db_connect();
    }

    function callGeojson($id = false)
    {
        if ($id === false) {
            return $this->db->table('tbl_wilayah')->get();
        } else {
            return $this->Where(['id' => $id])->get();
        }
    }

    function addGeojson($addGeojson)
    {
        return $this->db->table('tbl_wilayah')->insert($addGeojson);
    }

    public function updateGeojson($data, $id)
    {
        return $this->db->table('tbl_wilayah')->update($data, ['id' => $id]);
    }
}
