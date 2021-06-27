<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RecomendWithProduct extends Model
{
    public function product(){
        return $this->belongsTo('App\Model\Product', 'recomend_p_id');
    }
    //
    public function createRecomend($rID, $pID)
    {
        $r = new RecomendWithProduct();
        $r->product_id = $pID;
        $r->recomend_p_id = $rID;
        $r->save();
    }

    public function deleteRecomend($rID, $pID)
    {
        $r = $this->where(['product_id'=>$pID, 'recomend_p_id'=>$rID])->get()->first();
        return $r->delete();
    }

    public function getRecomends($id)
    {
        return $this->where('product_id', $id)->orderBy('created_at', 'desc')->get();
    }
}
