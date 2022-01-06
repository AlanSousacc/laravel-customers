<?php

namespace App\Http\Controllers;

use App\Http\Requests\NumberPreferenceRequest;
use App\Models\Number;
use App\Models\NumberPreference;
use App\Services\NumberPreferenceServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NumberPreferenceController extends Controller
{
    private $number;
    private $nbpref;
    private $nbprefmodel;
    public function __construct(NumberPreference $nbprefmodel, Number $number, NumberPreferenceServices $nbpref)
    {
        $this->number       = $number;
        $this->nbpref       = $nbpref;
        $this->nbprefmodel  = $nbprefmodel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbpref = $this->nbprefmodel->paginate(10);
        return view('pages.number-preference.indexNumberPreference', compact('numbpref'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $number = $this->number->find($id);

        return view('pages.number-preference.createNumberPreference', compact('number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NumberPreferenceRequest $request)
    {
        $data = $request->except('_token');

        try {
            DB::beginTransaction();
            $numbpref = $this->nbpref->createNumberPreference($data);

            DB::commit();
            return redirect()->route('numbers-preferences.index')->with('success', 'Number Preference created successfully!');
            
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
        $numbpref = $this->nbprefmodel->find($id);
        return view('pages.number-preference.editNumberPreference', compact('numbpref'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NumberPreferenceRequest $request, $id)
    {
        $data = $request->except('_token');

        try {
            DB::beginTransaction();
            if (!$numbpref = $this->nbprefmodel->find($id))
                return redirect()->back()->with('error', 'No Numer Preference found');

            $numbpref->number_id = $data['number_id'];
            $numbpref->name      = $data['name'];
            $numbpref->value     = $data['value'];

            if (!$numbpref->save())
                return redirect()->back()->with('error', 'Failed to update this Numer Preference!');

            DB::commit();
            return redirect()->route('numbers-preferences.index')->with('success', 'Numer Preference updated successfully!');
            
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
            if (!$numbpref = $this->nbprefmodel->find($request->numbpref_id))
                return redirect()->route('numbers-preferences.index')->with('error', 'No Numer Preference found!');
      
            $numbpref->delete();
            DB::commit();
            return redirect()->route('numbers-preferences.index')->with('success', 'Numer Preference deleted successfully!');
      
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('numbers-preferences.index')->with('error', $e->getMessage());
        }
    }
}
