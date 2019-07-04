<?php

namespace App\Http\Controllers;

use App\barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarcodeController extends Controller
{
    public function index()
    {
        return view('barcode.barcodeGenerate');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(barcode $barcode)
    {
        //
    }

    public function edit(barcode $barcode)
    {
        //
    }

    public function update(Request $request, barcode $barcode)
    {
        //
    }

    public function destroy(barcode $barcode)
    {
        //
    }

    public function searchPartcode(Request $request)
    {
        $p = $request->input('q');
//        return $p;
//       $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

        $res = DB::connection('sqlsrv')->select("
         select distinct top 20 p.serial,p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode 
           and x.status=2) as remain,p.partno as publisher,gp.title as grp
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         join AMM.partrefcardex xx on xx.partref=p.serial
         where p . DisActive = 0 and gp.SystemTag='02' 
         and p.partcode like '%" . $split[0] . "%' and p.partcode like '%" . $split[1] . "%'
         --order by remain desc
         ");
//        return $res;
        return view('barcode.partials.ShowPartcodes', ['result' => $res, 'query' => $p]);
    }

    public function selectPartcode(Request $request)
    {
        $partref = $request->input('partref');
        set_time_limit(30);
        $res = DB::connection('sqlsrv')->select(
            "select top 1 p.Serial as partref,p.PartCode as partcode,gb.BarCode as barcode,
     p.PartName as partname ,1 as cnt,pt.Title as grp,
	(select top 1 pspi.Price from pos.PosSalePrice psp 
	 join pos.PosSalePriceItem pspi on psp.PosSalePriceId=pspi.PosSalePriceRef
	 where pspi.PartRef=p.Serial and psp.State=1 and( MUnitRef=1 or MUnitRef=2)
	 order by psp.EffectiveDate desc,pspi.PosSalePriceItemId desc ) as price
	 from inv.part p
	 left join gnr.GnrBarcode gb on gb.EntityRef=p.Serial
	 join inv.GrpPart gp on gp.PartRef=p.Serial
	 join inv.PartTree pt on pt.Serial=gp.PartTreeRef
	 where p.DisActive=0 and gp.SystemTag='02' --and gb.isdefault=1
     and p.serial =" . $partref . "
     order by gb.IsDefault desc
	 ;");
        return view('barcode.partials.insertProd', ['result' => $res]);

    }
}
