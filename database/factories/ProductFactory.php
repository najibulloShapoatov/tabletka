<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $arr = array(31,32,33,34,35,36,42,43,44,41,45,46,47,50,51,53,52,55,57,60,61,62);
    $k=array_rand($arr, 1);
    $cat = $arr[$k];

    $title =$faker->realText(rand(15, 150));
    $slug = mb_strtolower(str_replace([',','.','?','—','!', '@',':',';','"','\'', '«', '»'],'', $title));
    $price = $faker->randomFloat(2, $min = 10, 1000.00);
    $price_discount = $price-($price * 0.25);
    $cr=$faker->dateTimeBetween('-50 days', '-4 days');
    return [
        'articul'=> $faker->ean8,
        'category_id'=>$cat,
        'title'=> $title,
        'slug'=> str_replace(' ', '-', $slug) . '-' .uniqid(),
        'price'=>$price,
        'price_discount' => $price_discount,
        'quantity'=> $faker->randomFloat(2, $min = 10, 2900),
        'viewed' => rand(0, 512),
        'sold' => rand(0, 256),
        'in_stock'=> true,
        'is_sale' => rand(0, 1),
        'is_new' => rand(0, 1),
        'is_hot' => rand(0, 1),
        'description'=>$faker->realText(rand(1000, 7000)),
        'instruction'=>$faker->realText(rand(1000, 7000)),
        'created_at'=>$cr,
        'updated_at'=>$cr,

    ];
});


/*
function myArrayRandom($array, $amount = 1) {
    $keys = array_rand($array, $amount);
    if ($amount == 1) { return $array[$keys]; }
    $results = [];
    foreach ($keys as $key) {
        $results[] = $array[$key]; }
    return $results;
}*/
