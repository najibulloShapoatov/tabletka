<?php

namespace App\Model;

use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Category extends Model
{
    //

    public function getList()
    {
        return $this->orderBy('sort_order', 'asc')->get();
    }

    public function createCat(Request $request)
    {
        $in = $request->all();
        $c = new Category();
        $c->parent_id = trim(htmlspecialchars($in['id']));
        $c->title = trim(htmlspecialchars($in['title']));
        $c->slug = trim(htmlspecialchars($in['slug'])) . '-' . uniqid() ;
        $c->sort_order = trim(htmlspecialchars($in['sort']));
        $c->save();
        $path = public_path('uploads/categories/' . $c->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('img')) {
            $image = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $c->image = $imageName;
            $c->save();
        }
        $detail = $request->input('descr');

        $dom = new DomDocument();

        $dom->loadHtml(mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){

            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name=  time().$k.'.png';

            $path = $path . '/' . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');

            $img->setAttribute('src',  '/public/uploads/categories/'.$c->id . '/' .$image_name);

        }

        $detail = $dom->saveHTML();
        $c->description = $detail;
        $c->save();
        return $c;

    }

    public function getLatestSortOrder($parent_id)
    {
        return $this->where('parent_id', $parent_id)->orderBy('id', 'DESC')->first()->sort_order;
    }
    public function getByID($id){
        return $this->where('id', $id)->get()->first();
    }
    public function getPodCategory($id){
        return $this->where('parent_id', $id)->orderBy('sort_order', 'asc')->get();
    }

    public function remove($id)
    {
        $c = $this->getByID($id);
        $this->removePodCategories($c->id);
        $path = public_path('uploads/categories/' . $c->id);
        if(File::isDirectory($path)){ File::deleteDirectory($path);}
        return $c->delete();
    }


    public function removePodCategories($id){
        $cats = $this->getPodCategory($id);
        foreach ($cats as $c){
            $path = public_path('uploads/categories/' . $c->id);
            if(File::isDirectory($path)){ File::deleteDirectory($path);}
            $c->delete();
        }
    }

    public function updateCat(Request $request)
    {
        $in = $request->all();
        $id= trim(htmlspecialchars($in['id']));
        $c = $this->getByID($id);
        $c->title = trim(htmlspecialchars($in['title']));
        $c->slug = trim(htmlspecialchars($in['slug'])) . '-' . uniqid() ;
        $c->sort_order = trim(htmlspecialchars($in['sort']));
        $c->save();
        $path = public_path('uploads/categories/' . $c->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('img')) {
            if(File::isFile($path . '/' . $c->image)){ File::delete($path . '/' . $c->image);}
            $image = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $c->image = $imageName;
            $c->save();
        }
        $detail = $request->input('descr');

        $dom = new DomDocument();
        $dom->loadHtml( mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){

            $data = $img->getAttribute('src');
            if(mb_substr($data, 0, 7) != '/public') {
                list($type, $data) = explode(';', $data);

                list(, $data) = explode(',', $data);

                $data = base64_decode($data);

                $image_name = time() . $k . '.png';

                $path = $path . '/' . $image_name;

                file_put_contents($path, $data);

                $img->removeAttribute('src');

                $img->setAttribute('src', '/public/uploads/categories/' . $c->id . '/' . $image_name);
            }

        }

        $detail = $dom->saveHTML();
        $c->description = $detail;
        $c->save();
        return $c;

    }

    public function getByCat($id)
    {
        return $this->where(['parent_id' => $id])->get();
    }

    public function getCatlvl3IDS($cats)
    {
        $ids = [];
        foreach ($cats as $cat){
            $catlvl2s = $this->getByCat($cat->id);
            foreach ($catlvl2s as $c){
                $ids[]=$c->id;
            }
        }
        return $ids;
    }

    public function getCatsToHomeCatsSelect(){
        return $this->where(['parent_id' => 0])->get();
    }

    public static function getCatlvl3ByIDlvl1($id){
        $ids=[];
        $catlvl2 = (new Category())->where(['parent_id' =>$id])->get();
        foreach ($catlvl2 as $cat2){
            $ids[]=$cat2->id;
        }
        $cats = (new Category())->whereIn('parent_id', $ids)->get();
        return $cats;
    }

    public function getlistForHome()
    {
        return $this->where('is_home', 1)->orderBy('sort_order', 'asc')->take(8)->get();
    }
}
