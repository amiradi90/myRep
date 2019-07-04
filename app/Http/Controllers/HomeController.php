<?php

namespace App\Http\Controllers;

use App\Zino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use SimpleXMLElement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function zinoMenu()
    {
//        $schedule->command('inspire')
//            ->everyMinute();
        return view('zino.zinoMenu');
    }

    public static function xmlConvert($g)
    {
//        return $g;
        set_time_limit(0);
        $get = file_get_contents('http://92.246.147.221:5050/api/Home/GetProductByParentId?parentId=' . $g . '&sortId=1');

        $groudId[] = ['Id' => json_decode($get)->Breadcrumb[0]->Id, 'Title' => json_decode($get)->Breadcrumb[0]->Title];
//        return $groudId[0]['Id'];
        $jsons = json_decode($get)->Items;
        $items[] = [];
        $item[] = [];

        foreach ($jsons as $i) {
            $item = [
                'zinoId' => (int)$i->Id,
                'price' => intval(preg_replace('/[^0-9]+/', '', (string)$i->Amount)),
                'amount' => (string)$i->Amount,
                'image' => (string)$i->Image,
                'title' => strtok($i->Title, '<span>'),
//                'title' => $i->Title,
                'groupId' => $groudId[0]['Id'],
                'groupTitle' => $groudId[0]['Title'],
                'date' => date('Y-m-d')
            ];
            array_push($items, $item);
        }
        foreach ($items as $zino) {
            if (!empty($zino)) {
//                return $zino['zinoId'];
                $z = New Zino();
                $z->fill($zino);
                $ex = Zino::where('zinoId', $zino['zinoId'])->where('date', date('Y-m-d'))->first();
                if (empty($ex)) {
                    $z->save();
                }
//                dd($zino);
            }
        }
        dd($items);


    }


}
