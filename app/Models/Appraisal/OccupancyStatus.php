<?php

namespace App\Models\Appraisal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OccupancyStatus extends Model
{
    use SoftDeletes;

    protected $table = 'occstatus';
    protected $fillable = ['descrip','mismo_label','is_protected'];

    public $timestamps = false;
}
