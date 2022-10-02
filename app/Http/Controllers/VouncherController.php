<?php

namespace App\Http\Controllers;

use App\Models\Vouncher;
use Illuminate\Http\Request;

class VouncherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Vouncher::all();
        return view('voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $voucherInput = $request->input('voucher_number');
        $voucherAmount = $request->input('voucher_amount');

        if($voucherInput == null){
            return redirect()->back()->with('failed', 'please input the number of vouchers you want to generate');
        }

        if($voucherAmount == null){
            return redirect()->back()->with('failed', 'please input the amount of the voucher');
        }

    $voucher = null;
         for ($i=0; $i < $voucherInput; $i++) { 

            $voucher = new Vouncher();

            $generatedPin = "";
    
                $string = rand(1000000000, 9999999999);
                $pin = Vouncher::where('voucher_number', '=', $string)->first();
                if($pin){
                    return;
                }else{
                    $generatedPin = $string;
                }
            
    
        
                $voucher->voucher_number = $generatedPin;
                $voucher->amount = $voucherAmount;
                $voucher->activated_voucher = '';
                $voucher->status = 'available';
                $voucher->save();
                 
        }

        if($voucher != null){
            return redirect()->back()->with('success', $voucherInput. ' Vouchers successfully generated');
        }else{
            return redirect()->back()->with('failed', $voucherInput. ' Vouchers could not be generated');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vouncher  $vouncher
     * @return \Illuminate\Http\Response
     */
    public function show(Vouncher $vouncher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vouncher  $vouncher
     * @return \Illuminate\Http\Response
     */
    public function edit(Vouncher $vouncher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vouncher  $vouncher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vouncher $vouncher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vouncher  $vouncher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vouncher $vouncher)
    {
        //
    }
}
