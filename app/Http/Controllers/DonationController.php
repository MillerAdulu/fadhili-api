<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Http\Resources\DonationCollection;
use App\Http\Resources\DonationResource;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\DonationCollection
     */
    public function index()
    {
        return new DonationCollection(
            DonationResource::collection(
                Donation::all()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\DonationResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'destination' => 'required|exists:destinations, id'
        ]);

        $donation = new Donation;

        $donation->name = $request->name;
        $donation->image = $request->image;
        $donation->price = $request->price;
        $donation->destination = $request->destination;

        try {

            $donation->saveOrFail();

        } catch (\Throwable $e) {

            $e->getMessage();

        }

        return new DonationResource(
            $donation
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\DonationResource
     */
    public function show($id)
    {
        return new DonationResource(
            Donation::findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Http\Resources\DonationResource
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'destination' => 'required|exists:destinations, id'
        ]);

        $donation = Donation::findOrFail(
            $request->id
        );

        $donation->name = $request->name;
        $donation->image = $request->image;
        $donation->price = $request->price;
        $donation->destination = $request->destination;

        $donation->saveOrFail();

        return new DonationResource(
            $donation
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
        Donation::destroy($id);
        return true;
    }
}
