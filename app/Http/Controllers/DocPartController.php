<?php

namespace App\Http\Controllers;

use App\Doc;
use App\DocPart;
use App\User;
use Carbon\Carbon;
use function GuzzleHttp\Promise\exception_for;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Complex\add;
use function MongoDB\BSON\toJSON;

class DocPartController extends Controller
{
    public function index()
    {
        $servername = $_SERVER['HTTP_HOST'];
        $dp = DB::table('amm.docs as d')
            ->leftJoin('amm.docparts as dp', 'd.id', '=', 'dp.doc_id')
            ->leftJoin('amm.users as u', 'd.creator', '=', 'u.id')
            ->select('d.id as DocId', DB::raw("MAX(dp.seq) as 'rows'"), DB::raw("sum(dp.cnt) as cnt"),
                'd.status as status', 'u.name as creator')
            ->selectRaw('(select u1.name from users u1 where u1.id=d.updater) as updater')
//            ->where('d.type', '=', '30')
            ->groupBy('d.id', 'd.creator')
            ->orderBy('d.id', 'desc')
            ->limit(10)
            ->paginate(200);
        return view('sg.doc.index', ['dp' => $dp, 'servername' => $servername]);

    }

    public function create()
    {
        return view('sg.doc.stockLaking');
    }

    public function store(Request $request)
    {
//        dd($request);
        set_time_limit(0);
        $r = $request->input('data');
//        $r = str_replace('=', '', $r);
//        dd($request);
        for ($k = 0; $k < count($r); $k++) {
            if (($k % 8) == 0) {
                if (!is_numeric($r[$k + 3]) || (int)$r[$k + 3] < 1 || !ctype_digit($r[$k + 3])) {
                    return false;
                }
            }
        }
        $doc = new Doc();
        $doc->type = 30;
        $doc->status = 1;
        $doc->creator = Auth::id();
//        $doc->updater = Auth::id();
        $doc->save();

        for ($i = 0; $i < count($r); $i++) {
            if (($i) % 8 == 0) {
                $d = new DocPart();
                $d->barcode = $r[$i];
                $d->partcode = $r[$i + 1];
                $d->name = $r[$i + 2];
                $d->cnt = (int)$r[$i + 3];
                $d->grp = $r[$i + 4];
                $d->price = intval(preg_replace('/[^\d\.]/', '', $r[$i + 5]));
                $d->doc_id = $doc->id;
                $d->seq = (int)$r[$i + 7];
                $d->created_at = \Carbon\Carbon::now();
                $d->creator = Auth::id();
                $d->updater = Auth::id();
                if ($d->save())
                    ; //echo('docPart created with id=> ' . $d->id . '</br>');
                else {
                    $doc->delete();
                    return false;
                }
            }
        }
        $docId = $doc->id;
        return $docId;
    }

    public function show($id)
    {
        return 'show function called';
    }

    public function edit($id)
    {
        $doc = Doc::find($id);
        $creator = User::find($doc->creator)->name;
        $docp = $doc->docparts;
        $docStatus = $doc->status;
        return view('sg.doc.showDocPart', ['result' => $docp, 'docid' => $id, 'creator' => $creator, 'docStatus' => $docStatus]);
    }

    public function update(Request $request)
    {
//        $r = str_replace('=', '', $r);
        {
//            $req_dump = print_r($request->input('data'), true);
//            $fp = file_put_contents('request2.log', $req_dump, FILE_APPEND);
        }

        $r = $request->input('data');
        for ($k = 0; $k < count($r); $k++) {
            if (($k % 8) == 0) {
                if (!is_numeric($r[$k + 3]) || (int)$r[$k + 3] < 1 || !ctype_digit($r[$k + 3])) {
//                    return false;
                    return false;
                }
            }
        }
        $documentId = $request->input('documentid');
        set_time_limit(0);
        $stime = (count($r) / 8) * (1) / (10);//time to sleep
//        DB::selectRaw('lock tables amm.docparts write');
        if (DocPart::where('doc_id', $documentId)->delete()) {
            sleep($stime);
            $doc = Doc::find($documentId);
            $doc->updater = Auth::id();
            $doc->save();
            for ($i = 0; $i < count($r); $i++) {
                if (($i) % 8 == 0) {
                    $dp = new DocPart();
                    $dp->barcode = $r[$i];
                    $dp->partcode = $r[$i + 1];
                    $dp->name = $r[$i + 2];
                    $dp->cnt = (int)$r[$i + 3];
                    $dp->grp = $r[$i + 4];
                    $dp->price = intval(preg_replace('/[^\d\.]/', '', $r[$i + 5]));
                    $dp->doc_id = $doc->id;
                    $dp->seq = (int)$r[$i + 7];
                    $dp->updated_at = \Carbon\Carbon::now();
//                $dp->creator = Auth::id();
                    $dp->creator = $doc->creator;
                    $dp->updater = Auth::id();
                    if ($dp->save())
                        ;
                    else {
//                        Db::raw('unlock tables');
                        return false;
                    }
                }
            }
//            Db::raw('unlock tables');
            return 'Update is Done.Sleep in : ' . $stime . " sec";
        } else {
//            $error= 'this is updating now';
//            return assertFalse('',$error);
//            Db::raw('unlock tables');
            return false;
        };

    }

