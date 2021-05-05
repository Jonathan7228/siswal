<?php
session_start();
include_once 'Obra.php';
include_once 'ContactoObra.php';
if ($_SESSION["autenticado"] == "1") {
	$_SESSION['cont']='1';
    $fecha = date('Y-m-d H:i');
	$anno_actual = date('Y');
	$obra=unserialize($_SESSION['obra']);
	$contacto = new ContactoObra('','','','','','','','','','');
	$resp = $contacto->buscarContacto($obra->id);
	if($resp){
		$ver_contactos=1;
	}else{
		$ver_contactos=0;
	}
    if(!empty($_POST['tarea'])){
			$str = $_POST['nombre'];
			$str = strtoupper($str);
			$_POST['nombre']=$str;
			$str = $_POST['cargo'];
			$str = strtoupper($str);
			$_POST['cargo']=$str;
			$str = $_POST['profesion'];
			$str = strtoupper($str);
			$_POST['profesion']=$str; 
			if ($_POST['tarea'] == 'guardar') {
				$fecha_nac=$_POST['anno'].'-'.$_POST['mes'].'-'.$_POST['dia'];
				$contacto = new ContactoObra('',$obra->id,$_POST['nombre'],$_POST['cargo'],$_POST['telefono'],$_POST['celular'],$_POST['email'],$fecha_nac,$_POST['profesion'],'1');
				$guardar = $contacto->guardarContacto();
				if ($guardar) {
					echo "<script>alert ('El Contacto fue creado con exito');</script>";
					echo "<script>window.location.href='CrearContactosObra.php';</script>";
					$_SESSION['cont']='1';
				} else {
					echo "<script>alert ('No se pudo crear el contacto, por favor intenta de nuevo');</script>";
					/*echo "<script>window.location.href='CrearCliente.php';</script>";*/
				}
				
    }
 }
 	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crear Contactos de la Obra</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet">
<script src="js/validaciones.js" language="JavaScript"></script>
<script src="js/reloj.js" language="JavaScript"></script>
<style type="text/css">
<!--

-->
</style>
</head>

<body topmargin="0" onLoad="mueveReloj();" onKeyDown = "showDown(window.event)">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form action="" method="post" name="form1" class="FormGeneral" id="form1" target="_parent" enctype="multipart/form-data">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="middle"><table width="100%" height="35" border="0">
            <tr>
              <td width="196"><img src="imagenes/logoge.png" alt="Himed" width="200" height="40" /></td>
              <td align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2" align="right" valign="middle">
                    	<table width="128" border="0" align="right" cellpadding="2" cellspacing="2" > 
                    	<tr> 
                    		<th width="114" scope="col"><font id="cl"><strong>0</strong></font></th> 
                    	</tr> 
                    </table>
                    </td>
                    </tr>
                  <tr>
                    <td width="93%" align="right" valign="middle"><span class="Estilo6">Usuario: <?php echo "".$_SESSION["nombre"].' '.$_SESSION['apellido']; ?> - <a href="logout.php"></a></span></td>
                    <td width="7%" align="center" valign="middle"><a href="logout.php"><img src="imagenes/eqsl_exit.png" width="30" height="30" border="0" title="Salir" /></a></td>
                  </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle"><table width="100" border="0" cellspacing="0" cellpadding="0">
            <tr align="center" valign="middle">
              <td><a href="javascript:valcontactos('guardar')"><img src="imagenes/guardar.png" alt="guardar" width="32" height="32" border="0" onclick="return validarEmail(email,'email')" title="Guardar Informaci?n" /></a></td>
              <td><a href="BuscarUsuarioEditar.php" target="_parent"><img src="imagenes/buscar.png" alt="buscar" width="32" height="32" border="0" title="Buscar Usuario"/></a></td>
              <td><img src="imagenes/activar_user_opaco.png" alt="activar" width="32" height="32" border="0" /></td>
              <td><img src="imagenes/desactivar_user_opaco.png" alt="desactivar" width="32" height="32" border="0" /></td>
              <td><a href="CrearObra.php"><img src="imagenes/flecha.png" width="32" height="32" border="0" /></a></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
      </table>
      <table width="800" height="auto" border="0" cellspacing="0" cellpadding="8" style="background:url(imagenes/fondo_form.png) no-repeat;">
        <tr>
          <td align="center"><table width="783" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="819" align="center">&nbsp;</td>
              </tr>
            <tr>
              <td align="center"><table width="744" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr align="center">
                    <td width="718" height="524" valign="top">  <table width="686" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                        </tr>
                      <tr>
                        <td width="11" align="left" valign="middle">&nbsp;</td>
                        <td colspan="4" align="left">Nombre Completo</td>
                        <td width="65" align="left" valign="middle">&nbsp;</td>
                        <td colspan="2" align="left">Cargo</td>
                        </tr>
                      <tr>
                        <td width="11" align="center" valign="middle">*</td>
                        <td colspan="4" align="left"><input name="nombre" type="text" class="campos_mayus" id="nombre" onKeyPress="javascript:return Letras(event)" size="50" maxlength="50"/>
						</td>
                        <td width="65" align="right" valign="middle"><div align="right">* </div></td>
                        <td colspan="2" align="left"><input name="cargo" type="text" class="campos_mayus" id="cargo" onKeyPress="javascript:return Letras(event)" maxlength="20"/>                          
                          <div align="center"></div></td>
                        </tr>
                      <tr>
                        <td colspan="8" align="left" valign="middle">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="11" align="left" valign="middle">&nbsp;</td>
                        <td width="249" align="left">E-mail</td>
                        <td width="9" align="left">&nbsp;</td>
                        <td colspan="3" align="left">Telefono</td>
                        <td width="177" align="left">&nbsp;</td>
                        <td width="23" align="left">&nbsp;</td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">*</td>
                        <td align="left"><input name="email" type="text" id="email" size="30" maxlength="50" /></td>
                        <td align="center">*</td>
                        <td colspan="5" align="left"><input name="tarea" type="hidden" id="tarea" />
                          <input name="telefono" type="text" id="telefono" maxlength="100" class="campos_mayus" onKeyPress="javascript:return Numeros(event)"/></td>
                        </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">Celular</td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left">Fecha de Nacimiento</td>
                        <td align="left">Profesion</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left"><input name="celular" type="text"  class="campos_mayus" id="celular" onKeyPress="javascript:return Numeros(event)" maxlength="15"/></td>
                        <td align="left">&nbsp;</td>
                        <td colspan="3" align="left"><select name="dia" id="dia">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select> 
                          - 
                          <select name="mes" id="mes">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select> 
                          - 
                          <select name="anno" id="anno">
						  <?php
						  	for($i=$anno_actual; $i>=1940; $i--){
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						  	
						   ?>
                          </select></td>
                        <td align="left"><input name="profesion" type="text" class="campos_mayus" id="profesion" onKeyPress="javascript:return Letras(event)" maxlength="20"/></td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center" valign="middle">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                        <td width="83" align="left">Dia</td>
                        <td width="69" align="left"><div align="left">Mes</div></td>
                        <td align="left"><div align="left">A&ntilde;o</div></td>
                        <td align="left">&nbsp;</td>
                        <td align="left">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="8" align="center" valign="middle">&nbsp;
						</td>
                        </tr>
                    </table>
                      <table width="700" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td colspan="6" align="center"><strong>CONTACTOS</strong></td>
                          </tr>
                        <tr>
                          <td width="262" align="center">                                <input name="id" type="hidden" id="id"/></td><td width="146">&nbsp;</td>
                          <td width="115" align="center" valign="middle">&nbsp;</td>
                          <td width="177" align="center" valign="middle">&nbsp;</td>
                          </tr>
                        <tr align="center">
                          <td width="262" bgcolor="#CCCCCC">Nombre</td>
                          <td width="146" bgcolor="#CCCCCC">Cargo </td>
                          <td width="115" valign="middle" bgcolor="#CCCCCC">Telefono</td>
                          <td width="177" valign="middle" bgcolor="#CCCCCC">Email</td>
                          </tr>
                        <?php
										if(!empty($ver_contactos) && $ver_contactos == '1'){ 
											for ($i=0; $i<count($resp); $i++){
												$contacto = $resp[$i];
											?>
                        <tr align="left" class="TablaUsuarios">
                          <td width="262"><?php echo $contacto->nombre; ?></td>
                          <td width="146"><?php echo $contacto->cargo; ?></td>
                          <td width="115" align="center" valign="middle"><?php echo $contacto->telefono; ?></td>
                          <td width="177" align="center" valign="middle"><?php echo $contacto->email; ?></td>
                          </tr>
                        <?php } 
										}else{
											echo 'no hay contactos';
										}?>
                      </table>                      <p>&nbsp;</p></td>
					  
                    </tr>
                </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
</body>
</html>
<?php 
 }else{
	echo "<script>alert ('No est� autenticado en el sistema');</script>";
	echo "<script>window.location.href='index.php';</script>";
 }
?>
