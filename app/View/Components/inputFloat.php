<?php

namespace App\View\Components;


use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class inputFloat extends Component
{
   public function __construct(
      public string $id,
      public string $label,
      public string $info = '',
      public string $name = '',
  ){
  }

  public function render()
  {
     if ($this->name == "") {
            $this->name = $this->id;
        }
        
      return view('components.input-float');
  }
}
