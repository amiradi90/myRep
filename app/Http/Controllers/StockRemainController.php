<?php

namespace App\Http\Controllers;

use App\Doc;
use App\DocRemain;
use App\StockRemain;
use Carbon\Carbon;
use function Complex\add;
use function GuzzleHttp\Psr7\_caseless_remove;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockRemainController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return view('RemainControl.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(StockRemain $stockRemain)
    {
        //
    }

    public function edit(StockRemain $stockRemain)
    {
        //
    }

    public function update(Request $request, StockRemain $stockRemain)
    {
        $data = $request->input('data');
        str_replace($data, '=', '');
        $id = (int)$data[0];
        $partcode = $data[1];
        $remain2 = $data[2];
        if (!is_numeric($data[2]) || (int)$data[2] < 0 || !ctype_digit($data[2])) {
            return false;
        }
        $stock = $data[3];
        $docRemainId = $data[4];
        $sr = StockRemain::where('id', $id)->where('partcode', $partcode)->where('stock', $stock)
            ->where('docremain_id', $docRemainId)->first();
        $sr->remain2 = $remain2;
        $sr->updater = auth()->user()->id;

        if ($sr->update() && $sr->count() > 0)
            return $partcode . ' =>' . $remain2;
        else return false;
    }

    public function destroy(StockRemain $stockRemain)
    {
        //
    }

    public static function DaysBetween($d1, $d2)
    {
        $d1 = Carbon::parse(substr($d1, 0, 10));
        $d2 = Carbon::parse(substr($d2, 0, 10));
        $d = $d1->diffInDays($d2);
        return $d;
    }

    public function InsBrRem()
    {
//        set_time_limit(0);
//        $data = DB::connection('sqlsrv')
//            ->select('select x.PartCode partcode,b.BarCode barcode,x.PartName name,p.PartNo \'publisher\',x.stock,gp.Title grp,4 as docremain_id,0 as checked,
//case    when gp.title =\'کمک درسي\' then 1
//		when gp.title = \'زبان\' then 2
//		when gp.title= \'دانشگاهی\' then 3
//		when gp.title= \'کامپيوتر\' then 3
//		when gp.title like \'%عمومي%\' then 4
//		when gp.title=\'کودکان\' then 5
//		when gp.title like \'%لوازم التحرير%\' then 6
//		when gp.title = \'سي دي\' then 7
//		else 100
//		end as grpid,
//sum(x.xQtyRatio)as remain
//from PosVwCardex x
//left join gnr.GnrBarcode b on b.EntityRef=x.PartRef and b.IsDefault=1
//left join inv.vwGroupPart gp on gp.PartRef=x.PartRef
//left join inv.Part p on p.PartCode=x.PartCode
//where x.stock=22 and  gp.SystemTag=\'02\'
//group by x.PartRef,x.PartCode,b.BarCode,x.PartName,p.PartNo,x.stock,gp.Title
//having sum(x.xQtyRatio)>0
//order by x.stock,grpid,grp,x.PartCode desc,publisher
//');
//        return 'Done';
        return 'will Run soon';
    }

    protected static function refreshRemain(array $p, $stock, $docremain_id)
    {
//        return null;
        set_time_limit(0);
//        return 'method called';
//        return $p[0];
        foreach ($p as $i) {
            $newRemain = DB::connection('sqlsrv')->select("
        select sum(x.xqtyratio) as remainNow from posvwcardex x where x.PartCode = '" . $i . "' and x.Status=2 and x.stock='" . $stock . "'
        ");
            $upd = StockRemain::where('partcode', $i)->where('stock', $stock)->where('docremain_id', $docremain_id)
                ->update(['remain' => (int)$newRemain[0]->remainNow]);
        };
    }

    protected function RefreshRemainOnline(Request $request)
    {
        set_time_limit(0);
        $stock = (int)$request->input('stock');
        $docid = (int)$request->input('docid');
        $day = (int)$request->input('day');
//        return $stock.' '.$day.' '.$docid;
        $data = DB::select('select sr.partcode from amm.stockremain sr
        where sr.stock=' . $stock . ' and sr.pickdateday=' . $day . ' and sr.checked=1 and sr.docremain_id=' . $docid . '
        ');
//        return $data;
        $arr = array();
        foreach ($data as $p) {
            array_push($arr, $p->partcode);
        };
        $this->refreshRemain($arr, $stock, $docid);
        return 'refreshed successfully';
    }

    public static function Branch($stockid)
    {
        $branch = 0;
        switch ($stockid) {
            case 1:
                $branch = 30;
                break;
            case 2:
                $branch = 20;
                break;
            case 3:
                $branch = 21;
                break;
            case 4:
                $branch = 22;
                break;
            default:
                $branch = 0;
        }
        return $branch;
    }

    public function pickPartcode($stockid)
    {
//        return 'yield';
        $role1 = 'b' . $stockid . '_members';
        $branch = $this->Branch($stockid);
        $today = Carbon::now();
        set_time_limit(0);
        $lastDoc = DocRemain::where('stock', $branch)->where('status', 1)->first();
//        dd($this->DaysBetween($lastDoc->created_at, $lastDoc->pickdate));
        if (substr($lastDoc->pickdate, 0, 10) != substr(Carbon::now(), 0, 10)) {//if today is not picked
//        dd(substr($lastDoc->pickdate, 0, 10));
            $query = DB::select('
(select * from stockremain sr where sr.grpid=1 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union all
(select * from stockremain sr where sr.grpid=2 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union all
(select * from stockremain sr where sr.grpid=3 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union
(select * from stockremain sr where sr.grpid=4 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union
(select * from stockremain sr where sr.grpid=5 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union
(select * from stockremain sr where sr.grpid=6 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 30)
union
(select * from stockremain sr where sr.grpid=7 and sr.checked=0 and sr.stock=' . $branch . ' and sr.docremain_id="' . $lastDoc->id . '" order by sr.id limit 15)

');
//            dd($lastDoc );
            $pickdateday = $this->DaysBetween($lastDoc->created_at, Carbon::now());
            $dr = DocRemain::find($lastDoc->id);
            $dr->pickdate = $today;
            $dr->pickdateday = $pickdateday;
            $dr->updater = Auth::user()->id;
            $dr->update();
            $a1 = array();
            foreach ($query as $q) {
                array_push($a1, $q->partcode);//pick part code for fresh remain//
                $s = StockRemain::where('id', $q->id)
                    ->update(['updated_at' => Carbon::now(),
                        'checked' => 1,
                        'pickdate' => $dr->pickdate,
                        'pickdateday' => $dr->pickdateday]);
//                array_push($s, $q->id);//pick id for fresh remain//
            };
            $this->refreshRemain($a1, $branch, $lastDoc->id);//refresh remain

        } else {// if today is picked before
            $pickdateday = $this->DaysBetween($lastDoc->created_at, Carbon::now());
            $dr = DocRemain::where('pickdateday', $pickdateday)->where('status', 1)
                ->where('stock', $branch)->first();
            $lastday = (int)$dr->pickdateday;
            $drid = (int)$dr->id;
            if ($dr->count() > 0) {//if today is picked
//                dd($lastday);
                $query = DB::select("
        (select * from stockremain sr where sr . grpid = 1 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union all
        (select * from stockremain sr where sr . grpid = 2 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union all
        (select * from stockremain sr where sr . grpid = 3 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union
        (select * from stockremain sr where sr . grpid = 4 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union
        (select * from stockremain sr where sr . grpid = 5 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union
        (select * from stockremain sr where sr . grpid = 6 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        union
        (select * from stockremain sr where sr . grpid = 7 and sr . checked = 1 and stock = '" . $branch . "' and sr . docremain_id = '" . $drid . "' and sr . pickdateday = '" . $lastday . "')
        ");
            } else return 'first pick ';
        };
        return view('RemainControl.inserted', ['data' => $query, 'today' => $today, 'stockid' => $stockid, 'role1' => $role1]);
    }

    public function pickGrp($stockid, $inpgrpid)
    {
//        return 'yield';
        $role1 = 'b' . $stockid . '_members';
        $branch = $this->Branch($stockid);
        $today = Carbon::now();
        set_time_limit(0);
        $lastDoc = DocRemain::where('stock', $branch)->where('status', 1)->first();
        $pickdateday = $this->DaysBetween($lastDoc->created_at, $today);
//        $dr = DocRemain::where('pickdateday', $pickdateday)->where('stock',30)->where('status',1)->first();
//        $lastday = $dr->pickdateday;
//        $drid = $dr->id;
//        if ($dr->count() > 0) {//if today is picked
//            $query = DB::select("
//        (select * from stockremain sr where sr.grpid='" . (int)$inpgrpid . "' and sr.checked=1 and sr.stock=30 and sr.docremain_id='" . $drid . "' and sr.pickdateday='" . $lastday . "' )
//        ");
//        } else return 'first pick for today ';
//        return view('sg.inserted', ['data' => $query, 'today' => $today]);
        if ($pickdateday == $lastDoc->pickdateday) {
            $query = DB::select("
        (select * from stockremain sr where sr.grpid='" . (int)$inpgrpid . "'
         and sr.checked=1 and sr.stock='" . $branch . "' and
         sr.docremain_id='" . $lastDoc->id . "' and sr.pickdateday='" . $pickdateday . "' )
       ");
        } else return 'first pick for today ';
        return view('RemainControl.inserted', ['data' => $query, 'today' => $today, 'stockid' => $stockid, 'role1' => $role1]);
    }

//    public function pickBranchDay($docid, $stockid, $day)
    public function pickBranchDay(Request $request)
    {
//        dd($request);
//        $branch = self::Branch($stockid);
        if (!$request->has('stock')) {
            return view('RemainControl.summary', ['data' => null]);
        };
        $branch = self::Branch($request->input('stock'));
        $docid = $request->input('docid');
        $day = $request->input('day');

        $data = DB::select("
        (select * from stockremain sr where  sr.checked=1 and sr.stock='" . $branch . "' and
         sr.docremain_id='" . $docid . "' and sr.pickdateday='" . $day . "' )
       ");
        return view('RemainControl.summaryData', ['data' => $data]);

    }

    public function getImage(Request $request)
    {
        $partcode = $request->input('p');
        $json = file_get_contents("http://www.bahook.com/product/barcode/" . $partcode);
        if (isset($json[0]))
            return $json;
        return 0;
    }

    public function conflict()
    {
        return view('RemainControl.conflict');
    }

    public function conflictQuery(Request $req)
    {
        $branch = self::Branch($req->input('stock'));
        $pickdateday = $req->input('day');
        $docid = $req->input('docid');
        $d1id = DocRemain::where('stock', 30)->where('status', 1)->latest()->first()->id;
        $d2id = DocRemain::where('stock', 20)->where('status', 1)->latest()->first()->id;
        $d3id = DocRemain::where('stock', 21)->where('status', 1)->latest()->first()->id;
        $d4id = DocRemain::where('stock', 22)->where('status', 1)->latest()->first()->id;
//        DB::enableQueryLog();
        $res = DB::select("
        select sr.*,
        IFNULL((select sr1.remain from stockremain sr1 where sr1.partcode=sr.partcode and sr1.docremain_id=" . $d1id . " and sr1.stock=30 and sr1.checked=1 and sr1.remain2<>sr1.remain),'-') as B1_conflict,
        IFNULL((select sr2.remain from stockremain sr2 where sr2.partcode=sr.partcode and sr2.docremain_id=" . $d2id . " and sr2.stock=20 and sr2.checked=1 and sr2.remain2<>sr2.remain),'-') as B2_conflict,
        IFNULL((select sr3.remain from stockremain sr3 where sr3.partcode=sr.partcode and sr3.docremain_id=" . $d3id . " and sr3.stock=21 and sr3.checked=1 and sr3.remain2<>sr3.remain),'-') as B3_conflict,
        IFNULL((select sr4.remain from stockremain sr4 where sr4.partcode=sr.partcode and sr4.docremain_id=" . $d4id . " and sr4.stock=22 and sr4.checked=1 and sr4.remain2<>sr4.remain),'-') as B4_conflict
        from stockremain sr where sr.pickdateday=" . $pickdateday . " and sr.stock=" . $branch . " and sr.docremain_id=" . $docid . " and sr.remain<>sr.remain2;
");
//        return DB::getQueryLog();
//        dd( $branch.'-'.$pickdateday.'-'.$docid);
        return view('RemainControl.conflictData', ['res' => $res]);
    }

    public function BarcodePartcodeConflict($stockid)
    {
        $SelectedBranch = 'B' . @$stockid;
        $st = 'B' . $stockid;
        $rem = $SelectedBranch . 'Remain2';
//        return $rem;
        $data = DB::select('select * from amm.barcode_partcode bp where bp.' . $SelectedBranch . '>0 and  bp.remain>2 order by bp.grp');
        dd($data);
        return view('RemainControl.BarcodePartcode', ['data' => $data, 'stockid' => $stockid, 'rem' => $rem, 'st' => $st]);
    }

    public function bpUpdate(Request $request)
    {
        $data = $request->input('data');
        str_replace($data, '=', '');
        (string)$partcode = $data[0];
        $remain2 = $data[1];
        if (!is_numeric($data[1]) || (int)$data[1] < 0 || !ctype_digit($data[1])) {
            return false;
        }
        $StockColumn = $data[2];
//        return $data[0] . ' ' . $data[1] . ' ' . $data[2];
        $Q = DB::update('update amm.barcode_partcode set ' . $StockColumn . '= ?  where bp_partcode=?', [$remain2, $partcode]);
//        return $Q;
        return 'successfully Updated';

//        $sr = StockRemain::where('id', $id)->where('partcode', $partcode)->where('stock', $stock)
//            ->where('docremain_id', $docRemainId)->first();
//        $sr->remain2 = $remain2;
//        $sr->updater = auth()->user()->id;
    }

}
