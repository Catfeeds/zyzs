<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Sitenav;

class ProductsController extends Controller
{
    public function show($id)
    {
    	$showdata = Product::where('id',$id)->where('showsnot','1')->first();
    	if ($showdata) {
    		$showproductparent = Sitenav::where('id',$showdata->nav_id)->first();
    		return view('other.product',compact('showdata','showproductparent'));
    	} else {
    		return view('errors.404'); 
    	}
    }
}
