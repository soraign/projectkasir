<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $helpers = ['form'];

    public function login()
    {
        if (session()->isLoggedIn) {
            return redirect()->to(base_url('/'));
        }


        if ($this->request->getPost()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');


            if (strlen($username) < 3 || strlen($password) < 3) {
                session()->setFlashdata('errors', ['Username atau Password kurang dari 3 digit']);
                return view('user/login', [
                    'title' => 'Login'
                ]);
            }

            $user_model = new UserModel();
            $user = $user_model->where('username', $username)->first();

            if ($user) {
                $salt = $user->salt;
                if ($user->password !== md5($password)) {
                    session()->setFlashdata('errors', ['Password salah!']);
                } else {
                    $sess_data = [
                        'username'   => $user->username,
                        'id'         => $user->id,
                        'role'       => $user->role,
                        'isLoggedIn' => TRUE
                    ];

                    session()->set($sess_data);
                    return redirect()->to(site_url('home'));
                }
            } else {
                session()->setFlashdata('errors', ['User Tidak ditemukan']);
            }
        }

        return view('user/login', [
            'title' => 'Login'
        ]);
    }


    public function register()
    {
        if (session()->isLoggedIn) {
            return redirect()->to(base_url('/'));
        }


        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            // dd($data);
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'username' => 'required',
                'password' => 'required|min_length[8]',
                'repeat_password' => 'required|min_length[8]',
            ]);

            if (!is_null($validation->getErrors())) {
                session()->setFlashdata('errors', $validation->getErrors());
            }

            $password = $this->request->getPost('password');
            $repeat_password = $this->request->getPost('repeat_password');


            if ($password != $repeat_password) {
                session()->setFlashdata('errors', ['Password dan Repeat Password Tidak Sama']);
                return view('user/register', [
                    'title' => 'Register'
                ]);
            }

            $user_model = new UserModel();
            $user = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password'))
            ];
            if ($user_model->save($user) == false) {
                session()->setFlashdata('errors', $user_model->errors());
            } else {
                session()->setFlashdata('success', "Berhasil registrasi. Silahkan login.");
                return redirect()->to(site_url('auth/login'));
            }
        }
        return view('user/register', [
            'title' => 'Register'
        ]);
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('auth/login'));
    }
}