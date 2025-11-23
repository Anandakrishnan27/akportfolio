<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\PageModel;

class MypageController extends BaseController
{
    use ResponseTrait;

    public function view(): string
    {
        echo view('viewtable');
        echo view('template/footer');
        return '';
    }

    public function insert()
    {
        $model = new PageModel();
        $data = [
            'contact_name' => $this->request->getPost('name'),
            'contact_email' => $this->request->getPost('email'),
            'contact_phone' => $this->request->getPost('phone_nmber'),
            'contact_subject' => $this->request->getPost('subject'),
            'contact_message' => $this->request->getPost('message'),
        ];
        if ($model->save($data)) {
            return $this->response->setJSON(['status' => 'success', 'data' => $data]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save data.']);
        }
    }

    public function contactList()
    {
        $model = new PageModel();

        $draw = $this->request->getPost('draw');
        $start = (int) $this->request->getPost('start');
        $length = (int) $this->request->getPost('length');
        $search = $this->request->getPost('search.value');

        $totalRecords = $model->countAll();

        $query = $model->select('*');

        if (!empty($search)) {
            $query = $query->groupStart()
                ->like('contact_name', $search)
                ->orLike('contact_phone', $search)
                ->orLike('contact_email', $search)
                ->orLike('contact_subject', $search)
                ->groupEnd();
        }

        $filteredRecords = $query->countAllResults(false);

        $data = $query->limit($length, $start)
            ->orderBy('contact_id', 'DESC')
            ->findAll();

        $output = [];
        foreach ($data as $row) {
            $output[] = [
                'contact_id' => $row['contact_id'],
                'contact_name' => esc($row['contact_name']),
                'contact_phone' => esc($row['contact_phone']),
                'contact_email' => esc($row['contact_email']),
                'contact_subject' => esc($row['contact_subject']),
                'Actions' => '    <button class="btn btn-sm btn-info view-contact" data-id="' . (int) $row['contact_id'] . '" title="View Details">
        <i class="fas fa-eye"></i>
    </button'
            ];
        }

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        return $this->response->setJSON([
            'draw' => (int) $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'aaData' => $output,
            'token' => $csrfHash,
            $csrfName => $csrfHash
        ]);
    }

    public function getContact($id = null)
    {
        if (!$id || !is_numeric($id)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid ID']);
        }

        $model = new PageModel();
        $contact = $model->find($id);

        if ($contact) {
            return $this->response->setJSON(['success' => true, 'data' => $contact]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Contact not found']);
        }
    }
}