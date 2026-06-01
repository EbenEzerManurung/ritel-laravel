<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function customers()
    {
        return view('customers');
    }
    
    public function products()
    {
        return view('products');
    }
    
    public function transaction()
    {
        return view('transaction');
    }
    
    public function history()
    {
        return view('history');
    }
}
