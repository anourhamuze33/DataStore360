<?php

namespace App\Http\Controllers;

use App\Models\Deponse;
use Illuminate\Http\Request;

class DeponsesController extends Controller
{
    public function create()
    {
        return view('Deponses.addDeponse');
    }
    public function store(Request $request)
    {
        $vaidated = $request->validate([
            'title'=>'required|string|max:255',
            'amount'=>'required|float',
            'date'=> 'required|date',
            'category_id'=> 'required|integer'

        ]);
        // Deponse::create([
        //     'name'=>$vaidated['name'],
        //     'role'=>'active',
        //     'payer_id'=> Auth::id()
        // ]);
    }

}
