<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\SiteProperty;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(){
        $cityCost = (new SiteProperty())->getProp('COST_IN_THE_CITY');
        $nocityCost = (new SiteProperty())->getProp('COST_OUT_OF_TOWN');
        return view('admin.delivery.index', compact([
            'cityCost',
            'nocityCost',
        ]));
    }
    public function save(Request $request){
        $in = $request->all();
        $city = trim(htmlspecialchars($in['city']));
        $nocity = trim(htmlspecialchars($in['nocity']));
        (new SiteProperty())->setProp('COST_IN_THE_CITY', $city);
        (new SiteProperty())->setProp('COST_OUT_OF_TOWN', $nocity);
        return response()->json(true, 200);
    }
}
