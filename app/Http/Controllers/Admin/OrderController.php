<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index(){
        $orders = (new Order())->getListPaginate();
        return view('admin.order.index', compact(['orders']));
    }
    public function detail($id){
        $order = (new Order())->getByID($id);
        return view('admin.order.details', compact([
            'order'
        ]));
    }
    public function changeSts(Request $request){
        $in = $request->all();
        $id = trim(htmlspecialchars($in['id']));
        $sts = trim(htmlspecialchars($in['sts']));
        $rs = (new Order())->changeStatus($id, $sts);
        return Response::json($rs, 200);
    }
}
