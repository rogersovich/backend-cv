<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
      if ($request->get('search')) {
        $data = Contact::where('email', 'LIKE', '%' . $request->get('search') . '%')
          ->orWhere('number_phone', 'LIKE', '%' . $request->get('search') . '%')
          ->orderBy('id', 'DESC')->get();
      } else {
        $data = Contact::orderBy('id', 'DESC')->paginate(20);
      }
     

      return response()->json($data, 200);
    }

    public function store(Request $request)
    {
      $data = Contact::create([
        'email' => $request->email,
        'number_phone' => $request->number_phone,
        'link_cv' => $request->link_cv,
      ]);
  
      return response()->json($data, 200);
    }

    public function show(Contact $contact)
    {
      return response()->json($contact, 200);
    }

    public function update(Request $request, Contact $contact)
    {
      $data = Contact::where('id', $contact->id)->update([
        'email' => $request->email,
        'number_phone' => $request->number_phone,
        'link_cv' => $request->link_cv,
      ]);
  
      return response()->json('success', 200);
    }

    public function destroy(Contact $contact)
    {
      $data = Contact::destroy($contact->id);

      return response()->json('success', 200);
    }
}
