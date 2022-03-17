<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{

  protected $tri;

  public function __construct($tri = 'バインド成功！')
  {
    $this->tri = $tri;
  }

  public function training()
  {
    return $this->tri;
  }
}

app()->bind(TrainingController::class, function(){
  return new TrainingController();
});

$tricls = app()->make(TrainingController::class);
$tri_2 = $tricls->training();