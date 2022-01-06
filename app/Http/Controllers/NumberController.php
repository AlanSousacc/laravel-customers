<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumberRequest;
use App\Models\Customer;
use App\Models\Number;
use App\Services\NumberPreferenceServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NumberController extends Controller
{
    private $number;
    private $customer;
    private $nbpref;
    public function __construct(Number $number, Customer $customer, NumberPreferenceServices $nbpref)
    {
        $this->number   = $number;
        $this->customer = $customer;
        $this->nbpref   = $nbpref;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbers = $this->number->with('customer')->paginate(10);
        return view('pages.number.indexNumber', compact('numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $customers = $this->customer;
        $id != null ? $customers = $customers->where('id', $id)->get() : $customers = $this->customer->get();

        return view('pages.number.createNumber', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NumberRequest $request)
    {
        $data = $request->except('_token');

        try {
            $number = $this->number->create($data);

            DB::beginTransaction();
            if (!$number->save())
                return redirect()->back()->with('error', 'Failed to save this number!');

            $this->nbpref->createNumberPreference(
                ['number_id' => $number->id, 'name' => 'auto_attendant','value' => 1 ]
            );

            $this->nbpref->createNumberPreference(
                ['number_id' => $number->id, 'name' => 'voicemail_enabled','value' => 1 ]
            );

            DB::commit();
            return redirect()->route('numbers.index')->with('success', 'Number created successfully!');
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $number     = $this->number->find($id);
        $customers  = $this->customer->all();
        return view('pages.number.editNumber', compact('number', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NumberRequest $request, $id)
    {
        $data = $request->except('_token');

        try {
            DB::beginTransaction();
            if (!$number = $this->number->find($id))
                return redirect()->back()->with('error', 'No numbers found');

            $number->number       = $data['number'];
            $number->customer_id  = $data['customer_id'];
            $number->status       = $data['status'];

            if (!$number->save())
                return redirect()->back()->with('error', 'Failed to update this number!');

            DB::commit();
            return redirect()->route('numbers.index')->with('success', 'Number updated successfully!');
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     change the status of the number in the database
     *
     */
    public function changeStatus(Request $request)
    {
        $data = $request->except('_token');
        
        try {
            DB::beginTransaction();
            if (!$number = $this->number->find($data['number_id']))
                return redirect()->back()->with('error', 'No numbers found');

            $number->status = $data['status'];

            if (!$number->save())
                return redirect()->back()->with('error', 'Failed to update this number!');

            DB::commit();
            return redirect()->route('numbers.index')->with('success', 'Number updated successfully!');
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!$number = $this->number->find($request->number_id))
                return redirect()->route('numbers.index')->with('error', 'No numbers found!');        
      
            $numbpref = $this->nbpref->findNumberPreference($request->number_id);

            $number->delete();
            foreach($numbpref as $n){
                $n->delete();
            }
            DB::commit();
            return redirect()->route('numbers.index')->with('success', 'Number deleted successfully!');
      
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('numbers.index')->with('error', $e->getMessage());
        }
    }
}
