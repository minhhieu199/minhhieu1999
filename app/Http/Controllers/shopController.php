<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class shopController extends Controller
{
    //trang chủ
    public function index()
    {
    	return view('shop.index');
    }

    //trang liên hệ
    public function contact()
    {
    	return view('shop.contact');
    }
    //danh-muc-san-pham
    public function listproduct()
    {
    	return view('shop.listproduct');
    }
    //chi-tiết-sản-phẩm
    public function productdetail()
    {
    	return view('shop.productdetail');
    }
   

}
