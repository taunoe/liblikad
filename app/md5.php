<?php
//session_start();
?>
<form action='' method='post';>
<fieldset>
<legend>Krypteeria</legend>
<label>S&otilde;na mida tahad kr&uuml;ptida: </label>
<input name='sisestus' type='text' size='30'>
<input name='Submit' type='submit' value='krypti' class='buttonstyle'>
</form>

<?php
$kryptitud_md5= md5($_POST['sisestus']);
$kryptitud_sha1= sha1($_POST['sisestus']);
$sisestatud= $_POST['sisestus'];

if (!isset($_POST['sisestus']))
	{
	echo '';
	}
elseif (isset($_POST['sisestus']))
	{
	echo "<br />sisestatud: <b>{$sisestatud}</b><br/>
	      md5: <b>{$kryptitud_md5}</b><br/>
	      sha1: <b>{$kryptitud_sha1}</b>";
	}	
?>

