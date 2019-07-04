<?php

namespace App\Http\Controllers;

use App\Grids\ProductsGridInterface;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function index(ProductsGridInterface $productsGrid, Request $request)
    {
        // the 'query' argument needs to be an instance of the eloquent query builder
        // you can load relationships at this point
        return $productsGrid
            ->create(['query' => Products::query(), 'request' => $request])
            ->renderOn('product.index'); // render the grid on the welcome view
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function DorDaneshProducts($publisher, $cat)
    {
//        dd($p);
        $res = DB::connection('mysql611')->select("select distinct p.id,p.`name`,p.barcode,p.image
-- ,(select cat4.name from categories cat4 where cat4.id=catp.level4 limit 1) as 'catLevel4'
,(select cat3.`name` from categories cat3 where cat3.id=" . $cat . " limit 1) as 'parentcat'
,(select pp.`name` from `fields` ff join persons pp on ff.`value`=pp.id where ff.fieldable_id=p.id and ff.attribute_id=6 limit 1) as 'author'
,(select pp.`name` from `fields` ff join persons pp on ff.`value`=pp.id where ff.fieldable_id=p.id and ff.attribute_id=7 limit 1) as 'translater',
(select pu.`name` from `fields` ff join publishers pu on ff.`value`=pu.id where ff.fieldable_id=p.id and ff.attribute_id=8 limit 1)as 'publisher',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=10 limit 1)as 'pubdate',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=11 limit 1)as 'pageno',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=13 limit 1)as 'jeld'
from products p 
join category_product catp on catp.product_id=p.id
join categories cat on cat.id=catp.category_id
 
where cat.parent_id=" . $cat . " and
p.id in (select p2.id from products p2 join `fields` f2 on f2.fieldable_id=p2.id
where f2.attribute_id=8 and f2.`value`=" . $publisher . ")
        ");

//        $res = DB::connection('mysql')->table('products p')
//            ->select('p.id', 'p.barcode', 'p.name', 'p.publisher')
//            ->where('p.publisher', 'like', '%در دانش بهمن%')
//            ->paginate(10);

        return view('dorDanesh.products', ['result' => $res]);
    }

    public function DorDaneshProductsLevel($publisher, $cat,$level)
    {
//        dd($p);
        $res = DB::connection('mysql611')->select("select distinct p.id,p.`name`,p.barcode,aps.`description`,p.image
-- ,(select cat4.name from categories cat4 where cat4.id=catp.level4 limit 1) as 'catLevel4'
,(select cat3.`name` from categories cat3 where cat3.id=" . $cat . " limit 1) as 'parentcat'
,(select pp.`name` from `fields` ff join persons pp on ff.`value`=pp.id where ff.fieldable_id=p.id and ff.attribute_id=6 limit 1) as 'author'
,(select pp.`name` from `fields` ff join persons pp on ff.`value`=pp.id where ff.fieldable_id=p.id and ff.attribute_id=7 limit 1) as 'translater',
(select pu.`name` from `fields` ff join publishers pu on ff.`value`=pu.id where ff.fieldable_id=p.id and ff.attribute_id=8 limit 1)as 'publisher',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=10 limit 1)as 'pubdate',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=11 limit 1)as 'pageno',
(select ff.`value` from `fields` ff where ff.fieldable_id=p.id and ff.attribute_id=13 limit 1)as 'jeld'
from products p 
join category_product catp on catp.product_id=p.id
join categories cat on cat.id=catp.category_id
left join AMproduct_spec aps on aps.barcode=p.barcode
where catp.".$level."=" . $cat . " and -- only this is changed
p.id in (select p2.id from products p2 join `fields` f2 on f2.fieldable_id=p2.id
where f2.attribute_id=8 and f2.`value`=" . $publisher . ")
        ");

        return view('dorDanesh.products', ['result' => $res]);
    }

}
