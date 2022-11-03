<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;
use App\Models\Penerbit;

class BukuController extends Controller
{
    public function index()
    {
        $data_buku = Buku::with('penerbit')->get();

        return view('buku.index', compact('data_buku'));
    }

    public function tambah()
    {
        $data_penerbit = Penerbit::all();

        return view('buku.create', compact('data_penerbit'));
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'judul'         => 'required|min:3',
            'edisi_ke'      => 'required|numeric',
            'penerbit_ke'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'judul.required'        => 'Judul Harus di Isi !',
            'judul.min'             => 'Judul Minimal 3 Karakter !',

            'edisi_ke.required'     => 'Edisi Harus di Isi',
            'edisi_ke.numeric'      => 'Edisi Harus Berupa Angka',
            'penerbit_ke.required'  => 'Penerbit Harus di Isi',
            
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = new Buku();
        $data_to_save->judul        = $request->judul;
        $data_to_save->edisi_ke     = $request->edisi_ke;
        $data_to_save->penerbit_id  = $request->penerbit_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_buku = Buku::findOrFail($id);

        return view('buku.detail', compact('detail_buku'));
    }

    public function hapus($id)
    {
        $detail_buku = Buku::findOrFail($id);

        $detail_buku->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_buku = Buku::findOrFail($id);
        $data_penerbit = Penerbit::all();

        return view('buku.edit', compact('detail_buku', 'data_penerbit'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'judul'         => 'required|min:3',
            'edisi_ke'      => 'required|numeric',
            'penerbit_ke'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'judul.required'        => 'Judul Harus di Isi !',
            'judul.min'             => 'Judul Minimal 3 Karakter !',

            'edisi_ke.required'     => 'Edisi Harus di Isi',
            'edisi_ke.numeric'      => 'Edisi Harus Berupa Angka',
            'penerbit_ke.required'  => 'Penerbit Harus di Isi',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = Buku::findOrFail($id);
        $data_to_save->judul        = $request->judul;
        $data_to_save->edisi_ke     = $request->edisi_ke;
        $data_to_save->penerbit_id  = $request->penerbit_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Update Data Berhasil !');
    }

}
