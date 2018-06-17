<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return new DonorCollection(
            DonorResource::collection(
                Donor::all()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request $request
     * @return \App\Http\Resources\DonorResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'userName' => 'required',
            'phoneNumber' => 'required|numeric',
            'password' => 'required'
        ]);

        $donor = new Donor;

        $donor->email = $request->email;
        $donor->username = $request->userName;
        $donor->phone_number = $request->phoneNumber;
        $donor->password = $request->password;

        try {

            $donor->saveOrFail();

        } catch (\Throwable $e) {

            $e->getMessage();

        }

        return new DonorResource(
            $donor
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\DonorResource
     */
    public function show($id)
    {
        return new DonorResource(
            Donor::findOrFail($id)
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\DonorResource
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'bail|required',
            'email' => 'email',
            'phoneNumber' => 'numeric'
        ]);

        $donor = Donor::findOrFail($request->id);

        $donor->email = $request->email;
        $donor->username = $request->userName;
        $donor->phone_number = $request->phoneNumber;
        $donor->password = $request->password;
        $donor->saveOrFail();

        return new DonorResource(
            $donor
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
        Donor::destroy($id);
        return true;
    }
}
