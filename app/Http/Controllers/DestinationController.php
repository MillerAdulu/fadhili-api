<?php
  
  namespace App\Http\Controllers;
  
  use App\Destination;
  use App\Http\Resources\DestinationCollection;
  use App\Http\Resources\DestinationResource;
  use Illuminate\Http\Request;
  
  class DestinationController extends Controller
  {
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\DestinationCollection
     */
    public function index()
    {
      return new DestinationCollection(
        DestinationResource::collection(
          Destination::all()
        )
      );
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\DestinationResource
     */
    public function show($id)
    {
      return new DestinationResource(
        Destination::findOrFail($id)
      );
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //
    }
  }
