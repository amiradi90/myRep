<?php

namespace App\Http\Controllers;

use App\Drafts;
use App\StockRemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DraftsController extends Controller
{

    public function index()
    {
        return view('drafts.index');
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


//    public function show(Drafts $drafts)
    public function show($branch = null)
    {
        $stock = StockRemainController::Branch($branch);
//        dd($branch);
        $lastDocs = DB::connection('sqlsrv')->select('select top 10 v.vchnum as vchnum from pos.vwposinvvch v 
                    where v.opstockref=' . $stock . ' and v.status=2 order by v.vchnum desc ');
        return view('drafts.drafts', ['branch' => $branch, 'lastDocs' => $lastDocs]);
    }

    public function show2($branch = null)
    {
        $stock = StockRemainController::Branch($branch);
//        dd($branch);
        $lastDocs = DB::connection('sqlsrv')->select('select top 10 v.vchnum as vchnum from pos.vwposinvvch v 
                    where v.opstockref=' . $stock . ' and v.status=2 order by v.vchnum desc ');
        return view('drafts.drafts2', ['branch' => $branch, 'lastDocs' => $lastDocs]);
    }

    public function edit(Drafts $drafts)
    {
        //
    }


    public function update(Request $request, Drafts $drafts)
    {
        //
    }


    public function destroy(Drafts $drafts)
    {
        //
    }

//    public function getDraftByNo(Request $request)
//    {
////        return 'ok';
//        $docno = (int)$request->input('docno');
//        $stock = StockRemainController::Branch((int)$request->input('branch'));
////        return $branch;
//
////        return $lastDocs;
//
//        $query = DB::connection('sqlsrv')->select('
//select  i.seq,v.vchnum as docno,gnr.sgfn_DateToShamsiDate(v.VchDate) as date,i.partcode,i.partname,gp.title grp,i.Qty,v.StockName as \'from\'
// ,v.OPStockName as \'to\' ,
// (select top 1 pspi . Price from pos . PosSalePrice psp join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
//	 where pspi . PartRef = i.partref and psp . State = 1 and( MUnitRef=1 or MUnitRef=2) order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
// from pos.vwPosInvVch v
//join pos.vwPosInvVchItm i on v.invvchid=i.InvVchRef
//left join inv.vwgrouppart gp on gp.partref=i.partref and gp.systemtag=\'02\'
// where v.vchnum=' . (int)$docno . ' and v.OpStockRef=' . (int)$stock . ' and v.vchtype=3 and v.status=2
// order by 1
//');
//
//        return view('drafts.draftPartial', ['query' => $query]);
//
//    }

    public function getDraftByNo2(Request $request)
    {
        $docno = (int)$request->input('docno');
        $stock = StockRemainController::Branch((int)$request->input('branch'));//انبار مقصد
        $stockref = 26;
//        return $branch;

//        return $lastDocs;

        $query = DB::connection('sqlsrv')->select('
select  i.seq as seq,v.vchnum as vchnum,gnr.sgfn_DateToShamsiDate(v.VchDate) as pDate,i.PartRef as partref,i.partcode,i.partname,gp.title grp,i.Qty as qty,v.StockName as stockRefName
 ,v.OPStockName as OPStockName ,v.OpStockRef as opStockRef ,v.StockRef as stockRef,
 (select top 1 pspi . Price from pos . PosSalePrice psp join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
	 where pspi . PartRef = i.partref and psp . State = 1 and( MUnitRef=1 or MUnitRef=2) order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
 from pos.vwPosInvVch v
join pos.vwPosInvVchItm i on v.invvchid=i.InvVchRef
left join inv.vwgrouppart gp on gp.partref=i.partref and gp.systemtag=\'02\'
 where v.vchnum=' . (int)$docno . ' and v.OpStockRef=' . (int)$stock . ' and v.stockref=' . $stockref . ' and v.vchtype=3 and v.status=2
 order by 1
');//Drafts Only From stockref=30
//        dd($query[0]->stockRef);
        $v = $query[0]->stockRef;
        if (!isset($v)) {
            return 'شماره سند اشتباه است.';
        }
//        return 'passed2';
//        $query->stockRef = (isset($query->stockRef) == true) ? $query->stockRef : 0;
        $ex = DB::table('drafts as d')->select('d.*', 'p.shelf')
//            ->leftJoin('places as p', 'p.partcode', '=', 'd.partcode')
            ->leftJoin('places as p', function ($join) use ($stock) {
                $join->on('p.partcode', '=', 'd.partcode');
                $join->where('p.stock', '=', $stock);
                $join->where("p.active", '=', 1);
            })
            ->where('d.vchnum', '=', (int)$docno)
            ->where('d.opStockRef', '=', (int)$stock)
            ->where('d.stockRef', '=', (int)$v)
            ->orderBy('d.seq')
            ->get();
//        dd($ex);
        if (isset($ex[0])) {//if model saved before;
            echo 'saved in db </br/>';
//            dd($ex);
            echo $ex[0]->vchnum;

        } else {
//            return "not Exists";

            foreach ($query as $d) {

                $dr1 = Drafts::create(
                    [
                        'seq' => $d->seq,
                        'partname' => $d->partname,
                        'partref' => $d->partref,
                        'partcode' => $d->partcode,
                        'qty' => $d->qty,
                        'vchnum' => $d->vchnum,
                        'vchtype' => 3,
                        'stockRef' => $d->stockRef,
                        'opStockRef' => $stock,
                        'pDate' => $d->pDate,
                        'grp' => $d->grp,
                        'price' => $d->price,
                        'checked' => 0,
                        'confirmed' => 0,
                        'creator' => Auth::user()->id
                    ]
                );
//                echo "<br/>" . $d->partcode;
            }
            echo 'در دیتابیس ذخیره شد.مجدداً Get را کلیک کنید';
        }

        return view('drafts.draftPartial2', ['query' => $ex]);
    }

    public function saveDraftCounted(Request $request)
    {
//        return '';
        $vchnum = (int)$request->input('vchnum');
        $partcode = $request->input('partcode');
        $cnt = (int)$request->input('cnt');
        $stockRef = (int)$request->input('stockRef');
        $opStockRef = (int)$request->input('opStockRef');
        if ($cnt <= 0)
            return false;

        $d1 = Drafts::where('vchnum', $vchnum)
            ->where('partcode', $partcode)
            ->where('stockRef', $stockRef)
            ->where('opStockRef', $opStockRef)
            ->first();
        $d1->cnt = $cnt;
        $d1->updater = Auth::user()->id;
        if ($d1->save())
            return $d1->partcode . ' =>' . $d1->cnt;
        return false;
    }
}
