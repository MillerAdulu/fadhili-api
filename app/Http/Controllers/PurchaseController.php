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
            'donor_id' => 'bail|required|exists:donors,id',
            'donation_id' => 'bail|required|exists:donations_id'
        ]);

        $purchase = new Purchase;

        $purchase->donor_id = $request->donor_id;
        $purchase->donation_id = $request->donation_id;

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
     * @return \App\Http\Resources\PurchaseResource
     */
    public function show($id)
    {
        return new PurchaseResource(
            Purchase::findOrFail($id)
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
            'id' => 'bail|required|exists:purchases, id',
            'donor_id' => 'bail|required|exists:donors,id',
            'donation_id' => 'bail|required|exists:donations_id'
        ]);

        $purchase = Purchase::find(
            $request->id
        );

        $purchase->donor_id = $request->donor_id;
        $purchase->donation_id = $request->donation_id;

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
