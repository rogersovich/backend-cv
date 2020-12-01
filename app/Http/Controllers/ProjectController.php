<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
      $data = Project::all();

      return response()->json($data, 200);
    }

    
    public function store(Request $request)
    {
      $image = ImageController::uploadImage($request, '/cv-rogersovich/Project')->success->url;
      
      $data = Project::create([
        'image' => $image,
        'title' => $request->title,
        'link' => $request->link,
      ]);
  
      return response()->json($data, 200);
    }

    public function show(Project $project)
    {
      return response()->json($project, 200);
    }

    public function update(Request $request, Project $project)
    {
      if ($request->image) {
        $image = ImageController::uploadImage($request, '/cv-rogersovich/Project')->success->url;
      } else {
        $image = $project->image;
      }
      
      $data = Project::where('id', $project->id)->update([
        'image' => $image,
        'title' => $request->title,
        'link' => $request->link,
      ]);
  
      return response()->json('success', 200);
    }

    public function destroy(Project $project)
    {
      $data = Project::destroy($project->id);

      return response()->json('success', 200);
    }
}
