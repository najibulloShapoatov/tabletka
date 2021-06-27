<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\RecomendWithProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CatalogController extends Controller
{

    public function changeSort($sort){

        Cookie::queue("sort", $sort, 3600*60);
        return response()->json(Cookie::get('sort'), 200);
    }




    public function changeFilterPrice(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        Cookie::queue("filter_from", $from, 3600*60);
        Cookie::queue("filter_to", $to, 3600*60);
        return response()->json( true, 200);
    }

    public function index(){

        $sort = (empty(Cookie::get('sort')))? 'default' : Cookie::get('sort');

        $from = (empty(Cookie::get('filter_from')))? '1' : Cookie::get('filter_from');
        $to = (empty(Cookie::get('filter_to')))? '5000' : Cookie::get('filter_to');

        $products = (new Product())->getProductsBySortForCatalog($sort, $from, $to);
        $pcount = (new Product())->getCount();
        $cats = (new Category())->getList();
        $hotest = Product::where('is_hot', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('frontend.product.catalog', compact([
            'products',
            'pcount',
            'cats',
            'hotest',
        ]));
    }
    public function category($id){

        $cat = (new Category())->getByID($id);
        $cats = (new Category())->getByCat($id);
        $ids = (new Category())->getCatlvl3IDS($cats);

        $sort = (empty(Cookie::get('sort')))? 'default' : Cookie::get('sort');
        $from = (empty(Cookie::get('filter_from')))? '1' : Cookie::get('filter_from');
        $to = (empty(Cookie::get('filter_to')))? '5000' : Cookie::get('filter_to');

        $products = (new Product())->getProductsBySortForCategory($ids, $sort, $from, $to);



        $hotest = Product::whereIn('category_id', $ids)->where('is_hot', 1)->orderBy('created_at', 'desc')->take(3)->get();
        $pcount = (new Product())->getProductsByCategoriesCount($ids);
        return view('frontend.product.category', compact([
            'cat',
            'cats',
            'products',
            'pcount',
            'hotest',
        ]));
    }
    public function podCategory($id){
        $cat = (new Category())->getByID($id);
        $cats = (new Category())->getByCat($id);
        $ids = [];
        foreach ($cats as $i){ $ids[] = $i->id;}
        //$products = Product::whereIn('category_id', $ids)->paginate(15);
        $sort = (empty(Cookie::get('sort')))? 'default' : Cookie::get('sort');
        $from = (empty(Cookie::get('filter_from')))? '1' : Cookie::get('filter_from');
        $to = (empty(Cookie::get('filter_to')))? '5000' : Cookie::get('filter_to');
        $products = (new Product())->getProductsBySortForCategory($ids, $sort, $from, $to);

        $hotest = Product::whereIn('category_id', $ids)->where('is_hot', 1)->orderBy('created_at', 'desc')->take(3)->get();
        $pcount = (new Product())->getProductsByCategoriesCount($ids);
        return view('frontend.product.pod-category', compact([
            'cat',
            'cats',
            'products',
            'pcount',
            'hotest',
        ]));
    }
    public function products($id){

        $cat = (new Category())->getByID(((new Category())->getByID($id)->parent_id));
        $cats = (new Category())->getByCat($cat->id);
        $products = Product::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(15);

        $sort = (empty(Cookie::get('sort')))? 'default' : Cookie::get('sort');
        $from = (empty(Cookie::get('filter_from')))? '1' : Cookie::get('filter_from');
        $to = (empty(Cookie::get('filter_to')))? '5000' : Cookie::get('filter_to');
        $products = (new Product())->getProductsBySortForProducts($id, $sort, $from, $to);

        $hotest = Product::where(['category_id' => $id, 'is_hot' => 1])->orderBy('created_at', 'desc')->take(3)->get();
        $pcount = count(Product::where('category_id', $id)->get());
        return view('frontend.product.pod-category', compact([
            'cat',
            'cats',
            'products',
            'pcount',
            'hotest',
        ]));
    }
    public function product($id){
        $product = (new Product())->getByID($id);
        $product->viewed = $product->viewed++;
        $product->save();

        $productRecomend = (new RecomendWithProduct())->getRecomends($id);

        return view('frontend.product.single', compact([
            'product',
            'productRecomend',
        ]));
    }
}
