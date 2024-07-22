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
        // var_dump($this->auth->user()-);
        if ($this->auth->user() != null) {
            return redirect()->to(site_url('/dashboard'));
        } else {
            // return redirect()->to(site_url('/login'));
            $info = $this->db->query('select * from info order by created_at desc')->getResult();

            $data = [
                'info' => $info,

            ];
            return view('publicpage/index', $data);
        }
    }
    public function lowongan()
    {

        $lowongan = $this->db->query('select a.*,
            (select nama from rekan_kerja where id = a.id_rekan) as `perusahaan`, 
            (select IFNULL(count(id),0) from jadwal_seleksi where id_lowongan = a.id) as `pendaftar`, 
            (select alamat from rekan_kerja where id = a.id_rekan) as `alamat`
            from lowongan a')->getResult();

        $data = [
            'lowongan' => $lowongan,

        ];
        return view('publicpage/lowongan', $data);
    }
    public function jadwal()
    {

        $jadwal = $this->db->query('select a.*,b.posisi,
        (select nama from siswas where id = a.id_siswa) as `nama`, 
        (select no_hp from siswas where id = a.id_siswa) as `no_hp`, 
        (select nama from rekan_kerja where id = b.id_rekan) as `perusahaan`, 
        (select alamat from rekan_kerja where id = b.id_rekan) as `lokasi`
        from jadwal_seleksi a 
        inner join lowongan b on a.id_lowongan = b.id')->getResult();

        $data = [
            'jadwal' => $jadwal,

        ];
        return view('publicpage/jadwaltespendaftar', $data);
    }


    public function adduser()
    {
        // return view('welcome_message');
        $user = $this->auth->user();
        return view('admin/adduser', ['user' => $user]);
    }
    public function dash()
    {
        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $users = new UserModel();
        $data = [
            'datauser' => $users->findAll(),
            'user' => $user,
            'role' => $role,
        ];
        return view('admin/index', $data);
    }
    public function datauser()
    {
        $users = new UserModel();
        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $data = [
            'datauser' => $users->findAll(),
            'user' => $user,
            'role' => $role,
        ];
        return view('admin/datauser', $data);
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

            $this->db->table('users')->update($data, ['id' => $id]);

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
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
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
            ->get()->getResult();
            // ->paginate($perPage, 'siswa');

        $data = [
            'mahasiswa' => $mahasiswa,
            'jurusan' => $jurusan,
            'keyword' => $keyword,
            'user' => $user,
            'pager' => $model->pager,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('mahasiswa/index', $data);
    }
    public function perusahaanindex()
    {

        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $perusahaan = $this->db->query('select * from rekan_kerja')->getResult();
        $data = [
            'perusahaan' => $perusahaan,
            'user' => $user,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('perusahaan/index', $data);
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


            $this->db->table('rekan_kerja')->update($data, ['id' => $id]);

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

            $this->db->table('siswas')->update($data, ['id' => $id]);

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
    public function lowonganindex()
    {

        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $rekankerja = $this->db->query('select * from rekan_kerja where stts = "A" ')->getResult();

        $lowongan = $this->db->query('select a.*,
        (select nama from rekan_kerja where id = a.id_rekan) as `perusahaan`, 
        (select IFNULL(count(id),0) from jadwal_seleksi where id_lowongan = a.id) as `pendaftar`, 
        (select alamat from rekan_kerja where id = a.id_rekan) as `alamat`
        from lowongan a')->getResult();

        $data = [
            'lowongan' => $lowongan,
            'rekankerja' => $rekankerja,
            'user' => $user,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('lowongan/index', $data);
    }

    public function addlowongan()
    {
        try {
            $data = $this->request->getPost();

            $this->db->table('lowongan')->insert($data);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menambah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    public function deletelowongan()
    {
        try {
            $id = $this->request->getPost('id');

            $this->db->table('lowongan')->delete(['id' => $id]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menghapus Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function editlowongan()
    {
        try {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            unset($data['id']);

            $this->db->table('lowongan')->update($data, ['id' => $id]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Mengubah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    public function jadwaltesindex()
    {

        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $siswa = $this->db->query('select a.* from siswas a')->getResult();
        $lowongan = $this->db->query('select a.*,(select nama from rekan_kerja where id = a.id_rekan) as `perusahaan` from lowongan a ')->getResult();

        $jadwaltes = $this->db->query('select a.*,b.posisi,
        (select nama from siswas where id = a.id_siswa) as `nama`, 
        (select no_hp from siswas where id = a.id_siswa) as `no_hp`, 
        (select nama from rekan_kerja where id = b.id_rekan) as `perusahaan`, 
        (select alamat from rekan_kerja where id = b.id_rekan) as `lokasi`
        from jadwal_seleksi a 
        inner join lowongan b on a.id_lowongan = b.id')->getResult();

        $data = [
            'lowongan' => $lowongan,
            'siswa' => $siswa,
            'jadwaltes' => $jadwaltes,
            'user' => $user,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('jadwaltes/index', $data);
    }

    public function addjadwal()
    {
        try {
            $data = $this->request->getPost();

            $this->db->table('jadwal_seleksi')->insert($data);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menambah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function deletejadwaltes()
    {
        try {
            $id = $this->request->getPost('id');

            $this->db->table('jadwal_seleksi')->delete(['id' => $id]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menghapus Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function editjadwaltes()
    {
        try {
            $data = $this->request->getPost();
            $id = $this->request->getPost('id');
            unset($data['id']);

            $this->db->table('jadwal_seleksi')->update($data, ['id' => $id]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Mengubah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    public function informasiindex()
    {

        $user = $this->auth->user();
        if ($this->authorization->inGroup('admin', $user->id)) {
            $role = 'Admin';
        } else {
            $role = 'User';
        }
        $info = $this->db->query('select * from info order by created_at desc')->getResult();

        $data = [
            'info' => $info,
            'user' => $user,
            'role' => $role,
        ];
        // var_dump($mahasiswa);
        return view('informasi/index', $data);
    }

    public function addinfo()
    {
        try {
            $judul = $this->request->getPost('judul');
            $desc = $this->request->getPost('desc');
            $konten = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');
            $this->db->table('info')->insert(['judul' => $judul, 'desc' => $konten]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menambah Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public function deleteinfo()
    {
        try {
            $id = $this->request->getPost('id');

            $this->db->table('info')->delete(['id' => $id]);

            $arr = ['stts' => true, "title" => "Berhasil", "msg" => "Berhasil Menghapus Data!", "icon" => "success"];
        } catch (\Throwable $th) {
            // error
            throw new \Exception($th->getMessage());
        }

        header('Content-Type: application/json');
        echo json_encode($arr);
    }
}
