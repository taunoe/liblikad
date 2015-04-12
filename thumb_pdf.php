<?
/* ----------------------------------------
  thumb_pdf.php
  Tauno Erik
  08. juuli 2011
-----------------------------------------*/

require_once ('app/config.php');
require_once ('app/funktsioonid.php');
/*--------------------------
 puhverdab
 
 NÄIDE kasutamisest:
 <img src="/path/to/thumbpdf.php?pdf=your.pdf&size=600">
--------------------------*/

/* ----------------------------------------------------------------------------
 Kui thumb on olemas siis kuvab thumbi
 Aga kui thumb on vale??
 V6i on pdf muutund, siis praegu ei loo uut thumbi vaid n2itab olemasolevat!
 md5 failist ja panna see faili nimeks???
---------------------------------------------------------------------------- */

 $file = $_GET['pdf'];
 $width = $_GET['size'];
 $projekt = explode('/', $file);
 $tmp = $data_folder.$projekt[1].$thumb;
 if ($file && $width)
 {  
   print (thumbPdf($file, $width,$tmp)); 
 }

?>
