<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index()
    {

        return view('contactus', [
            'judul' => 'Contact Us',
        ]);
    }

    public function location()
    {
        return view('lokasi', [
            'judul' => 'Contact Us',
        ]);
    }
}

