<?php

namespace App\Http\Controllers;

use ImageKit\ImageKit;

class ImageController extends Controller
{
  public static function uploadImage($request, $path)
  {
    $imageKit = new ImageKit(
      "public_qnbsNKMyjslolR1SRs+GF/MaZsA=",
      "private_n2UY5Cu+svFZwgsCUR/8PqdYy10=",
      "https://ik.imagekit.io/1akf8cdsyg"
    );

    $upload = $imageKit->uploadFiles([
      "file" => base64_encode(file_get_contents($request->image)), // required
      "fileName" => $request->image->getClientOriginalName(), // required
      "folder" => $path, // optional
    ]);

    return $upload;
  }
}
