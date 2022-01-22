<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $data['model'] =\App\Buku::latest()->paginate(10);
        return view('buku_index',$data);
    }

    public function tambah()
    {
        $data['objek'] = new \App\Buku();
        $data['action'] ='BukuController@simpan';
        $data['method'] ='POST';
        $data['nama_tombol'] = 'SIMPAN';
        return view('bk_form', $data);
    }
    public function simpan(Request $request)
    {
        $request->validate([
            'judul' =>'required|min:2',
            'pengarang' => 'required'
        ]);

        $objek = new \App\Buku();
        $objek->judul = $request->judul;
        $objek->pengarang = $request->pengarang;
        $objek->save();
        return redirect('admin/buku/beranda')->with('pensan', 'data sudah di simpan');
    }
    public function edit($id)
    {
        $data['objek'] = \App\Buku::findOrFail($id);
        $data['action'] =['BukuController@update',$id];
        $data['method'] ='PUT';
        $data['nama_tombol'] = 'UPDATE';
        return view('bk_form', $data);

    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' =>'required|min:2',
            'pengarang' => 'required'
        ]);

        $objek = \App\Buku::findOrFail($id);
        $objek->judul = $request->judul;
        $objek->pengarang = $request->pengarang;
        $objek->save();
        return redirect('admin/buku/beranda')->with('pensan', 'data sudah di simpan');
    }

    public function hapus($id)
    {
        $objek = \App\Buku::findOrFail($id);
        $objek->delete();
        return back()->with('pesan', 'Data berhasil dihapus');
    }



}
