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
    	<?php echo form_open('ticketmx/register'); ?>
        <div class="campos_sesion">
		<?php echo validation_errors(); ?>
        	<table width="100%" border="0" rules="none">
              <tr>
                <td colspan="4" valign="top" height="100"><h1>Registo TICKETMX</h1></td>
              </tr>
              <tr>
                <td width="30%" rowspan="5" align="center" valign="top"><img src="imagen/TICKETMX_TRANS.png" class="foto_banner" alt=""/></td>
              </tr>
              <tr>
                <td width="35%" align="right" height="50" valign="top">Dirección e-Mail:
                <input type="text" id="correo" class="campostexto" value="<?php echo set_value('correo'); ?>" name="correo" required></td>
                <td width="2%" rowspan="6">&nbsp;</td>
                <td width="33%" rowspan="6" align="justify" valign="middle">
                    En TICKETMX conseguir tu boleto ya no sera un fastidio, ahora podras asegurar tu entrada desde cualquier lugar, 
                    en cualquier momento, desde internet y al mejor precio.<br>
                    <br>
                    Seras el primero en enterarte de los nuevos eventos y promociones, no lo pienses mas, se parte de TICKETMX.
                </td>
              </tr>
              <tr height="50px" valign="top">
                <td  align="right">Primer apellido: 
                <input type="text" id="primero" class="campostexto" value="<?php echo set_value('primero'); ?>" name="primero" required></td>
              </tr>
              <tr height="50px" valign="top">
                <td  align="right">Segundo apellido:
                <input type="text" id="segundo" class="campostexto" value="<?php echo set_value('segundo'); ?>" name="segundo"></td>
              </tr>
              <tr height="70px" valign="top">
                <td align="right">Nombres:
                <input type="text" id="nombres" class="campostexto" value="<?php echo set_value('nombres'); ?>" name="nombres" required></td>
              </tr>
              <tr height="50px" valign="top">
                <td align="right" valign="top">Contraseña: 
                <input type="password" id="contrasena" class="campostexto"></td>
                <td align="right" valign="top">Ciudad:
                <input type="text" id="ciudad" class="campostexto" value="<?php echo set_value('ciudad'); ?>" name="ciudad" required></td>
                <td>&nbsp;</td>
              </tr>
              <tr height="80px" valign="top">
                <td align="right" valign="top">Edad:
                <input type="text" id="edad" maxlength="2" size="5" class="campostexto" value="<?php echo set_value('edad'); ?>" name="edad" required>
                &nbsp; &nbsp;
                Tel:
                <input type="text" id="telefono" maxlength="10" size="10" class="campostexto" name="telefono" value="<?php echo set_value('telefono'); ?>" required>
                </td>
                <td align="right" valign="top">Domicilio:
                <input type="text" id="domicilio" class="campostexto" size="28" value="<?php echo set_value('domicilio'); ?>" name="domicilio" required></td>
              </tr>
              <tr height="50px" valign="top">
                <td align="center" valign="top">&nbsp;</td>
                <td><input type="submit" value="Registrarme" class="botonconfirmar"></td>
                <td width="2%">&nbsp;</td>
                <td width="33%" align="justify" valign="middle">&nbsp;</td>
              </tr>
              <tr height="50px" valign="top">
                <td colspan="4" align="center" valign="top">
                <h2>Al registrarte, estás aceptando los Términos y Condiciones del Aviso de privacidad y Compra.</h2>
                </td>
              </tr>
            </table>
        </div>

        </form>
    </div>
</div>

</div>