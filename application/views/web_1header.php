<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>TicketMX</title>

<script> 
function abrir(url) { 
open(url,'','top=300,left=300,width=300,height=300') ; 
} 
</script>

<script language="javascript">
/** javascript slide-show **/
var cons = 1;
function slide_show(){
	var elemento = document.getElementById('galeria').getElementsByTagName('li');	
	for(var n=cons; n <= elemento.length; n++){		
		elemento[n].className = 'selected';
		for(var i = 0; i<elemento.length; i++){
			if(i!=cons){
				elemento[i].className = 'noselected';
			}		
		}
		cons++;							
		break;
	}	
	if(cons >= elemento.length){
		cons = 0;		
	}
	return false;
}
window.onload = function(){
	setInterval(slide_show, 5000);
}
</script>
<link rel="stylesheet" type="text/css" href="style/header.css">
<link rel="stylesheet" type="text/css" href="style/body.css">


<div id="header">
	<div class="inner-header">
		<div class="toplogo">
        <img src="imagen/TICKETMX_TRANS.png" width="85" height="51"  alt=""/>
        </div>
        <div id="topmenu">
        	<div class="menu">
            	<div class="menu-main-container">
                	<ul id="menu-main" class="menu">
                    	<li id="menu-item-1543" ><a href="<?php echo site_url('ticketmx'); ?>">Inicio</a></li>
                        <li id="menu-item-1548" ><a href="<?php echo site_url('ticketmx/login'); ?>">Iniciar sesión</a></li>
                        <li id="menu-item-1549" ><a href="<?php echo site_url('ticketmx/register'); ?>">Registrarme</a></li>
                        <li id="menu-item-1545" ><a href="<?php echo site_url('web/reporte'); ?>">Facebook</a></li>
                        <li id="menu-item-1547" ><a href="<?php echo site_url('admin'); ?>">Instagram</a></li>
                        <li id="menu-item-1547" ><a href="<?php echo site_url('admin'); ?>">Acerca de</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</head>