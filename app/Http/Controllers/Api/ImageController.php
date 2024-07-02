<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show(Request $request) {
        $imgFile = $request->query('imgFile');
        $path = Storage::disk()->path($imgFile);
        return response()->file($path);
    }
}
