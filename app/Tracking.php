<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = "invoice_items_tracking";
    protected $primaryKey = 'trackingnumber';
    protected $timstamps = false;
    protected $fillable = ['trackingnumber', 'status'];
}
