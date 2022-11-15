<?php

namespace App\Controllers;

use App\Models\ModelSetting;

class User extends BaseController
{
    protected $ModelSetting;
    public function __construct()
    {
        $this->setting = new ModelSetting();
    }
    public function myProfile()
    {
        $data = [
            'title' => 'My Profile',
        ];
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();
        return view('page/myProfile', $data);
    }

    public function list()
    {
        $data = [
            'title' => 'User List',
        ];
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();


        return view('user/userList', $data);
    }

    public function UpdateMyData()
    {
        // dd($this->request->getVar());
        $id = $this->request->getPost('id');
        $data = [
            'full_name' => $this->request->getVar('full_name'),
            'user_about' => $this->request->getPost('user_about'),
        ];

        $this->setting->updateMyData($data, $id);
        // session()->setFlashdata('alert', 'Data Berhasil disimpan.');
        return $this->response->redirect(site_url('/My-Profile'));
    }
}
