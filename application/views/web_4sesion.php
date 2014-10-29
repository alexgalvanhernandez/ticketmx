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
		<?php echo form_open('ticketmx/login'); ?>
        <div class="campos_sesion">
		<?php echo validation_errors(); ?>
        	<table width="100%" border="0" rules="none">
              <tr>
                <td colspan="3" valign="top" height="100px"><h1>Bienvenido a TICKETMX</h1></td>
              </tr>
              <tr>
                <td width="30%" rowspan="6" align="center" valign="top"><img src="imagen/TICKETMX_TRANS.png" class="foto_banner" alt=""/></td>
              </tr>
              <tr>
                <td width="30%">Dirección e-Mail: </td>
                <td width="40%" rowspan="5">
                	¿Aun no estas registrado? No esperes mas!!
                    <br>
                    <br>
					<a class="enlaceblanco" href="<?php echo site_url('ticketmx/register'); ?>">
	                    Registrarme
                    </a>
                </td>
              </tr>
              <tr height="60px" valign="top">
                <td><input type="text" id="correo" required class="campostexto" value="<?php echo set_value('correo'); ?>" name="correo"></td>
              </tr>
              <tr>
                <td>Contraseña: </td>
              </tr>
              <tr height="60px" valign="top">
                <td><input type="password" id="contrasena" required class="campostexto" value="<?php echo set_value('contrasena'); ?>" name="contrasena"></td>
              </tr>
              <tr height="60px" valign="top">
                <td><input type="submit" value="Entrar" class="botonconfirmar"></td>
              </tr>
            </table>
        </div>

        </form>
    </div>
</div>

</div>