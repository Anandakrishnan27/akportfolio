<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\PageModel;

class MypageController extends BaseController
{
    use ResponseTrait;

    // public function index()
    // {
    //     echo view('mypage');
    //     echo view('template/footer');
    // }

    public function insert()
    {
        $model = new PageModel();

        $data = [
            'contact_name'    => $this->request->getPost('name'),
            'contact_email'   => $this->request->getPost('email'),
            'contact_phone'   => $this->request->getPost('phone_nmber'),
            'contact_subject' => $this->request->getPost('subject'),
            'contact_message' => $this->request->getPost('message'),
        ];

        if ($model->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save data.']);
        }
    }
}