<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function premier()
    {
        return view('Colocations.Premier_Page_avant_creation');

    }

    public function index()
    {
        return view('Colocations.memberDashboard');
    }
    public function create()
    {
        return view('Colocations.addColocationForm');
    }
    public function store(Request $request)
    {
        $vaidated = $request->validate([
            'name'=>'required|string|max:60'
        ]);
        Colocation::create([
            'name'=>$vaidated['name'],
            'role'=>'active',
            'Owner_id'=> Auth::id()
        ]);
    }
    public function cancel(Colocation $colocation)
    {

    }

}
