<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $table = 'blogs';
    
    protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];
  
 
  
  public static function getAllOrderByDeadline()
{
  return self::orderBy('created_at', 'asc')->get();
}

  
    public function user() 
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
    public function donation() 
    {
        return $this->hasMany('App\Models\Donation','point','id');
    }
}
