<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class FAQController extends Controller
{

    public function show()
    {
        $faq = Page::where('name','faq')->first();
        return view('faq',array('faq' => $faq));
    }
    
}
