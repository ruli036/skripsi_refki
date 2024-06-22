<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use Myth\Auth\Password;
use CodeIgniter\Pager\Pager;
use CodeIgniter\Controller;
use Config\App;

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
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Mengubah Password!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function mahasiswaindex()
    {       
        
        $user = $this->auth->user();
        $model = new MahasiswaModel();
        if($this->authorization->inGroup('admin', $user->id)){
            $role = 'Admin';
        }else{
            $role = 'User';
        }
        $jurusan = $this->db->query('select * from master_jurusan')->getResult();
        $perPage = 10; // Jumlah item per halaman
        $keyword = $this->request->getGet('keyword') ?? "";
        $mahasiswa = $model->select('a.*, (select CONCAT(nama, " - ",kode) from master_jurusan where id = a.id_jurusan) AS jurusan')
        ->from('siswas a')
        ->like('a.nama', $keyword)
        ->orLike('a.nim', $keyword)
        ->orLike('a.no_hp', $keyword)
        ->orderBy('a.id_jurusan')
        ->groupBy('a.id')
        ->paginate($perPage,'siswa');
      
        $data = [
            'mahasiswa' => $mahasiswa,
            'jurusan' => $jurusan,
            'keyword' => $keyword,
            'user' => $user,
            'pager' => $model->pager,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('mahasiswa/index',$data);      
    }
    public function perusahaanindex()
    {       
        
        $user = $this->auth->user();
        if($this->authorization->inGroup('admin', $user->id)){
            $role = 'Admin';
        }else{
            $role = 'User';
        }
        $perusahaan = $this->db->query('select * from rekan_kerja')->getResult();
        $data = [
            'perusahaan' => $perusahaan,
            'user' => $user,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('perusahaan/index',$data);      
    }
    public function addmahasiswa()
    {       
        try {
            $data = $this->request->getPost();
        
            $this->db->table('siswas')->insert($data);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menambah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function addrelasi()
    {       
        try {
            $data = $this->request->getPost();
        
            $this->db->table('rekan_kerja')->insert($data);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menambah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function editrelasi()
    {       
        try {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            unset($data['id']);
        
        
            $this->db->table('rekan_kerja')->update($data,['id'=>$id]);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Mengubah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function editmahasiswa()
    {       
        try {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            unset($data['id']);
        
            $this->db->table('siswas')->update($data,['id'=>$id]);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Mengubah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function deleterelasi()
    {       
        try {
            $id = $this->request->getPost('id');        
        
            $this->db->table('rekan_kerja')->delete(['id' => $id]);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menghapus Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function deletemahasiswa()
    {       
        try {
            $id = $this->request->getPost('id');        
        
            $this->db->table('siswas')->delete(['id' => $id]);
            
            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menghapus Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }
        
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
}
