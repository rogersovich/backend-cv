<?php

namespace App\Http\Controllers;

use App\Models\HardSkill;
use Illuminate\Http\Request;

class HardSkillController extends Controller
{
    public function index()
    {
      $data = HardSkill::all();

      return response()->json($data, 200);
    }

    public function store(Request $request)
    {
      
      $image = ImageController::uploadImage($request, '/cv-rogersovich/HardSkill')->success->url;
      
      $data = HardSkill::create([
        'image' => $image,
        'title' => $request->title,
        'description' => $request->description,
      ]);
  
      return response()->json($data, 200);
    }

    public function show(HardSkill $hardSkill)
    {
      return response()->json($hardSkill, 200);
    }
    
    public function update(Request $request, HardSkill $hardSkill)
    {
      if ($request->image) {
        $image = ImageController::uploadImage($request, '/cv-rogersovich/HardSkill')->success->url;
      } else {
        $image = $hardSkill->image;
      }
      
      $data = HardSkill::where('id', $hardSkill->id)->update([
        'image' => $image,
        'title' => $request->title,
        'description' => $request->description,
      ]);
  
      return response()->json('success', 200);
    }

    public function destroy(HardSkill $hardSkill)
    {
      $data = HardSkill::destroy($hardSkill->id);

      return response()->json('success', 200);
    }
}
