<?php

namespace App\Models\Valuation\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;

class Status extends BaseModel
{
    protected $table = 'alt_order_status';
    protected $fillable = ['name','code','is_protected'];

    public $timestamps = false;
}
