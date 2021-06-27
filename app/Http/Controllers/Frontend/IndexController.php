<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\SiteProperty;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(){
        $cats = [];
        $products = [];
        $popular = (new Product())->getPopular();
        //print_r($popular);

        $pday = [];
        $pday['new'] = (new Product())->getByNewest();
        $pday['sale'] = (new Product())->getBySalest();
        $pday['sold'] = (new Product())->getBySold();
        $pday['viewed'] = (new Product())->getByViewed();

        $catHome = [];
        $catOneID = (new SiteProperty())->getProp('CATEGORY_ONE_TO_HOME');
        $catTwoID = (new SiteProperty())->getProp('CATEGORY_TWO_TO_HOME');
        $catHome['one']['items'] = (new Product())->getByCategoryHome($catOneID);
        $catHome['one']['cat'] = (new Category())->getByID($catOneID);
        $catHome['two']['items'] = (new Product())->getByCategoryHome($catTwoID);
        $catHome['two']['cat'] = (new Category())->getByID($catTwoID);

        $homeCategories = (new Category())->getlistForHome();

        return view('frontend.index', compact([
            'cats',
            'products',
            'pday',
            'catHome',
            'popular',
            'homeCategories',
        ]));
    }
}
