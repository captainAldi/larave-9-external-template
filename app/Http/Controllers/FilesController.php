<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    // Show Profile Picture
    public function showProfilePicture($namaFile)
    {

        $cariInv = storage_path('app/data-aplikasi/profile-picture/' . $namaFile); 
        $isiResponse = response()->file($cariInv);
        $fileInv = !empty($cariInv) ? $isiResponse : null;
        return $fileInv;
        
    }

}