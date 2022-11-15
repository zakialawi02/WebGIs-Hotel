<?php

namespace App\Controllers;

class View extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Lihat Peta',
        ];
        return view('page/viewMap', $data);
    }

    public function table()
    {
        $data = [
            'title' => 'Table',
        ];
        return view('page/dataTable', $data);
    }
}
