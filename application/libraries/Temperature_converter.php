<?php

class Temperature_converter {
  public function CtoF($degree) {
    return round((9/5) * $degree +32, 1);
  }

  public function FtoC($degree) {
    return round((5/9) * ($degree - 32), 1);
  }
}