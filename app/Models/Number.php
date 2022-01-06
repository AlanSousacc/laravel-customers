<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Number extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $dates = [ 'deleted_at' ];
  
  protected $fillable = ['number', 'customer_id', 'status'];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function numberPreferences()
  {
    return $this->hasMany(NumberPreference::class);
  }
}
