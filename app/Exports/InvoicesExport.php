<?php


namespace App\Exports;

//use App\Invoice;
use App\Products;
use App\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
//use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class InvoicesExport implements FromCollection
class InvoicesExport implements FromQuery
{
    use Exportable;

//    public function collection()
    public function query()
    {
        return User::all();

//        $users = \DB::table('users')->select('name', 'email')->get();
//        $userArrays = [];
//        $userArrays[] = ['name', 'email'];
//        foreach ($users as $u) {
//            $userArrays[] = $u;
//        }
//        return User::query();
    }
}


