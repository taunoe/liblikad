<?php
/* ----------------------------------------
  app/app_header.php
  Tauno Erik
  17 juuli 2011
-----------------------------------------*/
//ini_set('error_reporting', NONE);
//ini_set('display_errors', NONE);

require_once ('app/config.php');
require_once ('app/funktsioonid.php');
require_once ('app/phpthumb/ThumbLib.inc.php');


/* ----------------------------------------------------
 Sisse- ja valja-logimise funktsioonide kaivitamine
 index.php?a=login jne
--------------------------------------------------- */
if ($_GET['a'] == 'login'){ if (($_POST["name"]) && ($_POST["password"])){ login();} }
if ($_GET['a'] == 'logout'){ logout(); }

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php if(isset($_GET['projekt'])){ print($_GET['projekt']); }else{ print($title);} ?>
  </title>
	<meta name="description" content="<?php print($description); ?>">
	<meta name="author" content="<?php print($author); ?>">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!-- CSS
  ================================================== -->
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Ubuntu:regular,bold'  type='text/css'/>
	<link rel="stylesheet" href="app/css/base.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="app/css/skeleton.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="app/css/app.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="app/fancybox/jquery.fancybox-1.3.1.css" type="text/css" media="screen" />
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="app/images/favicon.ico" />
	<link rel="apple-touch-icon" href="app/images/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="app/images/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="app/images/apple-touch-icon-114x114.png" />
	
</head>
<body>

<div class="container">
  <div class="sixteen columns top-menu">
  
    <!-- 1 Nupp Avaleht 
	  ================================================== -->
    <div class="one columns alpha">
      <a href="./" title="Avaleht">
        <img src="app/images/home.png" alt="Button">
      </a>
    </div>
    
    <!-- 2 Nupp Projektid
	  ================================================== -->
    <div class="two columns omega">
      <ul class="menu">
			  <li class=""><a href="#" title="<? print ($title); ?>"><img src="app/images/Folder.png"  alt="Button"></a> 
        <div id="kolmnurk"><img src="app/images/Kolmnurk.png"></div>
          <ul class="">
        	  <?php print ButtonProjektiMenu($projects); ?> 
        	</ul> 
    		</li>
    	</ul><!-- parem menu end //-->
    </div>
    
    <!-- 3 Nupp Uus Projekt
	  ================================================== -->
	  <div class="one columns omega">
	    <?php print ButtonUusProjekt(); ?>
    </div><!-- one columns omega end//-->
    
    <!-- 4 Nupp Muutmine
	  ================================================== -->
    <div class="one columns omega">
      <?php print ButtonEdit('edit','Pencil.png','Pencil_hall.png','Projekti muutmine','4'); ?>
    </div>
    
    <!-- 5 Nupp Upload
	  ================================================== -->
    <div class="two columns omega">
      <?php print ButtonAdminNupp('upload','Up.png','Up_hall.png','Failide üleslaadimine','5'); ?>
    </div>
    
    <!-- 6 Nupp Stats
	  ================================================== -->
    <div class="one columns omega">
      <?php print ButtonStats('stats','Stats.png','Stats_hall.png','Statistika','6'); ?>
    </div>
    
    <!-- 7 Nupp Flow
	  ================================================== -->
    <div class="one columns alpha">
      <a href="flow.php" title="Kõik pildid">
        <img src="app/images/Flow.png" alt="Flow">
      </a>
    </div>
    
    <!-- 8 Nupp Search
	  ================================================== -->
    <div class="one columns alpha">
      <ul class="menu">
        <li class="">
          <a href="search.php" title="Otsing">
            <img src="app/images/Search.png" alt="Flow">
          </a>
          <div id="kolmnurk"><img src="app/images/Kolmnurk.png"></div>
          <ul class="">
          <form action="search.php" method="get" id="otsinguform" > 
          	<fieldset> 
            	<input id="otsing" type="text" title="Otsi." name="q" placeholder="Otsi.." autocomplete="off"> 
          	</fieldset> 
        	</form>
          </ul>
      </ul>
    </div>
    
    <!--<div class="six columns omega">.</div>//-->
    
    
    <!-- 9 Nupp Logout
	  ================================================== -->
    <div class="one columns omega">
    </div><!-- one columns alpha end //-->
    
    
  </div><!-- sixteen columns end //-->
  <?php flush() ?>
  
