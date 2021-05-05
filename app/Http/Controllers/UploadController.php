<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request) {

        if($request->hasFile('avatar')) {

            $file =  $request->file('avatar');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('avatars/tmp'. $folder , $filename);

            return $folder;

            // Image::make(storage_path('app/public/avatars'. $user->id . '/' . $filename))
            //     ->fit(50,50)
            //     ->save(storage_path('app/public/avatars'. $user->id, '/thumb-', $filename));

            // $user->update([
            //     'avatar' =>  $filename
            // ]);
        }

        return '';
    }
}
