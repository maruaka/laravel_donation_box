<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    protected $table = 'donations';
    
    protected $guarded = [
    'id',
    'created_at',
    'updated_at',
  ];
  
    public function blog() 
    {
        return $this->belongsTo('App\Models\Blog','id','point');
    }
    
    
}
