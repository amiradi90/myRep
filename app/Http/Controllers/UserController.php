<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grids\UsersGridInterface;
use App\User;
use App\Grids\UsersGrid;
use App\Exports\UsersExport;
use App\Exports\InvoicesExport;
use App\Imports\UsersImport;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Excel;
use SebastianBergmann\Environment\Console;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(UsersGridInterface $usersGrid, Request $request)
    {
        // the 'query' argument needs to be an instance of the eloquent query builder
        // you can load relationships at this point
//        return $usersGrid
//            ->create(['query' => User::query(), 'request' => $request])
//            ->renderOn('user.index'); // render the grid on the welcome view
//        Role::create(['name'=>'b4_members']);
//        $a=Permission::create(['name'=>'edit']);
//        $r = Role::findByName('all_principals');

//        $query=DB::table('users')->select('name');
//        $user = $query->addSelect('email')->get();

//        dd($user);
        $user = User::all();
//        dd($user);
//        $user->assignRole('admin');
        foreach ($user as $u) {
            $u->assignRole('user');
            echo $u->getRoleNames();
        };
        return '<br/>' . $user;//->getRoleNames();
//        $p=Permission::all();
//        $r->givePermissionTo($p);
//        $r->revokePermissionTo($p);
//        return $r->getAllPermissions();
//        $u = Auth()->user();

//        $u = User::find(14);
//        $uu = User::WhereIn('id', [1,2])->get();
//        foreach ($uu as $i) {
//            $i->assignRole('b4_members');
//            $i->removeRole('admin');
//            echo $i->name.'</br>';
//        }
//        for ($i=0;$i<$r->count() ;$i++) {
//        echo $r->getAllPermissions()[$i] .'</br/>';

//        }
//        return $r->toArray();
//        retur n $uu[0]->getPermissionsViaRoles();
//        return $uu[0]->getRoleNames();

    }

    public function index2()
    {
//        $users = User::paginate(10);
//        return view('user.all', compact(['users']));
    }

    public function search(Request $request)
    {

//        $field = $request->input('p1');
//        $val = $request->input('p2');
//        $clear = $request->input('clr');
//        if ($clear) {
//            dd($clear);
//            $users = User::Where('all')->paginate(10);
//        } else {
//            $users = User::Where($field, 'like', '%' . $val . '%')->paginate(10);
//        }
//        return view('user.tablecontent', compact('users'));
    }

    public function create()
    {
    }

    public function up()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function export()
    {
////        return Excel::download(new InvoicesExport, 'users.xlsx');
//        return (new InvoicesExport)->download('invoices.xlsx');

//        $users = User::where('id', '>=', 10)->pluck('name', 'email');
        $users = \DB::table('users')->select('name', 'email')->get();
        $userArrays = [];
        $userArrays[] = ['name', 'email'];
        foreach ($users as $u) {
            $userArrays[] = $u;
        }
//        dd($userArrays);

        return (new InvoicesExport)->download('invoices.xlsx');
//        Excel::create('ExcelName', function($excel) use ($userArrays) {
//
//            // Set the spreadsheet title, creator, and description
//            $excel->setTitle('SomeUsers');
//            $excel->setCreator('Laravel')->setCompany('AMM');
//            $excel->setDescription('Some file');
//
//            // Build the spreadsheet, passing in the payments array
//            $excel->sheet('sheet1', function($sheet) use ($userArrays) {
//                $sheet->fromArray($userArrays, null, 'A1', false, false);
//            });
//
//        })->download('xlsx');
    }

    public function import()
    {
        return Excel::import(new UsersImport, 'users.xlsx');
    }
}
