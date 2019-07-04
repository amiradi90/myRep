<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('myLogout','LoginController@myLogout')->name('myLogout');
//use Illuminate\Support\Facades\DB;

//\Blade::setRawTags("[[", "]]");
//\Blade::setContentTags('<%', '%>'); // for variables and all things Blade
//\Blade::setEscapedContentTags('<%%', '%%>'); // for escaped data

Auth::routes();

Route::get('api/users/{user}', function (App\User $user) {
    return $user->email;
});

Route::get('pick/bp', 'StockRemainController@BarcodePartcodeConflict')->middleware('auth');
Route::get('pick/ins', 'StockRemainController@insBrRem')->middleware('auth');
Route::get('pick/getImage', 'StockRemainController@getImage');
Route::get('pick/summary', 'StockRemainController@pickBranchDay')->middleware('auth');//->middleware('role:admin|all_principals');
Route::get('pick/conflict', 'StockRemainController@conflict')->middleware('auth');//->middleware('role:admin|all_principals');
Route::get('pick/conflict/query', 'StockRemainController@conflictQuery')->middleware('auth');//->middleware('role:admin|all_principals');
Route::get('pick/RefreshRemainOnline', 'StockRemainController@RefreshRemainOnline')->middleware('auth');
Route::get('pick', 'StockRemainController@index')->name('pick');//->middleware('auth.basic');;
Route::post('pick', 'StockRemainController@update')->name('slPickPost')->middleware('auth');
Route::post('pick/bp', 'StockRemainController@bpUpdate')->middleware('auth');
Route::get('pick/{stockid}/{inpgrpid}', 'StockRemainController@pickGrp')->name('slPickGrp')->middleware('auth');
Route::get('pick/{stockid}', 'StockRemainController@pickPartcode')->middleware('auth');
//Route::get('pick/{stockid}', 'StockRemainController@BarcodePartcodeConflict')->middleware('auth');

Route::get('draft', 'DraftsController@index');
//Route::get('draft/{stockid}','DraftsController@show');
Route::get('draft2/{stockid}', 'DraftsController@show2')->middleware('auth');;
//Route::get('drafts/getDraft', 'DraftsController@getDraftByNo');
Route::get('drafts/getDraft2', 'DraftsController@getDraftByNo2')->middleware('auth');;
Route::get('drafts/saveDraftCounted', 'DraftsController@saveDraftCounted')->middleware('auth');


//Route::get('Draft/{stockid}', 'DraftController@Drafts')->middleware('auth');

Route::get('test', function () {
    return view('test.t7');
});

Route::get('t', function () {
    return view('test.t8');
});

Route::get('dorprd/{publisher}/{cat}', 'productController@DorDaneshProducts');//->name('/dor/{p}');
Route::get('dorprdLevel/{publisher}/{cat}/{level}', 'productController@DorDaneshProductsLevel');//->name('/dor/{p}');
//Route::get('dorprd/{p}', ['as' => 'dor' , 'uses' => 'productController@DorDaneshProducts']);

Route::get('pub', function () {
    return view('dordanesh.products');
});

Route::get('p1', function () {
    return view('dorDanesh.projectOne');
});
//Route::redirect('/', 'pick', 301);
Route::get('/', function () {
    return view('dorDanesh.projectOne');
});

//Route::get('/', function () {
//    return view('dorDanesh.projectOne');
//});

Route::get('/sgb', function () {
    $d = DB::Connection('mysql610')->select('select * from pr_pub_st limit 100');
    return view('sgb.index', ['result' => $d]);
});

//Route::get('/', function () {
//    return view('test.t2');
////    return view('welcome');
//});

Route::get('amm2', 'userController@export');
//Route::get('/table', function () {
//    $grid = \App\User::all();
//    return view('table', compact('grid'));
//});

//Route::get('users/create','userController@create');
//Route::get('users','userController@index');

//Route::get('users/up', 'userController@create1')->name('up');
Route::get('users/index2', 'userController@index2');
Route::get('users/index2/search', 'userController@search');
Route::resource('users', 'userController');
Route::resource('products', 'productController');
Route::resource('post', 'PostController');

