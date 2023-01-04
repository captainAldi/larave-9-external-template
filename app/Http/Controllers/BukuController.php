<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Buku;
use App\Models\Penerbit;

class BukuController extends Controller
{
    public function index(Request $request)
    {

        // Variable Pencarian
        $cari_judul = $request->cari_judul;
        $cari_nama_penerbit = $request->cari_nama_penerbit;

        $tipe_sort = 'desc';
        $var_sort = 'created_at';

        // Prepare Model
        $data_buku = Buku::query();

        // Kondisi Pencarian
        if ($request->filled('cari_judul')) {
            $data_buku = $data_buku->where('judul', 'LIKE', '%' . $cari_judul . '%');
        }

        if ($request->filled('cari_nama_penerbit')) {
            $data_buku = $data_buku->whereHas('penerbit', function (Builder $query) use ($cari_nama_penerbit) {
                $query->where('nama', 'LIKE', '%' . $cari_nama_penerbit . '%');
            });
        }

        // Kondisi Sorting
        if( $request->has('tipe_sort') || $request->has('var_sort') ) {
            $tipe_sort = $request->tipe_sort;
            $var_sort = $request->var_sort;

            $data_buku = $data_buku->orderBy($var_sort, $tipe_sort);
        }

        // Kondisi Paginate

        $set_pagination = $request->set_pagination;

        if ($request->filled('set_pagination')) {
            $data_buku = $data_buku
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate($set_pagination);
        } else {
            $data_buku = $data_buku
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate(5);
        }

        // Append Query String to Pagination
        $data_buku = $data_buku->withQueryString();


        // Return View dengan Data
        return view('buku.index', compact(
            'data_buku',
            'cari_judul',
            'cari_nama_penerbit',
        
            'tipe_sort',
            'var_sort',

            'set_pagination'
        ));

        
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