    public function destroy(DocPart $docPart)
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

    public function selectPartcode(Request $request)
    {
//        $part = $request->input('q');
        $partref = $request->input('partref');
        set_time_limit(30);
        $res = DB::connection('sqlsrv')->select(
            "select top 1 p.Serial,p.PartCode as partcode,gb.BarCode as barcode,
     p.PartName as name ,1 as cnt,pt.Title as grp,
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
        return view('sg.doc.sB', ['result' => $res]);
    }

    public function searchPartcode111(Request $request)
    {
        $p = $request->input('q');
        $p = str_replace('=', '', $p);
        $res = DB::connection('sqlsrv')->table('inv.part')
            ->Join('inv.vwgrouppart', 'inv.part.serial', '=', 'inv.vwgrouppart.partref')
//            ->Join('inv.vwgrouppart', 'inv.part.serial', '=', 'inv.vwgrouppart.partref')
            ->select('inv.part.partcode', 'inv.part.partname', 'inv.part.partno as publisher',
                DB::raw('(select top 1 pspi . Price from pos . PosSalePrice psp
	join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
	 where pspi . PartRef = inv.part.Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
	 order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price'))
            ->where('inv.part.partcode', 'like', '%' . $p . '%')
            ->where('inv.part.disactive', '0')
            ->WhereRaw('(inv.vwgrouppart.systemtag is null or inv.vwgrouppart.systemtag=\'02\')')
//            ->orderBy('inv.part.partcode')
            ->limit(100)
            ->distinct()
            ->get();
        return view('sg.doc.sp', ['result' => $res, 'query' => $p]);
//        return view('sg.doc.sp', ['result' => $res]);
    }

    public function searchName111(Request $request)
    {
        $p = $request->input('q');
        $p = str_replace('=', '', $p);
//        $p = '123410001';
        $res = DB::connection('sqlsrv')->select("
         select distinct top 100 p . partcode,p . partname,
         (select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and ( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price,p.partno as publisher
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         where p . DisActive = 0 and (gp.SystemTag is null or gp.SystemTag='02')
         and p.partname like '%" . $p . "%' 
         ");
        return view('sg.doc.sp', ['result' => $res, 'query' => $p]);
        //return view('sg.doc.sp', ['result' => $res]);
    }

    public function sgbId(Request $request)
    {
        $p = (string)($request->input('q'));
        $p = str_replace('=', '', $p);
        $res = DB::connection('mysql610')->select("
        select p.id,p.barcode as barcode,p.`name` from pr_pub_st p
where p.barcode= $p");


        return view('SGB.barcode', ['result' => $res]);
    }

    public function sgbName(Request $request)
    {
        $p = (string)($request->input('q'));
        $p = str_replace('=', '', $p);
        $res = DB::connection('mysql610')->select("
        select p.id,p.barcode ,p.`name` from pr_pub_st p
        where p.name like '%$p%'");

        return view('SGB.name', ['result' => $res]);
    }

    public function finalDocConfirm($docid, Request $request)
    {
        $currentStatus = $request->input('currentStatus');
        $doc = Doc::find($docid);
        if ($currentStatus == 1) {
            $doc->status = 2;
            $doc->updater = Auth::id();
            $doc->updated_at = \Carbon\Carbon::now();
            $doc->save();
            return 'تایید شد';
        } else if ($currentStatus == 2) {
            $doc->status = 1;
            $doc->updater = Auth::id();
            $doc->updated_at = \Carbon\Carbon::now();
            $doc->save();
            return 'تایید نهایی';
        }
    }

    public function ShowRemain(Request $request)
    {
        $code = (string)$request->input('p');
        $stock = (int)$request->input('stock');

        $partref = DB::connection('sqlsrv')->select("select top 1 p.serial from inv.part p where p.partcode='" . $code . "' ");
        $p1 = ($partref[0]->serial);

//        $specs = DB::connection('sqlsrv')->select(
//            "exec sp_executesql N'SELECT title,
//                               ISNULL(SubTitle, VALUE) VALUE
//                        FROM   inv.invSpecPart SP
//                               INNER JOIN inv.invSpec S
//                                    ON  Sp.SpecRef = S.SpecId
//                               LEFT OUTER JOIN inv.InvSubSpec SS
//                                    ON  Sp.SubSpecRef = Ss.SubSpecId
//                        WHERE  PartRef = @PartRef',N'@partRef bigint',@partRef=" . $p1 . "
//                        ");
//        return $specs;

        $r = DB::connection('sqlsrv')->select("
        declare @d datetime= getdate();
exec sp_executesql N'SELECT [POS].[fnGetPartRemain](@partref,@date,@stockref,null,@QtyCtrlValRef1,@BaseQtyCtrl1,@QtyCtrlValRef2,@BaseQtyCtrl2)',
N'@Date datetime,@PartRef bigint,@StockRef bigint,@QtyCtrlValRef1 nvarchar(4000),@BaseQtyCtrl1 nvarchar(4000),@QtyCtrlValRef2 nvarchar(4000),
@BaseQtyCtrl2 nvarchar(4000)',@Date=@d,
@PartRef=" . $p1 . ",@StockRef=" . @$stock . ",@QtyCtrlValRef1=NULL,@BaseQtyCtrl1=NULL,@QtyCtrlValRef2=NULL,@BaseQtyCtrl2=NULL
        ");
        return $r;

    }

    public function Specs(Request $request)
    {
        $p = $request->input('partref');
        $specs = DB::connection('sqlsrv')->select(
            "exec sp_executesql N'SELECT title,
                               ISNULL(SubTitle, VALUE) VALUE
                        FROM   inv.invSpecPart SP
                               INNER JOIN inv.invSpec S
                                    ON  Sp.SpecRef = S.SpecId
                               LEFT OUTER JOIN inv.InvSubSpec SS
                                    ON  Sp.SubSpecRef = Ss.SubSpecId
                        WHERE  PartRef = @PartRef',N'@partRef bigint',@partRef=" . $p . "
                        ");
    }

    public function searchName(Request $request)
    {
//        dd();
        $stockId = $request->input('stockId');//For jostojoo
        $stock = (empty($stockId) ? 30 : $stockId);
//        return $stock;
//        $stock = 30;// stock stocklacking
        $p = $request->input('q');
        $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

//        dd($split[1]);
        $res = DB::connection('sqlsrv')->select("
         select distinct top 100 p.serial, p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode and x.stock=" . $stock . " and x.status=2) as remain,p.partno as publisher
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         join AMM.partrefcardex xx on xx.partref=p.serial
         where p . DisActive = 0 and gp.SystemTag='02' --and xx.stock in (" . $stock . ")
         --and p.Serial in (select distinct xx.PartRef from PosVwCardexhoshes xx where xx.status=2)
         --and p.Serial in (select distinct xx.PartRef from amm.partrefcardex xx)
         --and p.partname like '%" . $p . "%'
         and p.partname like '%" . $split[0] . "%' and p.partname like '%" . $split[1] . "%'
         --order by remain desc
         ");
//        $res = DB::connection('sqlsrv')->select('EXEC [AMM].[searchName] @partname = ' . $p . '');

        return view('sg.doc.sp', ['result' => $res, 'query' => $p, 'stock' => $stock]);
    }

    public function searchPartcode(Request $request)
    {
        $stockId = $request->input('stockId');//For jostojoo
        $stock = (empty($stockId) ? 30 : $stockId);
        $p = $request->input('q');
//        $stock = 30;//انبار مورد نظر
        $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

//        $res = DB::connection('sqlsrv')->table('inv.part')
//            ->Join('inv.vwgrouppart', 'inv.part.serial', '=', 'inv.vwgrouppart.partref')
//            //->Join('posvwcardexhoshes', 'inv.part.serial', '=', 'posvwcardexhoshes.partref')
//            ->join('AMM.partrefcardex', 'AMM.partrefcardex.partref', 'inv.part.serial')//فقط انهایی که دارای گردش در این جدول هستند
//            ->select('inv.part.partcode', 'inv.part.partname', 'inv.part.partno as publisher',
//                DB::raw('(select top 1 pspi . Price from pos . PosSalePrice psp
//                            join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
//                            where pspi . PartRef = inv.part.Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
//                            order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price'),
//                DB::raw('(select sum(x.xqtyratio) from PosVwCardex x
//                          where x.PartCode=inv.part.partcode and x.stock=' . $stock . ' and x.status=2) as remain'))
//            ->where('inv.part.partcode', 'like', '%' . $p . '%')
//            ->where('inv.part.disactive', '0')
////            ->where('AMM.partrefcardex.stock', $stock)//دارای گردش در انبار مورد نظر
//            ->whereIn('AMM.partrefcardex.stock', [$stock])//دارای گردش در انبار مورد نظر
////            ->whereRaw('AMM.partrefcardex.stock in ('.26.')')//دارای گردش در انبار مورد نظر
////            ->where('posvwcardexhoshes.status', '2')
////            ->where('posvwcardexhoshes.stock', '30')
//            ->WhereRaw('inv.vwgrouppart.systemtag=\'02\'')
////            ->whereRaw('inv.part.Serial in (select distinct xx.PartRef from PosVwCardexhoshes xx where xx.status=2)')
////            ->WhereRaw('(inv.vwgrouppart.systemtag is null or inv.vwgrouppart.systemtag=\'02\')')
//            ->limit(100)
////            ->orderBy('remain','desc')
//            ->distinct()
//            ->get();

        $res = DB::connection('sqlsrv')->select("
         select distinct top 100 p.serial,p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode and x.stock=" . $stock . "
                                                            and x.status=2) as remain,p.partno as publisher
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
        return view('sg.doc.sp', ['result' => $res, 'query' => $p, 'stock' => $stock]);
    }

    public function jostojooView()
    {
        return view('SG.Doc.jostojoo');
    }

    public function jostojooPublisher(Request $request)
    {
        $stockId = $request->input('stockId');//For jostojoo
        $stock = (empty($stockId) ? 30 : $stockId);
        $p = $request->input('q');
//        $stock = 30;//انبار مورد نظر
        $p = str_replace('=', '', $p);
        $split = explode('++', $p);
        $split[1] = !empty($split[1]) ? $split[1] : '';

        $res = DB::connection('sqlsrv')->select("
         select distinct top 100 p.serial,p . partcode,p . partname
         ,(select top 1 pspi . Price from pos . PosSalePrice psp
         join pos . PosSalePriceItem pspi on psp . PosSalePriceId = pspi . PosSalePriceRef
         where pspi . PartRef = p . Serial and psp . State = 1 and( MUnitRef=1 or MUnitRef=2)
         order by psp . EffectiveDate desc,pspi . PosSalePriceItemId desc ) as price
         ,(select sum(x.xqtyratio) from PosVwCardex x where x.PartCode=p.partcode and x.stock=" . $stock . "
                                                            and x.status=2) as remain,p.partno as publisher
         from inv . part p
         join inv.vwgrouppart gp on gp.partref=p.serial
         join AMM.partrefcardex xx on xx.partref=p.serial 
         where p . DisActive = 0 and gp.SystemTag='02' --and xx.stock in (" . $stock . ")
         --and p.Serial in (select distinct xx.PartRef from PosVwCardexhoshes xx where xx.status=2)
         --and p.Serial in (select distinct xx.PartRef from amm.partrefcardex xx)
         --and p.partcode like '%" . $p . "%'
         and p.partno like '%" . $split[0] . "%' and p.partno like '%" . $split[1] . "%'
         
         --order by remain desc
         ");
        return view('sg.doc.sp', ['result' => $res, 'query' => $p, 'stock' => $stock]);
    }
}
