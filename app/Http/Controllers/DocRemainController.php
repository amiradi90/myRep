<?php

namespace App\Http\Controllers;

use App\DocRemain;
use Illuminate\Http\Request;

class DocRemainController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(DocRemain $docRemain)
    {
        //
    }

    public function edit(DocRemain $docRemain)
    {
        //
    }

//    public function update(Request $request, DocRemain $docRemain)
    public function update(Request $request)
    {
        $r = $request->input('data');
        for ($k = 0; $k < count($r); $k++) {

        }
        return $r;
    }

    public function destroy(DocRemain $docRemain)
    {
        //
    }
}
