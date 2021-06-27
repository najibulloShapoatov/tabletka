<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

    public function index(){
        $cats = (new Category())->getList();
        $html = View::make('admin.category._cats', compact(['cats']))->render();
        return Response::json(['cats'=>$cats, 'html'=>$html], 200);
    }
    public function create(Request $request){
        $v =  $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'sort' => 'required',
        ]);

        if($v){
            $data = (new Category())->createCat($request);
            $html = View::make('admin.category._cat', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
        elseif (!$v){
        return Response::json([
            'err'=>1,
            'msg'=>'Заполните все обязательные поля !!!'
        ], 200);
        }
    }

    public function updateCat(Request $request){
        $v =  $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'sort' => 'required',
        ]);

        if($v){
            $data = (new Category())->updateCat($request);
            $html = View::make('admin.category._cat-one', compact(['data']))->render();
            return Response::json([
                'err'=>0,
                'res'=>$html
            ], 200);
        }
        elseif (!$v){
        return Response::json([
            'err'=>1,
            'msg'=>'Заполните все обязательные поля !!!'
        ], 200);
        }
    }

    public function getLatestElement($id){
        $l = (new Category())->getLatestSortOrder($id);
        return Response::json($l+1, 200);
    }

    public function remove($id){
        $res = (new Category())->remove($id);
        return Response::json($res, 200);
    }
    public function edit($id){
        $data = (new Category())->getByID($id);
        $html = View::make('admin.category._edit', compact(['data']))->render();
        return Response::json($html, 200);
    }
    public function podCategory($id){
        $cat = (new Category())->getByID($id);
        $cats = (new Category())->getPodCategory($id);
        $html = View::make('admin.category._pod-cats', compact(['cat', 'cats']))->render();
        return Response::json($html, 200);
    }

    public function podPodCategory($id){
        $cat = (new Category())->getByID($id);
        $cats = (new Category())->getPodCategory($id);
        $html = View::make('admin.category._pod-pod-cats', compact(['cat', 'cats']))->render();
        return Response::json($html, 200);
    }


}