//Route::get('amm3/partcode1','DocPartController@searchPartcode');
Route::get('amm3/searchBarcode', 'DocPartController@searchBarcode')->middleware('auth');
Route::get('amm3/searchPartcode', 'DocPartController@searchPartcode')->middleware('auth');;
Route::get('amm3/selectPartcode', 'DocPartController@selectPartcode')->middleware('auth');;
Route::get('amm3/searchName', 'DocPartController@searchName')->middleware('auth');;
Route::get('amm3/selectName', 'DocPartController@selectName')->middleware('auth');;
Route::get('amm3/ShowRemain', 'DocPartController@ShowRemain')->middleware('auth');;
Route::get('amm3/paginate', 'DocPartController@searchPartcode')->middleware('auth');;
Route::put('amm3/finalDocConfirm/{docid}', 'DocPartController@finalDocConfirm')->middleware('auth');;
Route::get('amm3/jostojoo', 'DocPartController@jostojooView')->middleware('auth');;
Route::get('amm3/jostojooPublisher', 'DocPartController@jostojooPublisher')->middleware('auth');;


Route::get('/amm3/create', function () {
    return view('sg.doc.stockLaking');
})->middleware('auth');
Route::post('amm3/update/{id}', 'DocPartController@update');
Route::resource('amm3', 'DocPartController')->middleware('auth');
//Route::post('amm3/paginate', 'DocPartController@searchPartcode');


//Route::get('/m', function () {
//    return view('sg.mStockLaking');
//})->middleware('auth.basic');

Route::get('hash', function () {
    $d = Hash::make('1948');
    return $d;
});


//Route::get('partcode', function () {
//    return view('SG.doc.searchPartcode');
//});


Route::get('/home', 'HomeController@index')->name('home');


Route::get('sgb/barcode', 'DocPartController@sgbId');//->name('sgbIdBarcode');
Route::get('sgb/name', 'DocPartController@sgbName');//->name('sgbIdBarcode');


Route::get('categoryList', function () {
    return Cache::remember('category-details', 1, function () {
//        return App\DocRemain::all();
//        return DB::connection('sqlsrv')->select("
//        select distinct top 10 xx.PartRef as partref from PosVwCardexhoshes xx where xx.status=2
//        ")->pluck('partref');
        return DB::connection('sqlsrv')->table('posvwcardexhoshes')->select('partref')->where('status', 2)->distinct()->limit(10)->get()->pluck('partref');
//        return implode(",",(array)$cardex);
    });
});

Route::get('placement', 'PlaceController@index')->middleware('auth');
Route::get('placement/list', 'PlaceController@listPlacement')->middleware('auth');
Route::get('placement/listShow', 'PlaceController@listShowPlacement')->middleware('auth');
Route::get('placement/{stockid}/searchPartcode', 'PlaceController@searchPartcode')->middleware('auth');
Route::get('placement/{stockid}/searchPartname', 'PlaceController@searchPartname')->middleware('auth');
Route::get('placement/selectPartcode', 'PlaceController@selectPartcode')->middleware('auth');
Route::get('placement/UpdateShelf', 'PlaceController@UpdateShelf')->middleware('auth');
Route::get('placement/UpdateShelfFromDraft', 'PlaceController@UpdateShelfFromDraft')->middleware('auth');
Route::get('placement/{stockid}', 'PlaceController@show')->middleware('auth');

Route::get('price', function () {
    return view('price.priceChange');
})->middleware('auth');
Route::get('price/priceChange/', 'PlaceController@PriceChange')->middleware('auth');

Route::get('barcode', 'BarcodeController@index')->middleware('auth');
Route::get('barcode/searchPartcode', 'BarcodeController@searchPartcode')->middleware('auth');
Route::get('barcode/selectPartcode', 'BarcodeController@selectPartcode')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/zino/xml/{groupId}', 'HomeController@xmlConvert')->name('zinoXml');
Route::get('/zino', 'HomeController@zinoMenu');
Route::get('ang', function () {
    return view('angular.first');

});