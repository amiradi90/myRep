<?php

namespace App\Http\Controllers;

use App\DocPart;
use App\Doc;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {


    }


    public function show(Doc $doc)
    {
        //
    }


    public function edit(Doc $doc)
    {
        //
    }


    public function update(Request $request, Doc $doc)
    {

    }

    public function destroy(Doc $doc)
    {
        //
    }

    public function search2(Request $request, Doc $doc)
    {
        //        DB::table('users')->orderBy('id')->chunk(100, function ($users) {
//            foreach ($users as $user) {
//                //
//            }
//        });
        $bar = "'%" . $request->input('e') . "%'";
        $part = DB::select("select p.Serial,p.PartCode as partcode,p.PartName as name,gb.BarCode as barcode
                                 from inv.part p join gnr.GnrBarcode gb on gb.EntityRef=p.Serial
                                where p.DisActive=0 and gb.barcode like " . $bar . "
                                order by p.Serial desc
");
        return view('sg.doc.search', compact('part'));
    }

}
