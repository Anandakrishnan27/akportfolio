<?php

namespace App\Controllers;
use App\Models\CarousalModel;

class CarousalController extends BaseController
{
    // public function index()
    // {
    //     return view('website'); // form view
    // }



    // Display carousel dynamically
    public function display()
    {
        $model = new CarousalModel();
        $data['carousals'] = $model->where('status', 1)->findAll();

        return view('website', $data);
    }
}