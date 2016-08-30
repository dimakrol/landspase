<?php

namespace App\Models;

use DB, Config, Log, Elasticsearch, Cache;
use LaravelArdent\Ardent\Ardent;
use Carbon\Carbon;

class BaseModel extends Ardent
{
  public function beforeSave() {
    
  }

  public function afterSave() {
    
  }

  public function beforeDelete() {
    
  }

  public function afterDelete() {
    
  }
}