<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\UserModel;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\Request;

class Menu extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        return redirect('/');
    }
    public function create()
    {
        helper(['form', 'url']);
        if ($this->request->getPost()) {


            $menu = new MenuModel();

            if (!$this->validate([
                'image' => 'uploaded[image]|is_image[image]',
                'nama' => 'required',
                'kategori' => 'required',
                'harga' => 'required|integer',
                'user_id' => 'required|integer'
            ])) {
                $validation = Services::validation();
                session()->setFlashdata('errors', $validation->getErrors());
                return redirect()->to('menu/create');
            }
            $gambar = $this->request->getFile('image');
            $fileName = $gambar->getRandomName();
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $gambar->move(ROOTPATH . 'public/uploads/', $fileName);
            }
            session();
            $save = $menu->insert([
                "gambar" => $fileName,
                "nama" =>  $this->request->getPost('nama'),
                "kategori" =>  $this->request->getPost('kategori'),
                "user_id" => $this->request->getPost('user_id'),
                "harga" =>  $this->request->getPost('harga'),
            ]);

            if ($save == true) {
                session()->setFlashdata('success', 'Data berhasil ditambahkan.');
                return redirect()->to(site_url('menu/index'));
            }
        }

        $data['title'] = 'Create Menu';
        return view('menu/create', $data);
    }

    public function MyMenu()
    {
        $user = new UserModel();
        // dd($user->menu(session()->get('id')));
        return view('menu/me', $data = [
            'title' => 'My Menu',
            'menu' => $user->menu(session()->get('id'))
        ]);
    }


    public function delete($id)
    {
        $menu = new MenuModel();
        $deleting = $menu->delete($id);
        if ($deleting) {
            session()->setFlashdata('success', 'Data menu berhasil dihapus.');
            return redirect()->to('home');
        } else {
            session()->setFlashdata('errors', [
                'Data gagal berhasil dihapus.'
            ]);
            return redirect()->back();
        }
    }
}