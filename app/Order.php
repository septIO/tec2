<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'guid';
    public $incrementing = false;

    public static function getInvoiceID($guid)
    {
        preg_match('([0-9a-fA-F]+)', $guid, $matches);
        return $matches[0];
    }
}
