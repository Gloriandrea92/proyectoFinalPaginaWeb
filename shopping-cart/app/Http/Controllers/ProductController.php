<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Order;

use Session;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
   public function getIndex(){
    $x=new Product();

    $products= Product::all();

       return view('shop.index', ['products'=>$products]);

  }
  public function getAddToCart(Request $request, $id){
    $product=Product::find($id);
    $oldCart= $request->session()->has('cart')? session()->get('cart'):null;
    $cart=new Cart($oldCart);
    $cart->add($product,$product->id);

    $request->session()->put('cart', $cart);
    //dd($request->session()->get('cart'));
    return redirect()->route('product.index');
  }

  public function getReduceByOne(Request $request,$id){
    $oldCart= $request->session()->has('cart')? session()->get('cart'):null;
    $cart=new Cart($oldCart);
    $cart->reduceByOne($id);
    session()->put('cart',$cart);
    return redirect()->route('product.shoppingCart');
  }
  public function getCart(){
      if (!session()->has('cart')){
          return view('shop.shopping-cart');
      }
      $oldCart=session()->get('cart');
      $cart=new Cart($oldCart);
      return view('shop.shopping-cart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
  }
  public function getCheckout(){

    if (!session()->has('cart')){
        return view('shop.shopping-cart');
    }
    $oldCart=session()->get ('cart');
    $cart =new Cart ($oldCart);
    $total =$cart ->totalPrice;
    return view('shop.checkout', ['total'=>$total]);
    }

  public function postCheckout(Request $request)
  {
    if(!session()->has('cart')){
        return redirect()->route('shop.shoppingCart');
    }
    $oldCart=session()->get('cart');
    $cart=new Cart($oldCart);

    Stripe::setApiKey('sk_test_51Jzu2DKP87mFuadahaQfbQfUZqZmRcvqSdN5yPxIDCGhscqDQBYs2ijZWQx977rGR6Y52gFApB734RjKbHTXOU6200k0khEDw9');
    try{

        $charge=Charge::create(array(
            'amount'=>$cart->totalPrice,
            "currency"=>"mxn",
            "source"=>$request->input('stripeToken'),
            "description"=>"Charge for test@example.com"

        ));
        $order=new Order();
        $order->cart =serialize($cart);
        $order->address=$request->input('address');
        $order->name=$request->input('name');
        $order->payment_id=$charge->id;
        Auth::user()->orders()->save($order);


    }catch(\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());

    }
    session()->forget('cart');
    return redirect()->route('product.index')->with('success', 'Successfully purchased products');
    }
}
