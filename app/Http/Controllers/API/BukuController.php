<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

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


        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Ambil !",
            "data"  => $data_buku
        ], 200);
        
    }


    public function tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'judul'         => 'required|min:3',
            'edisi_ke'      => 'required|numeric',
            'penerbit_id'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'judul.required'        => 'Judul Harus di Isi !',
            'judul.min'             => 'Judul Minimal 3 Karakter !',

            'edisi_ke.required'     => 'Edisi Harus di Isi',
            'edisi_ke.numeric'      => 'Edisi Harus Berupa Angka',
            'penerbit_id.required'  => 'Penerbit Harus di Isi',
            
        ];

         // Validasi
        $validator = Validator::make($request->all(), $rule_validasi, $pesan_validasi);

        // Jika Gagal Validasi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Tambah Data !',
                'data'    => $validator->errors(),
            ], 401);
        }

        // Mapping All Request 
        $data_to_save               = new Buku();
        $data_to_save->judul        = $request->judul;
        $data_to_save->edisi_ke     = $request->edisi_ke;
        $data_to_save->penerbit_id  = $request->penerbit_id;

        // Save to DB
        $data_to_save->save();

        // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Tambah !",
            "data"  => $data_to_save
        ], 201);

    }

    public function ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'judul'         => 'required|min:3',
            'edisi_ke'      => 'required|numeric',
            'penerbit_id'   => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'judul.required'        => 'Judul Harus di Isi !',
            'judul.min'             => 'Judul Minimal 3 Karakter !',

            'edisi_ke.required'     => 'Edisi Harus di Isi',
            'edisi_ke.numeric'      => 'Edisi Harus Berupa Angka',
            'penerbit_id.required'  => 'Penerbit Harus di Isi',
        ];

         // Validasi
        $validator = Validator::make($request->all(), $rule_validasi, $pesan_validasi);

        // Jika Gagal Validasi
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Ubah Data !',
                'data'    => $validator->errors(),
            ], 401);
        }

        // Mapping All Request 
        $data_to_save               = Buku::where('id', $id)->first();

        if (empty($data_to_save)) {
            return response()->json([
                "pesan" => "Data Buku Tidak diTemukan !",
            ], 404);
        }

        $data_to_save->judul        = $request->judul;
        $data_to_save->edisi_ke     = $request->edisi_ke;
        $data_to_save->penerbit_id  = $request->penerbit_id;

        // Save to DB
        $data_to_save->save();

         // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Ubah !",
            "data"  => $data_to_save
        ], 200);

    }

    public function hapus($id)
    {
        $detail_buku = Buku::where('id', $id)->first();

        if (empty($detail_buku)) {
            return response()->json([
                "pesan" => "Data Buku Tidak diTemukan !",
            ], 404);
        }

        $detail_buku->delete();

         // Return Data dalam bentuk JSON
        return response()->json([
            "pesan" => "Data Berhasil di Hapus !",
        ], 200);
    }


}
