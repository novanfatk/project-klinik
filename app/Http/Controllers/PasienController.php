<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data['pasien'] = \App\Models\Pasien::latest()->paginate(10);
return view('pasien_index', $data);
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('pasien_create');
}
/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$requestData = $request->validate([
'no_pasien' => 'required|unique:pasiens,no_pasien',
'nama' => 'required|min:3',
'umur' => 'required|numeric',
'jenis_kelamin' => 'required|in:laki-laki,perempuan',
'alamat' => 'nullable', //alamat boleh kosong
'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
]);
$pasien = new \App\Models\Pasien(); //membuat objek kosong di variabel model
 $pasien->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData
 $pasien->foto =$request->file('foto')->store('public');
 $pasien->save(); //menyimpan data ke database
 flash('Data sudah disimpan');
return back();
//mengarahkan user ke url sebelumnya yaitu /pasien/create dengan membawa variabel pesan
}
/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}
/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit(string $id)
{
$data['pasien'] = \App\Models\Pasien::findOrFail($id);
return view('pasien_edit', $data);
}
/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
    $requestData = $request->validate([
        'no_pasien' => 'required|unique:pasiens,no_pasien',
        'nama' => 'required|min:3',
        'umur' => 'required|numeric',
        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        'alamat' => 'nullable', //alamat boleh kosong
        ]);
        $pasien = \App\Models\Pasien::findOrFail($id); //membuat objek kosong di variabel model
         $pasien->fill($requestData); //mengisi var model dengan data yang sudah divalidasi requestData
         if ($request->hasFile('foto')){
            Storage::delete($pasien->foto);
            $pasien->foto = $request->file('foto')->store('public');
         }
         $pasien->save(); //menyimpan data ke database
         flash('Data sudah disimpan')->success();
        return redirect('/pasien');
}
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy(string $id)
{

$pasien = \App\Models\Pasien::findOrFail($id);
if ($pasien->foto != null && Storage::exists($pasien->foto)){
    Storage::delete($pasien->foto);
}
flash('Data sudah dihapus')->success();
return back();
}
}