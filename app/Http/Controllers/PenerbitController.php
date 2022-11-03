<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;

class PenerbitController extends Controller
{

    public function index()
    {
        $data_penerbit = Penerbit::all();

        return view('penerbit.index', compact('data_penerbit'));
    }

    public function tambah()
    {
        return view('penerbit.create');
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama'         => 'required|min:3',
            'lokasi'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'        => 'Nama Harus di Isi !',
            'nama.min'             => 'Nama Minimal 3 Karakter !',

            'lokasi.required'        => 'Lokasi Harus di Isi !',
            'lokasi.min'             => 'Lokasi Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = new Penerbit();
        $data_to_save->nama         = $request->nama;
        $data_to_save->lokasi       = $request->lokasi;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_penerbit = Penerbit::findOrFail($id);

        return view('penerbit.detail', compact('detail_penerbit'));
    }

    public function hapus($id)
    {
        $detail_penerbit = Penerbit::findOrFail($id);

        $detail_penerbit->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_penerbit = Penerbit::findOrFail($id);

        return view('penerbit.edit', compact('detail_penerbit'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama'         => 'required|min:3',
            'lokasi'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'        => 'Nama Harus di Isi !',
            'nama.min'             => 'Nama Minimal 3 Karakter !',

            'lokasi.required'        => 'Lokasi Harus di Isi !',
            'lokasi.min'             => 'Lokasi Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request 
        $data_to_save               = Penerbit::findOrFail($id);
        $data_to_save->nama         = $request->nama;
        $data_to_save->lokasi       = $request->lokasi;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

}
