<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items(){
        return $this->hasMany('App\Model\OrderItem', 'order_id');
    }
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    //
    public function getList()
    {
        return $this->orderBy('order_status', 'asc')->get();
    } //
    public function getListPaginate()
    {
        return $this->orderBy('order_status', 'asc')->paginate(15);
    }

    public function getByID($id)
    {
        return $this->where('id', $id)->get()->first();
    }

    public function getlistByUser($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function changeStatus(string $id, string $sts)
    {
        $o = $this->getByID($id);
        $o->order_status = $sts;
        $o->save();
        return $o->order_status;
    }
}
