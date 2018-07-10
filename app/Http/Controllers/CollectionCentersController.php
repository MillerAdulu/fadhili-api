<?php

namespace App\Http\Controllers;

use App\CollectionCenter;
use App\Http\Resources\CollectionCenterCollection;
use App\Http\Resources\CollectionCenterResource;

class CollectionCentersController extends Controller
{
    public function index() {
      return new CollectionCenterCollection(
        CollectionCenterResource::collection(
          CollectionCenter::all()
        )
      );
    }
}
