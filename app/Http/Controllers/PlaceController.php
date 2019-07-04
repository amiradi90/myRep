<?php

namespace App\Http\Controllers;

use App\DocRemain;
use App\Http\myHelper;
use App\place;
use App\StockRemain;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{

    public function index()
    {
        return view('place.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\place $place
     * @return \Illuminate\Http\Response
     */
    public function show($stockid)
    {

//        dd($stockid);
        return view('place.placement', ['stockid' => $stockid]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\place $place
     * @return \Illuminate\Http\Response
     */
    public function edit(place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\place $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, place $place)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\place $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(place $place)
    {
        //
    }

    public function searchBarcode(Request $request)
    {
        $bar = "'" . $request->input('e') . "'";
        $bar = str_replace('=', '', $bar);

//        $bar="1234100017";
//        dd($bar);
        //dd($part);
        $part = DB::connection('sqlsrv')
            ->select("select top 1 p.Serial,p.PartCode as partcode,gb.BarCode as barcode,
                                    p.PartName as name ,1 as cnt,pt.Title as grp
    ,(select top 1 pspi.Price from pos.PosSalePrice psp
	join pos.PosSalePriceItem pspi on psp.PosSalePriceId=pspi.PosSalePriceRef
	where pspi.PartRef=p.Serial and psp.State=1 and( MUnitRef=1 or MUnitRef=2)
	order by psp.EffectiveDate desc,pspi.PosSalePriceItemId desc ) as price
	from inv.part p
	left join gnr.GnrBarcode gb on gb.EntityRef=p.Serial
	join inv.GrpPart gp on gp.PartRef=p.Serial
	join inv.PartTree pt on pt.Serial=gp.PartTreeRef
	--join amm.partrefcardex xx on xx.partref=p.serial
	where p.DisActive=0 and gp.SystemTag='02' --and gb.isdefault=1
    and gb.barcode = " . $bar . "
");
        //$part = DB::connection('sqlsrv')->select('EXEC [AMM].[searchBarcode] @barcode = ' . $bar . '');

        return view('sg.doc.sB', ['result' => $part]);
    }

    public function searchPartcode($stockid, Request $request)
    {
        $p = $request->input('q');
        $stock = StockRemainController::Branch($stockid);//انبار مورد نظر
//        dd($stock);
        $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

        $res = DB::connection('sqlsrv')->select("
         select distinct top 20 p.serial,p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode and x.stock=" . $stock . "
           and x.status=2) as remain,p.partno as publisher,gp.title as grp
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         join AMM.partrefcardex xx on xx.partref=p.serial
         where p . DisActive = 0 and gp.SystemTag='02' --and xx.stock in (" . $stock . ")
         --and p.Serial in (select distinct xx.PartRef from PosVwCardexhoshes xx where xx.status=2)
         --and p.Serial in (select distinct xx.PartRef from amm.partrefcardex xx)
         --and p.partcode like '%" . $p . "%'
         and p.partcode like '%" . $split[0] . "%' and p.partcode like '%" . $split[1] . "%'
         --order by remain desc
         ");
        return view('place.ShowPartcodes', ['result' => $res, 'query' => $p, 'stock' => $stock]);
    }

    public function selectPartcode(Request $request)
    {
//        dd($request);
//        $part = $request->input('q');
        $partref = $request->input('partref');
        $stock = StockRemainController::Branch(($request->input('stockid')));
        set_time_limit(30);
//        $res = DB::connection('sqlsrv')->select(
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

//        $ar = array();
        foreach ($res as $r) {
//            array_push($ar,$r);
            $join = DB::table('places')
                ->select('places.*')
                ->where('places.partcode', $r->partcode)
                ->where('places.stock', $stock)
                ->get();
        }
//        dd($join[0]);

//        $data = DB::connection('sqlsrv')
//            ->select('select * from inv.stock')
//            ->leftJoin('users', 'users.id', '=', 'inv.stock.id')
////            ->leftJoin(DB::connection('sqlsrv')->select('select * from inv.stock'));

//        $dbs_size = DB::select($res);
//        dd($data);
//        $res::where
//        dd($res->('partcode','1234100017'));
//            return (int)empty($join->shelf);

        if ((int)!empty($join[0]->shelf)) {
//            dd(1);
            return view('place.insertProd', ['result' => $join]);

        } else {
//        dd(2);
            return view('place.insertProd', ['result' => $res]);
        }
    }

    public function UpdateShelf(Request $request)
    {

//        error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        dd($request->input('barcode'));
        $partref = $request->input('partref');
        $partcode = $request->input('partcode');
        $barcode = $request->input('barcode');
        $partname = $request->input('partname');
        $stock = StockRemainController::Branch((int)$request->input('stockid'));
//        dd($barcode);
        $shelf = $request->input('shelf');
        if (!is_numeric($shelf) || (int)$shelf < 1 || !ctype_digit($shelf)) {
            return 'error';
        }

        $placeExistanceCheck = place::where(['partref' => $partref, 'stock' => $stock, 'active' => 1])->first();
        if (!isset($placeExistanceCheck)) {
            $place = place::create(['partref' => $partref, 'barcode' => $barcode, 'partcode' => $partcode, 'partname' => $partname,
                'stock' => $stock, 'shelf' => $shelf, 'active' => 1, 'creator' => Auth::user()->id]);
            return ' کد ' . $place->partcode . ' در قفسه به شماره : ' . $place->shelf . ' جانمایی  شد.';
        } else {
            if ($placeExistanceCheck->update(['shelf' => $shelf]))
                return 'کد ' . $placeExistanceCheck->partcode . ' به روز شد در قفسه به شماره :' . $placeExistanceCheck->shelf;
            else
                return '!!!!!!!!!!!!!!!!!!!!!!!!!به روزرسانی ناموفق';
        }
    }

    public function UpdateShelfFromDraft(Request $request)
    {
//        return $request->input('opStockRef');
//        error_reporting(E_ERROR | E_WARNING | E_PARSE);
//        dd($request->input('barcode'));
        $partref = $request->input('partref');
        $partcode = $request->input('partcode');
        $barcode = $request->input('0');
        $partname = $request->input('partname');
        $opStockRef = $request->input('opStockRef');
//        dd($barcode);
        $shelf = $request->input('shelf');
        if (!is_numeric($shelf) || (int)$shelf < 1 || !ctype_digit($shelf)) {
            return 'error';
        }

        $placeExistanceCheck = place::where(['partref' => $partref, 'stock' => $opStockRef, 'active' => 1])->first();
        if (!isset($placeExistanceCheck)) {
            $place = place::create(['partref' => $partref, 'barcode' => $barcode, 'partcode' => $partcode, 'partname' => $partname,
                'stock' => $opStockRef, 'shelf' => $shelf, 'active' => 1, 'creator' => Auth::user()->id]);
            return ' کد ' . $place->partcode . ' در قفسه به شماره : ' . $place->shelf . ' جانمایی  شد.';
        } else {
            if ($placeExistanceCheck->update(['shelf' => $shelf, 'updater' => Auth::user()->id]))
                return 'کد ' . $placeExistanceCheck->partcode . ' به روز شد در قفسه به شماره :' . $placeExistanceCheck->shelf;
            else
                return '!!!!!!!!!!!!!!!!!!!!!!!!!به روزرسانی ناموفق';
        }
    }

    public function PriceChange(Request $request)
    {
//        return myHelper::res();
//        $d=$request->get('email','1');
//        return $d;
        $date = $request->input('date');
        set_time_limit(50);
        $res = DB::connection('sqlsrv')->select("        
select tbl2.PartRef,tbl2.PartCode as partcode,tbl2.PartName as partname,tbl2.datePicked as datePicked,tbl2.priceInDate as priceInDate,tbl2.priceOld as priceOld
,gp.Title as grp
,(select sum(x1.xqtyratio) from PosVwCardex x1 where x1.PartRef=tbl2.PartRef and x1.Status=2 and x1.stock=30) as B1
,(select sum(x2.xqtyratio) from PosVwCardex x2 where x2.PartRef=tbl2.PartRef and x2.Status=2 and x2.stock=20) as B2
,(select sum(x1.xqtyratio) from PosVwCardex x1 where x1.PartRef=tbl2.PartRef and x1.Status=2 and x1.stock=21) as B3
,(select sum(x2.xqtyratio) from PosVwCardex x2 where x2.PartRef=tbl2.PartRef and x2.Status=2 and x2.stock=22) as B4

from (select tbl1.*,(select top 1 tpspi.Price from pos.vwPosSalePrice tpsp join pos.vwPosSalePriceItem tpspi 
				on tpsp.PosSalePriceId=tpspi.PosSalePriceRef 
				where  tpspi.PartRef=tbl1.PartRef and tpspi.munitref in (1,2) and tpsp.EffectiveDate<'" . $date . "'
				order by tpsp.EffectiveDate desc,tpsp.PosSalePriceId desc
				) as priceOld
							 from(select i.PartRef,i.partcode,i.PartName, i.price as priceInDate,gnr.sgfn_DateToShamsiDate(psp.EffectiveDate) datePicked
								from pos.PosSalePrice psp join pos.vwPosSalePriceItem i on psp.PosSalePriceId=i.PosSalePriceRef
								join inv.Part p on p.Serial=i.PartRef
								--left join inv.vwGroupPart gp on gp.PartCode=i.PartCode
								where psp.EffectiveDate='" . $date . "'
								) as tbl1 
							)as tbl2
left join inv.vwGroupPart gp on gp.PartRef=tbl2.PartRef
where tbl2.priceInDate<>tbl2.priceOld --or tbl2.priceOld is null
order by tbl2.partcode desc,tbl2.priceInDate desc
        ");
        return view('price.priceShow', ['res' => $res]);
//        return $res;
    }

    public function listPlacement(Request $request)
    {
        return view('place.listPlaces');
    }

    public function listShowPlacement(Request $request)
    {
        $stock = StockRemainController::Branch($request->input('stock'));
        $result = place::where('stock', $stock)->where('active', 1)->paginate(10);
//        dd($result);
        return view('place.listShow', ['result' => $result]);
    }

    public function searchPartname($stockid, Request $request)
    {
//        return 'called partname fn';
        $p = $request->input('q');
        $stock = StockRemainController::Branch($stockid);//انبار مورد نظر
//        dd($stock);
        $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

        $res = DB::connection('sqlsrv')->select("
         select distinct top 50 p.serial,p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode and x.stock=" . $stock . "
           and x.status=2) as remain,p.partno as publisher,gp.title as grp
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         join AMM.partrefcardex xx on xx.partref=p.serial
         where p . DisActive = 0 and gp.SystemTag='02' --and xx.stock in (" . $stock . ")
         --and p.Serial in (select distinct xx.PartRef from PosVwCardexhoshes xx where xx.status=2)
         --and p.Serial in (select distinct xx.PartRef from amm.partrefcardex xx)
         --and p.partcode like '%" . $p . "%'
         and p.partname like '%" . $split[0] . "%' and p.partname like '%" . $split[1] . "%'
         --order by remain desc
         ");
        return view('place.ShowPartcodes', ['result' => $res, 'query' => $p, 'stock' => $stock]);
    }
}
