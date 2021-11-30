<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;

use Illuminate\Database\Eloquent\Collection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getIndex()
    {
        $x=new Product();
    
        $products= Product::all();
    
        return view('shop.index', ['products'=>$products]);
    }

    public function getForm(){
        return view ('shop.product-form');
    }

    public function postForm(Request $request){
        $this->validate($request, [
            'title'=>'required|unique:products',
            'description'=>'required|min:10',
            'imagePath'=>'required',
            'price'=>'required|numeric',

        ]);
        $product=new Product([
            'title'=>$request->input ('title'),
            'description'=>$request->input ('description'),
            'imagePath'=>$request->input ('imagePath'),
            'price'=>$request->input ('price'),

        ]);
        $product->save();
        
        if(session()->has('oldUrl')){
            $oldUrl=session()->get()->oldUrl;
            return redirect()->to($oldUrl);
        }
        return redirect()->route('product.list')->with('message', 'Registro creado exitosamente');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|unique:products',
            'description'=>'required|min:10',
            'imagePath'=>'required',
            'price'=>'required|numeric',

        ]);
        $product=new Product([
            'title'=>$request->input ('title'),
            'description'=>$request->input ('description'),
            'imagePath'=>$request->input ('imagePath'),
            'price'=>$request->input ('price'),

        ]);
        $product->save();
        
        if(session()->has('oldUrl')){
            $oldUrl=session()->get()->oldUrl;
            return redirect()->to($oldUrl);
        }
        return redirect()->route('product.list')->with('message', 'Registro creado exitosamente');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       // $product= Product ::where('id',$id)->first();
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view ('shop.product-form', compact('product'));
    }

    public function getList(){
        $products=Product::all();
        
        return view ('product.list', compact ('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'title'=>'required',
            'description'=>'required|min:10',
            'imagePath'=>'required',
            'price'=>'required|numeric',

        ]);
        
        $product->title=$request->input ('title');
        $product->description=$request->input ('description');
        $product->imagePath=$request->input ('imagePath');
        $product->price=$request->input ('price');
        

        
        $product->save();
        
        if(session()->has('oldUrl')){
            $oldUrl=session()->get()->oldUrl;
            return redirect()->to($oldUrl);
        }
        return redirect()->route('product.list')->with('message', 'Registro actualizado exitosamente');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.list')->with('message', 'Registro eliminado exitosamente');
    }



    //***************************************************************************************************************Cart */
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
    
        /*Stripe::setApiKey('sk_test_51Jzu2DKP87mFuadahaQfbQfUZqZmRcvqSdN5yPxIDCGhscqDQBYs2ijZWQx977rGR6Y52gFApB734RjKbHTXOU6200k0khEDw9');
        try{*/
    
            /*$charge=Charge::create(array(
                'amount'=>$cart->totalPrice,
                "currency"=>"mxn",
                "source"=>$request->input('stripeToken'),
                "description"=>"Charge for test@example.com"
    
            ));*/
            $order=new Order();
            $order->cart =serialize($cart);
            $order->address=$request->input('address');
            $order->name=$request->input('name');
            $order->user_id=Auth::user()->id;
            //$order->payment_id=$charge->id;
            Auth::user()->orders->save($order);
            
            //$table->integer('user_id');
            /*$table->text('cart');
            $table->string('address');
            $table->string('payment_id');
    
    
       /* }catch(\Exception $e){
                return redirect()->route('checkout')->with('error', $e->getMessage());
    
        }*/
        session()->forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products');
        }
    
        public function getProfile(){
            $orders =Auth::user()->orders;
            if($orders!=NULL){
            $orders->transform(function($order,$key){
                $order->cart=unserialize($order ->cart);
                return $order;
            });
            return view('user.profile', ['orders'=>$orders]);}
            else
            return view('shop.index');
        }
}
