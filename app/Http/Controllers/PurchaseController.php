<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseCollection;
use App\Http\Resources\PurchaseResource;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\PurchaseCollection
     */
    public function index()
    {
        return new PurchaseCollection(
            PurchaseResource::collection(
                Purchase::all()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\PurchaseResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'donorId' => 'required|exists:donors,id',
            'donationId' => 'required|exists:donations_id'
        ]);

        $purchase = new Purchase;

        $purchase->donor_id = $request->donorId;
        $purchase->donation_id = $request->donationId;
        $purchase->amount = $request->donationAmount;

        try {
            $purchase->saveOrFail();
        } catch (\Throwable $e) {
            $e->getMessage();
        }

        return new PurchaseResource(
            $purchase
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\PurchaseCollection
     */
    public function show($id)
    {
         return new PurchaseCollection (
			PurchaseResource::collection(
            	Purchase::where('donor_id', $id)->get()
        	)
		);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\PurchaseResource
     */
    public function update(Request $request)
    {
        $request->validate([
            'purchaseId' => 'required|exists:purchases, id',
            'donorId' => 'required|exists:donors,id',
            'donationId' => 'required|exists:donations_id'
        ]);

        $purchase = Purchase::find(
            $request->donationId
        );

        $purchase->donor_id = $request->donorId;
        $purchase->donation_id = $request->donationId;
        $purchase->payment_status = $request->paymentStatus;

        try {
            $purchase->saveOrFail();
        } catch (\Throwable $e) {
            $e->getMessage();
        }

        return new PurchaseResource(
            $purchase
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return boolean
     */
    public function destroy($id)
    {
        Purchase::destroy($id);
        return true;
    }
}
