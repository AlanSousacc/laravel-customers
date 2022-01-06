<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $dates = [ 'deleted_at' ];
  
  protected $fillable = ['name', 'user_id', 'document', 'status'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function numbers()
  {
    return $this->hasMany(Number::class);
  }
}
