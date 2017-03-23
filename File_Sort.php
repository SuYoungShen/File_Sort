<?php

Class File_Sort{
   function File_Names_Sort($test){
    $NewString1 = preg_split("/[.]+/", $test);
    $num = count($NewString1);
    if ($NewString1[$num-1]=="js") {
    return "
        <script src='$test'></script>
      ";
    }else if ($NewString1[$num-1]=="css") {
      return "<link rel='stylesheet' href='$test'>";
    }
  }
}
?>
