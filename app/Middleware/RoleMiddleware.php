<?php

namespace App\Middleware;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Middleware\BaseMiddleware;

class RoleMiddleware extends BaseMiddleware
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Periksa apakah pengguna memiliki sesi dan peran yang sesuai
        if (!$session->has('isLoggedIn')) {
            // Jika tidak ada sesi, redirect ke halaman login atau ke halaman lain sesuai kebijakan aplikasi Anda
            return redirect()->to('/login');
        }

        // Peran yang diijinkan untuk mengakses halaman ini
        $allowedRoles = $arguments ?? [];

        // Periksa apakah pengguna memiliki peran yang diizinkan untuk mengakses halaman ini
        if (!in_array($session->get('role'), $allowedRoles)) {
            // Jika tidak memiliki peran yang sesuai, kembalikan response Forbidden
            return service('response')->setStatusCode(403);
        }

        return $this->next->before($request, $arguments);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Handle any post-processing here
        return $response;
    }
}

