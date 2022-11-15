<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSetting;
use App\Models\ModelGeojson;
use App\Models\ModelSekolah;

class Admin extends BaseController
{
    protected $ModelSetting;
    protected $ModelGeojson;
    protected $ModelSekolah;
    public function __construct()
    {
        $this->setting = new ModelSetting();
        $this->FGeojson = new ModelGeojson();
        $this->sekolah = new ModelSekolah();
    }
    public function index()
    {
        $data = [
            'title' => 'JUDUL',
        ];

        return view('admin/tempp', $data);
    }


    // SETTING MAP VIEW  ===================================================================================


    public function Setting()
    {
        $data = [
            'title' => 'Setting Map View',
            'tampilData' => $this->setting->tampilData()->getResult(),
            'tampilGeojson' => $this->FGeojson->callGeojson()->getResult(),
        ];

        return view('admin/settingMapView', $data);
    }

    public function UpdateSetting()
    {
        // dd($this->request->getVar());
        $data = [
            'id' => 1,
            'nama_web' => $this->request->getPost('nama_web'),
            'coordinat_wilayah' => $this->request->getPost('coordinat_wilayah'),
            'zoom_view' => $this->request->getPost('zoom_view'),
        ];
        $this->setting->updateData($data);
        session()->setFlashdata('alert', 'Data Berhasil disimpan.');
        return $this->response->redirect(site_url('admin/setting'));
    }




    public function table()
    {
        $data = [
            'title' => 'TABLE',
        ];

        return view('admin/table', $data);
    }


    // GEOJSONDATA =======================================================================================


    public function geojson()
    {
        $data = [
            'title' => 'DATA GEOJSON',
            'tampilData' => $this->setting->tampilData()->getResult(),
            'tampilGeojson' => $this->FGeojson->callGeojson()->getResult(),
            'updateGeojson' => $this->FGeojson->callGeojson()->getRow(),
        ];

        return view('admin/geojsonData', $data);
    }

    public function editGeojson($id)
    {
        $data = [
            'title' => 'DATA GEOJSON',
            'updateGeojson' => $this->FGeojson->callGeojson($id)->getRow(),
        ];

        return view('admin/updateGeojson', $data);
    }

    public function tambahGeojson()
    {
        $data = [
            'title' => 'DATA GEOJSON',
        ];

        return view('admin/tambahGeojson', $data);
    }

    // insert data
    public function tambah_Geojson()
    {
        // dd($this->request->getVar());

        // ambil file
        $fileGeojson = $this->request->getFile('Fjson');
        //generate random file name
        $randomName = $fileGeojson->getRandomName();
        $explode = explode('.', $randomName);
        array_pop($explode);
        $randomName = implode('.', $explode);
        $randomName = $randomName . ".geo" . $fileGeojson->getExtension();
        // pindah file to hosting
        $fileGeojson->move(ROOTPATH . 'public/geojson/', $randomName);


        $data = [
            'kode_wilayah' => $this->request->getVar('kodeG'),
            'nama_wilayah'  => $this->request->getVar('Nkec'),
            'geojson'  => $randomName,
            'warna'  => $this->request->getVar('Kwarna'),
        ];

        $addGeojson = $this->FGeojson->addGeojson($data);

        if ($addGeojson) {
            session()->setFlashdata('alert', 'Data Anda Berhasil Ditambahkan.');
            return $this->response->redirect(site_url('/admin/data/geojson'));
        }
    }

    // update data
    public function update_Geojson()
    {

        // dd($this->request->getVar());

        // ambil file name
        $fileGeojson = $this->request->getFile('Fjson');
        // cek file input
        if ($fileGeojson->getError() !== 4) {
            // Jika ada file baru

            // hapus file lama
            $file = $this->request->getVar('jsonLama');
            unlink("geojson/" . $file);
            // ambil file name
            $fileGeojson = $this->request->getFile('Fjson');
            //generate random file name
            $fileGeojsonBaru = $fileGeojson->getRandomName();
            $explode = explode('.', $fileGeojsonBaru);
            array_pop($explode);
            $fileGeojsonBaru = implode('.', $explode);
            $fileGeojsonBaru = $fileGeojsonBaru . ".geojson";
            // pindah file to hosting
            $fileGeojson->move('geojson', $fileGeojsonBaru);
        } else {
            //    Jika tidak ada file baru
            $fileGeojsonBaru = $this->request->getPost('jsonLama');
        }

        $id = $this->request->getVar('id');
        $data = [
            'kode_wilayah' => $this->request->getVar('kodeG'),
            'nama_wilayah'  => $this->request->getVar('Nkec'),
            'warna'  => $this->request->getVar('Kwarna'),
            'geojson'  => $fileGeojsonBaru,
        ];

        $this->FGeojson->updateGeojson($data, $id);
        session()->setFlashdata('alert', 'Data Berhasil Diubah.');
        return $this->response->redirect(site_url('/admin/data/geojson'));
    }

