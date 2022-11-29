<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Open basket with values from session
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function basket(Request $request)
    {
        $products = null;
        if($request->session()->has('basket')) {
            $productIds = $request->session()->get('basket');
            $productIds = array_keys($productIds);
            $products = Product::whereIn('id', $productIds)->get();
        }
        return view('product.basket', compact('products'));
    }
    /**
     * Refresh basket with new product amount
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function basketPost(Request $request)
    {
        $basket = $request->input('productsIds');
        $basket = array_filter($basket, function($item) {
            return $item >= 1;
        });
        $request->session()->put('basket', $basket);
        return back();
    }
    /**
     * Add product to basket
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToBasket(Request $request)
    {
        $basket = [];
        if($request->session()->has('basket'))
            $basket = $request->session()->get('basket');
        $basket[(int) $request->query('productId')] = 1;
        $request->session()->put('basket', $basket);
        return back();
    }
    /**
     * Remove product to basket
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromBasket(Request $request)
    {
        $basket = $request->session()->get('basket');
        unset($basket[$request->query('productId')]);
        $request->session()->put('basket', $basket);
        return back();

    }
    /**
     * Create order from basket
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrder(Request $request)
    {
        if(!$request->session()->has('basket')) return back()->with('errorCreate', true);
        $order = Order::create([
            'user_id' => Auth::user()->id
        ]);

        $basket = $request->session()->get('basket');
        $basket = array_filter($basket, function($item) {
            return $item >= 1;
        });

        $productIds = array_keys($basket);
        $products = Product::whereIn('id', $productIds)->get();
        foreach($products as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'price' => $item->price,
                'count' => $basket[$item->id]
            ]);
        }
        $request->session()->forget('basket');
        return redirect()->route('order.orders')->with(['store'=>true]);
    }

    /**
     * Open orders page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function orders()
    {
        return view('product.orders');
    }

    /**
     * Update order status to "Canceled"
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelOrder(Request $request)
    {
        $id = $request->validate(['id'=>'required'])['id'];
        $status = ['status' =>'Canceled'];
        Order::where('id',$id)->update($status);
        return redirect()->route('order.orders')->with(['update'=>true]);
    }


}
