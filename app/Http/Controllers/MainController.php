<?php

namespace App\Http\Controllers;


use App\Models\Product;

class MainController extends Controller
{
    /**
     * Opens about page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Opens catalog page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function catalog()
    {
        return view('product.catalog');
    }

    /**
     * Opens contact page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Opens product card
     * @param $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function product(Product $product)
    {
        return view('product.card', compact('product'));
    }
}
