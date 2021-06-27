<?php

namespace App\Model;
use DOMDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    protected $fillable =[
      'articul',
      'category_id',
      'title',
      'slug',
      'price',
      'price_discount',
      'quantity',
      'in_stock',
      'image',
      'description',
      'instruction',
    ];
    public function category(){
        return $this->belongsTo('App\Model\Category', 'category_id');
    }

    public function galery(){
        return $this->hasMany('App\Model\ProductGalery', 'product_id');
    }
    public function recomend(){
        return $this->hasMany('App\Model\RecomendWithProduct', 'product_id');
    }
    public function getByID($id){
        return $this->where('id', $id)->get()->first();
    }

    public function getByCategory($id)
    {
        return $this->where('category_id', $id)->orderBy('created_at', 'asc')->get();
    }
    public function getByCategoryHome($id)
    {
        return $this->where('category_id', $id)->orderBy('created_at', 'asc')->take(12)->get();
    }
    public function getByCategoryAdm($id)
    {
        //return $this->where('category_id', $id)->orderBy('title', 'asc')->get();
        $prdcts = [];
        $prdcts['items'] = $this->where('category_id', $id)
            ->orderBy('title', 'asc')
            ->take(7)
            ->get();
        $prdcts['qnt'] = $this->where('category_id', $id)->count();

        return $prdcts;
    }
    public function loadMore($input)
    {
        $catID = (int)htmlspecialchars($input['cid']);

        $page = 0;
        if(isset($input['page'])){
            $page = (int)htmlspecialchars($input['page']);
        }

        $news= $this->orderBy('title', 'asc')
            ->where('category_id', $catID)
            ->skip(($page * 7))
            ->take(7)
            ->get();

        $data['items'] = $news;

        $data['qnt'] = count($data['items']);

        return $data;

    }







    public function create(Request $request)
    {

        $in = $request->all();
        $c = new Product();
        $c->category_id = trim(htmlspecialchars($in['id']));
        $c->title = trim(htmlspecialchars($in['title']));
        $c->slug = trim(htmlspecialchars($in['slug'])) . '-' . uniqid() ;
        $c->articul = trim(htmlspecialchars($in['articul']));
        $c->is_sale = trim(htmlspecialchars($in['is_sale']));
        $c->is_new = trim(htmlspecialchars($in['is_new']));
        $c->is_hot = trim(htmlspecialchars($in['is_hot']));
        if(!empty(trim(htmlspecialchars($in['price'])))){
            $c->price = trim(htmlspecialchars($in['price']));
        }
        if(!empty(trim(htmlspecialchars($in['price_discount'])))) {
            $c->price_discount = trim(htmlspecialchars($in['price_discount']));
        }
        if(!empty(trim(htmlspecialchars($in['quantity'])))) {
            $c->quantity = trim(htmlspecialchars($in['quantity']));
        }
        if($c->quantity == 0){
            $c->in_stock =false;
        }
        $c->save();
        $path = public_path('uploads/products/' . $c->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('phote')) {
            $image = $request->file('phote');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . '/'. 'thumb_' . $imageName);
            $c->image = $imageName;
            $c->save();
        }
        $detail = $request->input('descr');
        $dom = new DomDocument();
        $dom->loadHtml(mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){

            $data = $img->getAttribute('src');
            if( mb_substr($data, 0, 4) != 'http') {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $pathf = $path . '/' . $image_name;
                file_put_contents($pathf, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', '/public/uploads/products/' . $c->id . '/' . $image_name);
            }
        }
        $detail = $dom->saveHTML();
        $c->description = $detail;
        $c->save();

        $detail1 = $request->input('instruction');
        $dom = new DomDocument();
        $dom->loadHtml(mb_convert_encoding($detail1, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            if( mb_substr($data, 0, 4) != 'http') {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $pathf = $path . '/' . $image_name;
                file_put_contents($pathf, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', '/public/uploads/products/' . $c->id . '/' . $image_name);
            }
        }
        $detail1 = $dom->saveHTML();
        $c->instruction = $detail1;
        $c->save();

        if(!empty($request->input('imageProduct'))) {
            $arrStr = $request->input('imageProduct');
            $arr = explode(',', $arrStr);
            if (count($arr) > 0) {
                foreach ($arr as $i) {
                    if (File::exists(public_path('temp/' . $i))) {
                        File::move(public_path('temp/' . $i), $path . '/' . $i);
                        File::delete(public_path('temp/' . $i));
                        $pg = new ProductGalery();
                        $pg->product_id = $c->id;
                        $pg->image = $i;
                        $pg->save();
                    }
                }
            }
        }
        $pRec = trim(htmlspecialchars($in['recomendProducts']));
        $pRecArr = explode(',', $pRec);
        foreach ($pRecArr as $p){
            $pro_rec = new RecomendWithProduct();
            $pro_rec->product_id = $c->id;
            $pro_rec->recomend_p_id = $p;
            $pro_rec->save();
        }


        return $c;

    }

    public function remove($id)
    {
        $p = $this->getByID($id);
        if(File::isDirectory(public_path('uploads/products/')  . $p->id)){
            File::deleteDirectory(public_path('uploads/products/' ) . $p->id);
        }
        $p->galery()->delete();
        return $p->delete();
    }




    public function updateProduct(Request $request)
    {

        $in = $request->all();
        $id = trim(htmlspecialchars($in['id']));
        $c = $this->getByID($id);
        $c->title = trim(htmlspecialchars($in['title']));
        $c->slug = trim(htmlspecialchars($in['slug'])) . '-' . uniqid() ;
        $c->articul = trim(htmlspecialchars($in['articul']));
        $c->is_sale = trim(htmlspecialchars($in['is_sale']));
        $c->is_new = trim(htmlspecialchars($in['is_new']));
        $c->is_hot = trim(htmlspecialchars($in['is_hot']));
        if(!empty(trim(htmlspecialchars($in['price'])))){
            $c->price = trim(htmlspecialchars($in['price']));
        }
        if(!empty(trim(htmlspecialchars($in['price_discount'])))) {
            $c->price_discount = trim(htmlspecialchars($in['price_discount']));
        }
        if(!empty(trim(htmlspecialchars($in['quantity'])))) {
            $c->quantity = trim(htmlspecialchars($in['quantity']));
        }
        if($c->quantity == 0){
            $c->in_stock =false;
        }
        $c->save();
        $path = public_path('uploads/products/' . $c->id);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if ($file = $request->file('phote')) {
            if(File::isFile($path . '/'. $c->image)){ File::delete($path . '/' . $c->image);}
            if(File::isFile($path . '/thumb_'. $c->image)){ File::delete($path . '/thumb_' . $c->image);}
            $image = $request->file('phote');
            $extension = $file->getClientOriginalExtension();
            $imageName = time() . '_' . uniqid() . '.' . $extension;
            $img = Image::make($image);
            $img->save($path . '/' . $imageName);
            $img->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . '/thumb_' . $imageName);
            $c->image = $imageName;
            $c->save();
        }
        $detail = $request->input('descr');
        $dom = new DomDocument();
        $dom->loadHtml(mb_convert_encoding($detail, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){

            $data = $img->getAttribute('src');
            if( mb_substr($data, 0, 4) != 'http' || mb_substr($data, 0, 7) != '/public') {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $pathf = $path . '/' . $image_name;
                file_put_contents($pathf, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', '/public/uploads/products/' . $c->id . '/' . $image_name);
            }
        }
        $detail = $dom->saveHTML();
        $c->description = $detail;
        $c->save();

        $detail1 = $request->input('instruction');
        $dom = new DomDocument();
        $dom->loadHtml(mb_convert_encoding($detail1, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            if( mb_substr($data, 0, 4) != 'http'|| mb_substr($data, 0, 7) != '/public') {
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $pathf = $path . '/' . $image_name;
                file_put_contents($pathf, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', '/public/uploads/products/' . $c->id . '/' . $image_name);
            }
        }
        $detail1 = $dom->saveHTML();
        $c->instruction = $detail1;
        $c->save();

        if(!empty($request->input('imageProduct'))) {
            $arrStr = $request->input('imageProduct');
            $arr = explode(',', $arrStr);
            if (count($arr) > 0) {
                foreach ($arr as $i) {
                    if (File::exists(public_path('temp/' . $i))) {
                        File::move(public_path('temp/' . $i), $path . '/' . $i);
                        File::delete(public_path('temp/' . $i));
                        $pg = new ProductGalery();
                        $pg->product_id = $c->id;
                        $pg->image = $i;
                        $pg->save();
                    }
                }
            }
        }


        return $c;

    }

    public function getList()
    {
       return $this->orderBy('created_at', 'desc')->paginate(20);
    }
    public function getListWithoutPaginate()
    {
       return $this->orderBy('id', 'desc')->get();
    }

    public function getCount()
    {
        return count($this->get());
    }

    public function getProductsByCategories($cats)
    {
        return $this->whereIn('category_id', $cats)->paginate(20);
    }

    public function getProductsByCategoriesCount($cats)
    {
        return count($this->whereIn('category_id', $cats)->get());
    }


    public function getListByIds($ids)
    {
        return $this->whereIn('id', $ids)->get();
    }



    public function getPopular(){
       $popularCategories = DB::select(DB::raw( "select id,  max(pr.maxx) as pp from
                                (
                                select category_id, max(viewed + sold) as maxx from tabletka_products where in_stock = true
                                group by category_id
                                ) pr
                                inner join (
                                select t1.id, t2.id as sub, t3.id  as subsub, t1.slug, t1.title from tabletka_categories t1
                                left join tabletka_categories t2 on t2.parent_id = t1.id and t2.is_active = 1
                                left join tabletka_categories t3 on t3.parent_id = t2.id and t3.is_active = 1
                                where t1.parent_id = 0 and t1.is_active = 1
                                ) ct on pr.category_id = ct.subsub
                                group by ct.id
                                order by pp desc
                                limit 4" ));

        $allPopularProducts = DB::select(DB::raw( " select id, articul, category_id, title, slug, price, price_discount, quantity, in_stock, is_sale, is_new, is_hot, image, description, instruction, created_at, ( viewed + sold) as pp from tabletka_products where in_stock = true
                                order by pp desc
                                limit  6"));

   $popularProductCategories = [];
        foreach($popularCategories as $item){
            $popularProductCategories[$item->id] = DB::select(DB::raw("select id, articul, category_id, title, slug, price, price_discount, quantity, in_stock, is_sale, is_new, is_hot, image, description, instruction, created_at, (viewed + sold) as pp from tabletka_products  pr

                                    where pr.category_id in  (
                                            select t3.id from tabletka_categories t3
                                            where t3.id = ".$item->id."
                                            union all
                                            select t3.id from tabletka_categories t2
                                            left join tabletka_categories t3 on t3.parent_id = t2.id
                                            where t2.id = ".$item->id."
                                            union all
                                            select t3.id from tabletka_categories t1
                                            left join tabletka_categories t2 on t2.parent_id = t1.id
                                            left join tabletka_categories t3 on t3.parent_id = t2.id
                                            where t1.parent_id = 0 and t1.id = ".$item->id."
                                    )
                                    and pr.in_stock = true and pr.price > 0
                                    order by pp desc limit 6"));
        }
        $result  = [
            'popularCategories' => $popularCategories,
            'allPopularProducts' => $allPopularProducts,
            'popularProductCategories' => $popularProductCategories,
        ];
        return $result;
    }

    public function getByNewest()
    {
        return $this->where(['is_new' => 1])->orderBy('created_at', 'desc')->take(8)->get();
    }

    public function getBySalest()
    {
        return $this->where(['is_sale' => 1])->orderBy('created_at', 'desc')->take(8)->get();
    }

    public function getBySold()
    {
        return $this->orderBy('sold', 'desc')->take(8)->get();
    }

    public function getByViewed()
    {
        return $this->orderBy('viewed', 'desc')->take(8)->get();
    }

    public function getProductsBySortForCatalog($sort, $from, $to)
    {
        switch ($sort){
            case "bestseller":
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('sold', 'desc')
                    ->paginate(16);
                break;
            case "sale" :
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('is_sale', 'desc')
                    ->paginate(16);
                break;
            case "new":
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('is_new', 'desc')
                    ->paginate(16);
                break;
            case "price-desc":
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'desc')
                    ->paginate(16);
                break;
            case "price-asc":
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'asc')
                    ->paginate(16);
                break;
            default:
                return $this->whereBetween('price', [$from, $to])
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
        }
    }

    public function getProductsBySortForCategory($ids,  $sort,  $from, $to)
    {
        switch ($sort){
            /* case "popularity":
                 $products  = Product::paginate(15);
                 break;*/
            case "bestseller":
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('sold', 'desc')
                    ->paginate(16);
                break;
            case "sale" :
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('is_sale', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
            case "new":
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('is_new', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
            case "price-desc":
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'desc')
                    ->paginate(16);
                break;
            case "price-asc":
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'asc')
                    ->paginate(16);
                break;
            default:
                return $this->whereIn('category_id', $ids)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
        }
    }


    public function getProductsBySortForProducts($id,  $sort,  $from, $to)
    {
        switch ($sort){
            /* case "popularity":
                 $products  = Product::paginate(15);
                 break;*/
            case "bestseller":
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('sold', 'desc')
                    ->paginate(16);
                break;
            case "sale" :
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('is_sale', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
            case "new":
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('is_new', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
            case "price-desc":
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'desc')
                    ->paginate(16);
                break;
            case "price-asc":
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('price', 'asc')
                    ->paginate(16);
                break;
            default:
                return $this->where('category_id', $id)
                    ->whereBetween('price', [$from, $to])
                    ->orderBy('created_at', 'desc')
                    ->paginate(16);
                break;
        }
    }


}
