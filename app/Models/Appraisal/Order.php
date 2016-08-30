<?php

namespace App\Models\Appraisal;

use App\Models\BaseModel;
use Laravel\Scout\Searchable;

class Order extends BaseModel
{
  use Searchable;
  
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'appr_order';
}
