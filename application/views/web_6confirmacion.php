<style>
/*el estilo es para poder extraer el nombre del fondo desde mysql*/
body{
	background-color:#000;
	background-image:url(imagen/inicio6.png);
}
</style>

<body>
<div id="body">
<div class="largo_sesion">
	<div class="caja_sesion">
    	<form>
        <div class="campos_sesion">
		<table width="100%" border="0" rules="none">
			<tr>
				<td valign="top" height="100"><h1>Enhorabuena</h1></td>
			</tr>
			<tr>
				<td width="70%">
                	Ya puedes iniciar sesión, la información proporcionada ha sido almacenada en nuestros servidores, disfruta TICKETMX
                    <br>
                    <br>
					<a class="enlaceblanco" href="<?php echo site_url('ticketmx/login'); ?>">
	                    Iniciar sesión
                    </a>
                    <br>
                    <br>
                    <br>
				</td>
			</tr>
			<tr>
				<td valign="top"><img src="imagen/TICKETMX_TRANS.png" class="foto_banner" alt="" width="50%" height="50%"/></td>
			</tr>
            </table>
        </div>

        </form>
    </div>
</div>

</div>