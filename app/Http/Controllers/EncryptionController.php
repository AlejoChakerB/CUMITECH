<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;

class EncryptionController extends Controller
{
    public function encrypt($url)
    {
        return Crypt::encrypt($url);
    }

    public function decrypt($encryptedUrl)
    {
        try {
            $url = Crypt::decrypt($encryptedUrl);
            return redirect($url);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        }
    }
}
