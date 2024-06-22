<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use Myth\Auth\Password;

class Home extends BaseController
{
    protected $auth;
    protected $authorization;
    protected $db;
    public function __construct()
    {
        // Mendapatkan instance Authentication
        // helper('helper');
        $this->auth = service('authentication');
        $this->db = \Config\Database::connect();
        $this->authorization = \Myth\Auth\Config\Services::authorization();
    }
    public function index()
    {
        if($this->auth->user()){
            return redirect()->to(site_url('/dashboard'));
        }else{
            return redirect()->to(site_url('/login'));
        }
        // return view('welcome_message');
        // return view('auth/login');
    }
    public function adduser()
    {
        // return view('welcome_message');
        $user =$this->auth->user();
        return view('admin/adduser',['user'=>$user]);
    }
    public function dash()
    {       
        $user =$this->auth->user();
        if($this->authorization->inGroup('admin', $user->id)){
            $role = 'Admin';
        }else{
            $role = 'User';
        }
        $data = [
            'user' => $user,
            'role' => $role,
        ];
        return view('admin/index',$data);
    }
    public function datauser()
    {       
        $users = new UserModel();
        $user = $this->auth->user();
        if($this->authorization->inGroup('admin', $user->id)){
            $role = 'Admin';
        }else{
            $role = 'User';
        }
        $data = [
            'datauser' => $users->findAll(),
            'user' => $user,
            'role' => $role,
        ];
        return view('admin/datauser',$data);      
    }
    public function simpanuser()
    {       
        try {
            $data = $this->request->getPost();
            $file = $this->request->getFile('photo');
            $password_hash = $this->request->getPost('password_hash');
            $stts = '1';
        
            // Hapus data tertentu
            unset($data['photo']);
            unset($data['stts']);
            unset($data['password_hash']);
            unset($data['csrf_test_name']);
        
            $data['password_hash'] = Password::hash($password_hash);
            $data['username'] = $this->request->getPost('username');
            $data['active'] = '1';
        
            // Cek apakah file berhasil diunggah dan valid
            if ($file !== null && $file->isValid() && !$file->hasMoved()) {

                $extension = $file->getClientExtension();
                $folder = 'foto';
                $folderPath = 'assets/files/' . $folder . '/';
                $filename = uniqid() . '.' . $extension;
                $file->move($folderPath, $filename);
                $data['photo'] = $filename;
            } else {
                throw new \Exception("File upload failed or no file was uploaded.");
            }
        
            // Simpan data pengguna
            $this->db->table('users')->insert($data);
            $id = $this->db->insertID();
        
            // Simpan relasi grup
            $groups = [
                'group_id' => $stts,
                'user_id' => $id
            ];
            $this->db->table('auth_groups_users')->insert($groups);
        
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menyimpan Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function ubahpass()
    {       
        try {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            $password = $this->request->getPost('password');
            unset($data['password']);
        
            $data['password_hash'] = Password::hash($password);
        
            $this->db->table('users')->update($data,['id'=>$id]);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menyimpan Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
}
