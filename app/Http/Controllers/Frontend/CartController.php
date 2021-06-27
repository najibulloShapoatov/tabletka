<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Order;
use App\Model\Product;
use App\Model\SiteProperty;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use mysql_xdevapi\Exception;
use Throwable;

class CartController extends Controller
{



    // view cart
    public function viewCart()
    {
        $cart = new Cart();

        if(Auth::user()){
            $data = $cart->getCart(Auth::user()->id);
        }
        else{
            $data = $cart->getCookieCart();
        }
        $city_cost = (new SiteProperty())->getProp('COST_IN_THE_CITY');
        $no_city_cost = (new SiteProperty())->getProp('COST_OUT_OF_TOWN');

        return view('frontend.cart.index', compact([
            'data',
            'city_cost',
            'no_city_cost',
        ]));
    }

    // add to cart
    public function addToCart(Request $request)
    {
        if( $request->ajax() ) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));
            $qnt = 1;
            if (!empty($input['qnt'])) {
                $qnt = $input['qnt'];
            }

            // product info
            $product = new Product();
            $productData = $product->getByID($id);

            if(Auth::user()){
                //----- add to cart table (db) -----
                $price = ($productData->is_sale==1)? $productData->price_discount : $productData->price;

                // add to cart db
                $cart = new Cart();
                $addToCart = $cart->addToCart(Auth::user()->id, $productData->id, $price, $qnt);  // set price with sale (%) ...

                if($addToCart){
                    return response()->json([
                        'id' => $productData->id
                    ], 200);
                }

            }
            else{
                //----- add to cookies -----

                $cart = Cookie::get('cart');
                $cartCount = Cookie::get('count');
                $cartPrice = Cookie::get('price');

                if(is_array($cartCount)){
                    if(array_key_exists($id, $cartCount)){
                        $cartQnt = $cartCount[$id] + $qnt;
                    }
                    else {
                        $cartQnt = $qnt;
                    }
                }
                else{
                    $cartQnt = $qnt;
                }

                return response()->json([
                    'id' => $productData->id
                ], 200)
                    ->withCookie(cookie("cart[".$id."]", $id))
                    ->withCookie(cookie("count[".$id."]", $cartQnt))
                    ->withCookie(cookie("price[".$id."]", $productData->price));
            }

        }
    }

    // get cart items
    public function getCartItems(Request $request){
        if( $request->ajax() ) {

            $cart = new Cart();
            $basket = [];
            if(Auth::user())
            {
                // get cart info
                $basket = $cart->getCart(Auth::user()->id);
            }
            else{
                // get cart from cookie
                $basket = $cart->getCookieCart();
            }

            try {
                $html = View::make('frontend.cart._items', compact('basket'))->render();
            } catch (Throwable $e) {
                $html='';
            }



            return response()->json([
                'basket' => $basket,
                'html' => $html,
            ], 200);

        }
    }

    // remove product from cart
    public function removeFromCart($id)
    {
            $result = (new Cart())->removeFromCart($id);
            return response()->json($result, 200);

    }




    // change qnt cart
    public function changeQuantityCart(Request $request)
    {
        if($request->ajax()) {
            $input = $request->all();

            $productID = htmlspecialchars(trim($input['id']));
            $qnt = (int)htmlspecialchars(trim($input['qnt']));

            $cart = new Cart();
            $data = $cart->changeQntCart($productID, $qnt);

            return response()->json($data, 200);

        }
    }

    // remove item from cart page
    public function removeFromCartPage(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            $id = trim(htmlspecialchars($input['id']));

            $cart = new Cart();
            $result = $cart->removeFromCart($id);

            return response()->json($result, 200);
        }
    }

    // get cart total price
    public function getCartTotalPrice(Request $request)
    {
        if ($request->ajax()) {
            $cart = new Cart();
            if(Auth::user())
            {
                // get cart info
                $basket = $cart->getCart(Auth::user()->id);
            }
            else{
                // get cart from cookie
                $basket = $cart->getCookieCart();
            }

            return response()->json($basket, 200);
        }
    }

    // checkout
    public function checkout()
    {
        $cart = new Cart();

        $user = Auth::user();
        $userInfo = [];
        $createAccount = true;
        $phoneNo = false;

        if(Auth::check())
        {
            // get cart info
            $basket = $cart->getCart($user->id);

            $userInfo = [
                'name' => $user->name,
                'surname' => $user->surname,
                'phone' => $user->phone,
                'phone_readonly' => 'readonly',
                'email' => $user->email,
                'city' => $user->city,
                'address' => $user->address,
                'create_account' => true
            ];

            $createAccount = false;
            $phoneNo = true;

        }
        else{
            // get cart from cookie
            $basket = $cart->getCookieCart();
        }
        $city_cost = (new SiteProperty())->getProp('COST_IN_THE_CITY');
        $no_city_cost = (new SiteProperty())->getProp('COST_OUT_OF_TOWN');

        return view('frontend.cart.checkout', compact([
            'basket',
            'userInfo',
            'createAccount',
            'phoneNo',
            'city_cost',
            'no_city_cost',
        ]));
    }

    // checkout order
    public function checkoutOrder(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();

            // validate
            $user = new User();
            $result = $user->validateCheckoutFields($input);

            // if it is not ok, then msg error
            if( $result['error_code'] != 0 ){
                return response()->json(['input' => $result], 200);
            }

            $cart = new Cart();
            $data = $cart->makeOrder($input);

            $order = (new Order())->getByID($data['id']);

            $html = View::make('frontend.cart._order-recived', compact(['order']))->render();

            return response()->json([
                'input' => $data,
                'html' => $html,
            ], 200);
        }
    }

    // add to wishlist
    public function addToWishlist($id)
    {
            // product info
            $productData = (new Product())->getByID($id);

            // add to cookie
            return response()->json([
                'id' => $productData->id
            ], 200)
                ->withCookie(cookie("wishlist[".$id."]", $id));

    }

    // count of wishlist
    public function qntWishlist()
    {
            $cart = new Cart();
            $wishlistQnt = $cart->getWishlistQnt();

            return Response::json($wishlistQnt, 200);
    }

    // wishlist
    public function wishlist()
    {
        $cart = new Cart();
        $data = $cart->getWishlist();
        $html = View::make('frontend._wishlists', compact('data'))->render();
        return response()->json($html, 200);
    }

    // remove from wishlist
    public function removeFromWishlist($id)
    {
            $result = ( new Cart())->removeFromWishlist($id);

            return response()->json($result, 200);
    }


}
