<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

use App\Models\User;

class ProfileController extends Controller
{
    
    
    public function create($id)
    {
        $req_data = auth()->user();
        if ($req_data->id != $id) {
            return redirect()->route($req_data->role . '.home')->with('error', 'Tidak Punya Permission !');
        }


        $data_user = User::findOrFail($id);

        return view('profile', compact(
            'data_user',
        ));
    }

  
    public function update(Request $request, $id)
    {
        $file_pp_lama       = $request->file_profile_picture_lama;
        $data_edited_user   = User::findOrFail($id);
        
        // Cek ada File atau Tidak
        if ($request->hasFile('profile_picture')) {
            $validasiData = $request->validate([
                'name'              => 'required|min:3',
                'email'             => 'required|unique:users,email,' . $id,
                'password'          => $request->password != null ? 'required|string|min:8' : '',
                'profile_picture'   => 'required|mimes:jpg,jpeg,png',
            ]);

            if (!empty($data_edited_user->profile_picture)) {
                unlink(storage_path('app/data-aplikasi/profile-picture/' . $file_pp_lama));
            }

            $fileName = date('Ymd').'-'.rand().'-'.$request->profile_picture->getClientOriginalName();
            $request->profile_picture->storeAs('data-aplikasi/profile-picture', $fileName);

            $data_to_save = $request->except(['_token', 'file_profile_picture_lama', 'password_lama', '_method']);
            $data_to_save['profile_picture'] = $fileName;

        } else {
            $validasiData = $request->validate([
                'name'              => 'required|min:3',
                'email'             => 'required|unique:users,email,' . $id,
                'password'          => $request->password != null ? 'required|string|min:8' : ''
            ]);

            $data_to_save = $request->except(['_token', 'file_profile_picture_lama', 'password_lama', '_method']);

        }

        // Cek Email Update atau Tidak
        if ($data_edited_user->email != $data_to_save['email']) {
            $data_to_save['email_verified_at'] = null;
        }
        // Cek Password Update atau Tidak
        if (!empty($request->password)) {
            $data_to_save['password'] = Hash::make($request->password);
        } else {
            $data_to_save['password'] = $request->password_lama;
        }

        User::whereId($id)->update($data_to_save);

        return back()->with('pesan', 'Update Data Berhasil !');

    }

}