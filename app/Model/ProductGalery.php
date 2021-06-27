<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ProductGalery extends Model
{
    public function getByID($id){
        return $this->where('id', $id)->get()->first();
    }

    public function deleteItem($id)
    {
        $pg = $this->getByID($id);
        if(File::isFile(public_path('uploads/products/') . $pg->product_id . '/' . $pg->image)){
            File::delete(public_path('uploads/products/') . $pg->product_id . '/' . $pg->image);
        }
        return $pg->delete();
    }
}