    // delete data
    public function delete_Geojson($id)
    {

        $data = $this->FGeojson->callGeojson($id)->getRow();
        $file = $data->geojson;
        unlink("geojson/" . $file);

        $this->FGeojson->delete(['id' => $id]);
        session()->setFlashdata('alert', "Data Berhasil dihapus.");
        return $this->response->redirect(site_url('/admin/data/geojson'));
    }



    //  HOTEL  ====================================================================================

    public function sekolah()
    {
        $data = [
            'title' => 'DATA SEKOLAH',
            'tampilData' => $this->setting->tampilData()->getResult(),
            'tampilGeojson' => $this->FGeojson->callGeojson()->getResult(),
            'updateGeojson' => $this->FGeojson->callGeojson()->getRow(),
            'tampilSekolah' => $this->sekolah->callSekolah()->getResult(),
        ];

        return view('admin/sekolahData', $data);
    }

    public function tambahSekolah()
    {
        $data = [
            'title' => 'DATA SEKOLAH',
            'tampilData' => $this->setting->tampilData()->getResult(),
            'tampilGeojson' => $this->FGeojson->callGeojson()->getResult(),
            'updateGeojson' => $this->FGeojson->callGeojson()->getRow(),
            'tampilSekolah' => $this->sekolah->callSekolah()->getResult(),
            'provinsi' => $this->sekolah->allProvinsi(),
            'jenjang' => $this->sekolah->allJenjang(),
        ];

        return view('admin/tambahSekolah', $data);
    }

    // insert data
    public function tambah_Sekolah()
    {
        // dd($this->request->getVar());

        // ambil file
        $fileFotoSekolah = $this->request->getFile('foto_sekolah');
        //generate random file name
        $randomName = $fileFotoSekolah->getRandomName();
        // pindah file to hosting
        $fileFotoSekolah->move(ROOTPATH . 'public/img/sekolah/', $randomName);


        $data = [
            'nama_sekolah' => $this->request->getVar('nama_sekolah'),
            'alamat_sekolah'  => $this->request->getVar('alamat_sekolah'),
            'coordinate'  => $this->request->getVar('coordinate'),
            'id_provinsi'  => $this->request->getVar('id_provinsi'),
            'id_kabupaten'  => $this->request->getVar('id_kabupaten'),
            'id_kecamatan'  => $this->request->getVar('id_kecamatan'),
            'id_kelurahan'  => $this->request->getVar('id_kelurahan'),
            'id_jenjang'  => $this->request->getVar('id_jenjang'),
            'akreditasi'  => $this->request->getVar('akreditasi'),
            'status'  => $this->request->getVar('status'),
            'foto_sekolah'  => $randomName,
        ];

        $addSekolah = $this->sekolah->addSekolah($data);

        if ($addSekolah) {
            session()->setFlashdata('alert', 'Data Anda Berhasil Ditambahkan.');
            return $this->response->redirect(site_url('/admin/data/sekolah'));
        }
    }

    public function delete_Sekolah($id_sekolah)
    {

        $data = $this->sekolah->callSekolah($id_sekolah)->getRow();
        $file = $data->foto_sekolah;
        unlink("img/sekolah/" . $file);

        $this->sekolah->delete(['id_sekolah' => $id_sekolah]);
        session()->setFlashdata('alert', "Data Berhasil dihapus.");
        return $this->response->redirect(site_url('/admin/data/sekolah'));
    }

    //  SCRAP KAB/KOT, KECAMATAN, KELURAHAN
    public function kabupaten()
    {
        $id_provinsi = $this->request->getPost('id_provinsi');
        $kab = $this->sekolah->allKabupaten($id_provinsi);
        echo '<option value="">--Pilih Kab/Kota</option>';
        foreach ($kab as $key => $value) {
            echo '<option value=' . $value['id_kabupaten'] . '>' . $value['nama_kabupaten'] . '</option>';
        }
    }
    public function kecamatan()
    {
        $id_kabupaten = $this->request->getPost('id_kabupaten');
        $kec = $this->sekolah->allKecamatan($id_kabupaten);
        echo '<option value="">--Pilih Kecamatan</option>';
        foreach ($kec as $key => $value) {
            echo '<option value=' . $value['id_kecamatan'] . '>' . $value['nama_kecamatan'] . '</option>';
        }
    }
    public function kelurahan()
    {
        $id_kecamatan = $this->request->getPost('id_kecamatan');
        $kel = $this->sekolah->allKelurahan($id_kecamatan);
        echo '<option value="">--Pilih Desa/Kelurahan</option>';
        foreach ($kel as $key => $value) {
            echo '<option value=' . $value['id_kelurahan'] . '>' . $value['nama_kelurahan'] . '</option>';
        }
    }
}
