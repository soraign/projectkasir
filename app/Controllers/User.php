<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    protected $helpers = ['form'];

    public function register()
    {
        if($this->request->getPost())
        {
            $data = $this->request->getPost();

            $password = $this->request->getPost('password');
            $repeat_password = $this->request->getPost('repeat_password');

            
            if($password!=$repeat_password)
            {
                session()->setFlashdata('errors', ['Password dan Repeat Password Tidak Sama']);
                return view('user/register');
            }

            $user_model = new UserModel();
            $user_entity = new \App\Entities\User();
            $user_entity->fill($data);
            $user_entity->role = 1;
            $user_entity->created_by = 1;
            if($user_model->save($user_entity)==false){
                session()->setFlasdata('errors', $user_model->errors());

            }else{
                return redirect()->to(site_url('auth/login'));
            }


        }
        return view('User/register');
    }
}
