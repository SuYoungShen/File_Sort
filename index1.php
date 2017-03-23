<?php
  include 'File_Sort.php';

  $File_Sort = new File_Sort();

  $Testjs = "test.js";


  // echo $File_Sort->File_Names_Sort($Testjs);
  // $fn_lists = "test.js";
  $fn_lists = 'test.js/css.css';
 $fn_list = explode('|', preg_replace('/\t|\r|\n/', '', $fn_lists));
foreach ($fn_list as $value) {
  echo $value;
}

 ?>
