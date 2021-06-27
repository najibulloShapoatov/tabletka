<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\ProductGalery;
use App\Model\RecomendWithProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index($id){
        $cat = (new Category())->getByID($id);
        $prds = (new Product())->getByCategoryAdm($id);
        $products = (new Product())->getListWithoutPaginate();
        $html = View::make('admin.product._index', compact(['cat', 'prds', 'products']))->render();
        return Response::json($html, 200);
    }
    //load more news
    public function loadMore(Request $request)
    {
        if ($request->ajax())
        {
            $input = $request->all();
            $news = new Product();
            $data = $news->loadMore($input);
            $html = View::make('admin.product._load', compact('data'))->render();
            return Response::json(['html' => $html, 'info' => $data], 200);
        }
    }



    public function addProductRecomend($id){
        $prod = (new Product())->getByID($id);
        $html = View::make('admin.product._rec_prod', compact([
            'prod',
        ]))->render();
        return response()->json($html, 200);
    }
    public function addProductRecomendDB($rID, $pID){
        $prod = (new Product())->getByID($rID);
        (new RecomendWithProduct())->createRecomend($rID, $pID);
        $html = View::make('admin.product._rec_prod_edit', compact([
            'prod',
        ]))->render();
        return response()->json($html, 200);
    }

    public function removeProductRecomendDB($rID, $pID){
        $rs = (new RecomendWithProduct())->deleteRecomend($rID, $pID);
        return response()->json($rs, 200);
    }



    public function imageToTemp(Request $request){
        $path = public_path('temp/');
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('file')) {
            $image = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path  . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        return Response::json($imageName, 200);
    }


    public function create(Request $request){
        $v =  $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'articul' => 'required',
        ]);

        if($v){
            $d = (new Product())->create($request);
            $data = (new Product())->getByID($d->id);
            $html = View::make('admin.product._create', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
    }

    public function edit($id){
        $data = (new Product())->getByID($id);
        $products = (new Product())->getListWithoutPaginate();
        $html = View::make('admin.product._edit', compact(['data', 'products']))->render();
        return Response::json($html, 200);
    }


    public function updateProd(Request $request){
        $v =  $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'articul' => 'required',
        ]);

        if($v){
            $d = (new Product())->updateProduct($request);
            $data = (new Product())->getByID($d->id);
            $html = View::make('admin.product._update', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
    }


    public function remove($id){
        $res = (new Product())->remove($id);
        return Response::json($res, 200);
    }

    public function deleteGaleryItem($id){
        $rs = (new ProductGalery())->deleteItem($id);
        return Response::json($rs, 200);
    }
}
