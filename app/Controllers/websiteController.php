<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\CarousalModel;

class WebsiteController extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        $carousalModel = new \App\Models\CarousalModel();

        // Load raw HTML view as a string
        $view = view('website');

        // Find all tags like {{ SOME_CODE }}
        $view = preg_replace_callback('/{{\s*([\w-]+)\s*}}/', function ($matches) {
            return render_carousal_by_code($matches[1]);
        }, $view);

        echo view('template/header');
        echo $view;
        echo view('template/footer');
        return '';
    }
    public function formadd(): string
    {
        echo view('template/head');
        echo view('dynamicform');
        echo view('template/footer');
        return '';
    }

    public function insertCarousal()
    {
        // Check if it's an AJAX request
        if (!$this->request->isAJAX()) {
            return $this->fail('Invalid request', 400);
        }

        $model = new CarousalModel();

        // Validation
        $rules = [
            'carousalimage' => 'uploaded[carousalimage]|max_size[carousalimage,5120]|is_image[carousalimage]|mime_in[carousalimage,image/jpg,image/jpeg,image/png,image/gif]',
            'carousalCode' => 'required|min_length[3]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $file = $this->request->getFile('carousalimage');
        $status = $this->request->getPost('carousalStatus') ? 1 : 0;
        $code = $this->request->getPost('carousalCode');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            // Create uploads directory if it doesn't exist
            if (!is_dir('uploads/')) {
                mkdir('uploads/', 0777, true);
            }

            if ($file->move('uploads/', $newName)) {
                $data = [
                    'image' => $newName,
                    'status' => $status,
                    'code' => $code,
                ];

                if ($model->insert($data)) {
                    // Return success with new CSRF token
                    return $this->respond([
                        'success' => true,
                        'message' => 'Carousel image uploaded successfully!',
                        'csrfHash' => csrf_hash()
                    ]);
                }
            }
        }

        return $this->fail('Failed to upload image or save to database.', 500);
    }
    public function display()
    {
        $model = new CarousalModel();
        $data['carousals'] = $model->where('status', 1)->findAll();
        echo view('template/header');
        echo view('template/footer');
        return view('website', $data);

    }

}