<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
{
$data['pasien'] = \App\Models\Pasien::latest()->paginate(10);
return view('pasien_index', $data);
}
    public function create()
    {
        return "halo, saya adalah fungsi CREATE dalam ProfilController.";
    }
    public function edit($nama, $id)
    {
    return "Halo, nama saya $nama $id";
    }
    //
}
