<?php

namespace App\Http\Controllers;

use App\Models\SoftSkill;
use Illuminate\Http\Request;

class SoftSkillController extends Controller
{
    
    public function index()
    {
      $data = SoftSkill::all();

      return response()->json($data, 200);
    }

    public function store(Request $request)
    {
      $image = ImageController::uploadImage($request, '/cv-rogersovich/SoftSkill')->success->url;
      
      $data = SoftSkill::create([
        'image' => $image,
        'title' => $request->title,
        'description' => $request->description,
      ]);
  
      return response()->json($data, 200);
    }

    public function show(SoftSkill $softSkill)
    {
      return response()->json($softSkill, 200);
    }

    public function update(Request $request, SoftSkill $softSkill)
    {
      if ($request->image) {
        $image = ImageController::uploadImage($request, '/cv-rogersovich/SoftSkill')->success->url;
      } else {
        $image = $softSkill->image;
      }
      
      $data = SoftSkill::where('id', $softSkill->id)->update([
        'image' => $image,
        'title' => $request->title,
        'description' => $request->description,
      ]);
  
      return response()->json('success', 200);
    }

    public function destroy(SoftSkill $softSkill)
    {
      $data = SoftSkill::destroy($softSkill->id);

      return response()->json('success', 200);
    }
}
