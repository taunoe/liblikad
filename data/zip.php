<?php
/* --------------------------------------------
 /data/zip.php
 27 juunu 2011
 Tauno Erik
--------------------------------------------- */
include_once("../app/zip/zip.lib.php");

//Teeme zipi massiivis olevatest joonistest, ette antud nimega
function teezip($files = array(),$zipfail)
{
  $valid_files =array(); 
  if(is_array($files)) 
  { 
    foreach($files as $file) 
    { 

      if(file_exists($file)) 
      { 
        $valid_files[] = $file;
      } 
    } 
  }
  if(count($valid_files)) 
  {
    $zip = new zipfile();
    foreach($valid_files as $file) 
    { 
      //$zip->addFile($file,$file);
      $fsize = @filesize($file); 
      $fh = fopen($file, 'rb', false); 
      $data = fread($fh, $fsize);              
      $zip->addFile($data,$file); 
      $zipcontents = $zip->file(); 
    }
    header("Content-type: application/octet-stream"); 
    header("Content-Disposition: attachment; filename=".$zipfail); 
    header("Content-length: " . strlen($zipcontents) . "\n\n");
    echo $zipcontents;
  }

}


if(isset($_GET['zip']) && ($_GET['zip']) != '' )
{
 $projekt = ($_GET['zip']);
 if(is_dir($projekt))
 {
   $files_to_zip = array('');// tyhi masiiv kuhu lisame jooniste andmed
 
   $files = glob($projekt.'/'.'*.*');//, GLOB_BRACE
   foreach($files as $f)
   {
     array_push($files_to_zip,$f);
   }
   $nimi= $projekt.'.zip';
   teezip($files_to_zip,$nimi);
 }
 else
 { 
   header("location: ../index.php");
 }
}
else
{
  header("location: ../index.php");
  //exit ("<script language='javascript'> history.go (-2) </script>");
 // Kui tuleme nii sama siia ja midagi ei ole pakkida saadame ta tabel.php le
 //die (' <META HTTP-EQUIV="refresh" content="0; URL=../index.php"> ');
}

?>
