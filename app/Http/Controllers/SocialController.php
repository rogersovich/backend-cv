<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{

    public function index()
    {
      $data = Social::all();

      return response()->json($data, 200);
    }
    
    public function store(Request $request)
    {
      $image = ImageController::uploadImage($request, '/cv-rogersovich/Social')->success->url;
      
      $data = Social::create([
        'image' => $image,
        'title' => $request->title,
        'link' => $request->link,
      ]);
  
      return response()->json($data, 200);
    }

    public function show(Social $social)
    {
      return response()->json($social, 200);
    }

    public function update(Request $request, Social $social)
    {
      if ($request->image) {
        $image = ImageController::uploadImage($request, '/cv-rogersovich/Social')->success->url;
      } else {
        $image = $social->image;
      }
      
      $data = Social::where('id', $social->id)->update([
        'image' => $image,
        'title' => $request->title,
        'link' => $request->link,
      ]);
  
      return response()->json('success', 200);
    }

    public function destroy(Social $social)
    {
      $data = Social::destroy($social->id);

      return response()->json('success', 200);
    }
}
