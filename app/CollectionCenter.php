<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use TCG\Voyager\Traits\Spatial;
use Illuminate\Support\Facades\DB;

class CollectionCenter extends Model
{
  use Spatial;
  
  protected $geometry = ['coordinates'];
  
  protected $geometryAsText = true;
  
  public function setCoordinatesAttribute($value){
    
    $this->attributes['coordinates'] = DB::raw($value);
    
  }
  
  public function getCoordinatesAttribute($value){
    
    return str_replace(['POINT(', ')', ' '], ['', '', ','], $value);
    
  }
  
  public function newQuery($excludeDeleted = true)
  {
    if(!empty($this->geometry) && $this->geometryAsText === true):
      
      $raw = '';
      
      foreach ($this->geometry as $column):
        $raw .= ' ST_AsText(' . $column .') as ' . $column . ' ';
      endforeach;
      
      return parent::newQuery($excludeDeleted)->addSelect('*', DB::raw($raw));
    
    endif;
    
    return parent::newQuery($excludeDeleted);
  }
}
