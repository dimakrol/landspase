<?php

namespace App\Models\Appraisal;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Addenda extends Model
{
    use SoftDeletes;

    protected $table = 'addendas';
    protected $fillable = ['descrip','invest','price','is_protected'];

    public $timestamps = false;
}
