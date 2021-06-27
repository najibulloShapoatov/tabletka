<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{

    protected $fillable = [
        'date_add',
        'date_end',
        'title',
        'link',
        'description',
        'image',
        'image_mobile',
        'is_active'
    ];

    public function getActiveSlides()
    {
        return $this->where('is_active', 1)->orderBy('date_add', 'desc')->get();
    }

    public function getOne($id)
    {
        return $this->where(['id' => $id, 'is_active' => 1])->get()->first();
    }

    public function getByID($id){
        return $this->where('id', $id)->get()->first();
    }

    public function changeActive($id)
    {
        $sl = $this->getByID($id);
        $sl->is_active = ($sl->is_active == 1)? 0 : 1;
        $sl->save();
        return $sl->is_active;
    }

}
