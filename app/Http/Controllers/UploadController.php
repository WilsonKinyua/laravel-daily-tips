<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(ClientRequest $request) {

        if($request->hasFile('avatar')) {
            $file =  $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $file->storeAs('avatars/', $user->id, $filename);
            Image::make(storage_path('app/public/avatars'. $user->id . '/' . $filename));
        }
    }
}
