$(document).ready(function() {

	/* Tabs Activiation
	================================================== */
	var tabs = $('ul.tabs');
	tabs.each(function(i) {
		//Get all tabs
		var tab = $(this).find('> li > a');
		tab.click(function(e) {
			//Get Location of tab's content
			var contentLocation = $(this).attr('href') + "Tab";
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
				e.preventDefault();
				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
			} 
		});
	});
	
	/* Cluetip
	============================================================ */
  $('a.cluetip').cluetip({sticky: true, closePosition: 'title',cluetipClass: 'rounded',});
  
 	$("a[rel=projektimages]").fancybox({
 	   'overlayShow'	: true,
 	   'transitionIn'	: 'elastic',
     'transitionOut': 'elastic'
   });
   
    
  /* edit.php
  kustutavad failid
  ==========================================================*/
  $('.delButton').click(function(){
    //return confirm('Kustutan faili');
    $.post('edit.php', {a:this.name});
  
    $(this).parents('tr').animate({ backgroundColor: "#dafda5" }, "fast")
    .animate({ opacity: "hide" }, "slow")
		return false;
  });
  
  /* edit.php
  kustuta Projekt
  ==========================================================*/
  $('.delProjekt').click(function(){
    //return confirm('Kustutan faili');
    $.post('edit.php', {p:this.name});
  
    $(this).parents('tr').animate({ opacity: "hide" }, "slow");
    $('table').animate({ opacity: "hide" }, "slow");
    //$('#'.this.name).animate({ opacity: "hide" }, "slow")
    return false;
  });
  
//all end 	
});
/*;
   // $('table').animate({ opacity: "hide" }, "slow");
   // $('#'.name).animate({ opacity: "hide" }, "slow")*/
