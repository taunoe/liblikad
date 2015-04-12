<?php
/* ---------------------------------
 app_uploader.php
 08 juuli 2011
 Tauno Erik
--------------------------------- */

require_once ('app/config.php');
require_once('app/upload/Streamer.php');

$up_folder = './'.$data_folder.$_GET['projekt'].'/';

$ft = new File_Streamer();
$ft->setDestination($up_folder);
$ft->receive();

?>
