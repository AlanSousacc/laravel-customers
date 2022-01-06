<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Number;
use App\Models\NumberPreference;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    private $number;
    private $customer;
    private $nbpref;
    public function __construct(Number $number, Customer $customer, NumberPreference $nbpref)
    {
        $this->middleware('auth');
        $this->number   = $number;
        $this->customer = $customer;
        $this->nbpref   = $nbpref;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $numbers  = $this->number->count();
        $customer = $this->customer->count();
        $nbpref   = $this->nbpref->count();
        return view('home', compact('numbers', 'customer', 'nbpref'));
    }
}
