<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    private $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = $this->customer->where('user_id', Auth::user()->id)->paginate(10);
        return view('pages.customer.indexCustomer', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.customer.createCustomer');
    }

    /**
     * faz um try catch para tratar erros
     * Salva o customer no banco de dados.
     * @param  \Illuminate\Http\CustomerRequest  $request
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->except('_token');

        try {
            $data['user_id'] = Auth::user()->id;
            $customer = $this->customer->create($data);

            DB::beginTransaction();
            $saveCustomer = $customer->save();

            if (!$saveCustomer)
                return redirect()->back()->with('error', 'Failed to save this customer!');

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
            
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
        $customer = $this->customer->find($id);
        return view('pages.customer.editCustomer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $data = $request->except('_token');

        try {
            DB::beginTransaction();
            if (!$customer = $this->customer->find($id))
                return redirect()->back()->with('error', 'No customers found');

            if($customer->user_id != Auth::user()->id)
                return redirect()->back()->with('error', 'You are not allowed to edit this customer!');

            $customer->name     = $data['name'];
            $customer->user_id  = Auth::user()->id;
            $customer->document = $data['document'];
            $customer->status   = $data['status'];
            $saveCustomer       = $customer->save();

            if (!$saveCustomer)
                return redirect()->back()->with('error', 'Failed to update this customer!');

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
            
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * change the status of the customer in the database
     */
    public function changeStatus(Request $request)
    {
        $data = $request->except('_token');
        
        try {
            DB::beginTransaction();
            if (!$customer = $this->customer->find($data['customer_id']))
                return redirect()->back()->with('error', 'No customers found');

            $customer->status = $data['status'];

            if (!$customer->save())
                return redirect()->back()->with('error', 'Failed to update this customer!');

            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
            
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
            if (!$customer = $this->customer->find($request->customer_id))
            return redirect()->route('customers.index')->with('error', 'No customers found!');        

            if($customer->user_id != Auth::user()->id)
              return redirect()->back()->with('error', 'You are not allowed to delete this customer!');
      
            $customer->delete();
            DB::commit();
            return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
      
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customers.index')->with('error', $e->getMessage());
        }
    }
}
