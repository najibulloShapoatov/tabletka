<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\SiteProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SiteController extends Controller
{
    public function index(){
        $props = (new SiteProperty())->getList();
        return view('admin.site-property.index', compact(['props']));
    }
    public function update(Request $request){
        $v =  $request->validate([
            'site_name' => 'required',
            'telegram_link' => 'required',
            'youtube_link' => 'required',
            'instagram_link' => 'required',
            'fb_link' => 'required',
            'email' => 'required|email',
            'phone_two' => 'required',
            'phone_one' => 'required',
            'address' => 'required',
        ]);

        if($v){
            $rs = (new SiteProperty())->updateProps($request);
            return Response::json($rs, 200);
        }
    }
    public function homeCats(){
        $cats = (new Category())->getCatsToHomeCatsSelect();
        $catOneID = (new SiteProperty())->getProp('CATEGORY_ONE_TO_HOME');
        $catTwoID = (new SiteProperty())->getProp('CATEGORY_TWO_TO_HOME');
        return view('admin.home-cats.index', compact([
            'catOneID',
            'catTwoID',
            'cats'
        ]));
    }
    public function homeCatsUpdate(Request $request){

        $in = $request->all();
        $one = trim(htmlspecialchars($in['one']));
        $two = trim(htmlspecialchars($in['two']));
        (new SiteProperty())->setProp('CATEGORY_ONE_TO_HOME',$one);
        (new SiteProperty())->setProp('CATEGORY_TWO_TO_HOME', $two);
        return Response::json(true, 200);
    }
}
