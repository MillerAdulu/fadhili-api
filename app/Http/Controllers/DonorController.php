<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Http\Resources\DonorCollection;
use App\Http\Resources\DonorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'donorEmail' => 'required|email',
            'donorUserName' => 'required',
            'donorPhoneNumber' => 'required|numeric',
            'donorPassword' => 'required'
        ]);

        $donor = new Donor;

        $donor->email = $request->donorEmail;
        $donor->username = $request->donorUserName;
        $donor->phone_number = $request->donorPhoneNumber;
        $donor->password = $request->donorPassword;

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

    public function login(Request $request) {
        $request->validate([
            'donorEmail' => 'email'
        ]);

        $donor = Donor::where('email', $request->donorEmail)->firstOrFail();

        if(Hash::check($request->donorPassword, $donor->password)) {
            return new DonorResource(
                $donor
            );
        } else 
        return null;
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
            'donorId' => 'bail|required',
            'donorEmail' => 'email',
            'donorPhoneNumber' => 'numeric'
        ]);

        $donor = Donor::findOrFail($request->donorId);

        $donor->email = $request->donorEmail;
        $donor->username = $request->donorUserName;
        $donor->phone_number = $request->donorPhoneNumber;
        $donor->password = $request->donorPassword;
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
