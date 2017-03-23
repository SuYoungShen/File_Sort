<?php

Class File_Sort{

  function File_Names_Sort($test){
    $low = strtolower($test);
    $NewString1 = preg_split("/[.]+/", preg_replace('/\t|\r|\n/', '', strtolower($low)));

    $num = count($NewString1);

    if ($NewString1[$num-1]=="js") {
    return "<script src='$low'></script>";
    }else if ($NewString1[$num-1]=="css") {
      return "<link rel='stylesheet' href='$low'>";
    }
  }
}
$file = new File_Sort();
echo $file->File_Names_Sort("Te  st.js");


?>
