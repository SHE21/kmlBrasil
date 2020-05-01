<!--Direitos resevados 2015.Desenvolvido por Lenilson Santiago - GEOPRO E LABCOM/UMFA--->
<?php //conexão com o banco de dados
include("conexao/conexao2.php");
?>
<!DOCTYPE html >
<html>
<head>
<title>RESULTADO BUSCA BRASIL</title>
<link href="css/style.css" rel="stylesheet" />
<script LANGUAGE="JavaScript">
function Botao1()
{
document.select.action="exportar/export.php";
document.forms.select.submit();
}
</script>

<script LANGUAGE="JavaScript">
function Botao2()
{
document.select.action="exportar/export_kml.php";
document.forms.select.submit();
}
</script>
</head>

<body>
<center><img src="images/kml_source.png"/></center><br>
<form name="searcheform" method="post" action="resultado.php">
<center><table border="0">
<tr>
<td>
Filtro: <select class="filtro" name="filtro">
<option value="nome_municipio">Nome Município
<option value="geocodigo">Geocodigo
<option value="sigla">Estado
<option value="regiao">Região
<option value="nome_meso">Mesoregião
<option value="nome_micro">Microregião
</select>
<input class="campo" placeholder="Pesquisar" type="text" id="buscar" name="buscar" style="width:150px;"/></td>
<td valign="top">
<input class="ok" type="submit" name="ok" value="Ok" class="campo_busca"></td></tr>
</table></center>
</form>

<?php 
header('Content-Type: text/html; charset=UTF-8');
$buscar=$_POST['buscar'];
$filtro=$_POST['filtro'];
//consulta o banco de dados
$pdo=conectar();
$buscarusuario=$pdo-> prepare("SELECT DISTINCT*FROM brasil,kml_brasil WHERE $filtro LIKE '%".$buscar."%' AND brasil.geocodigo=kml_brasil.geocodigo_kml");
$buscarusuario->execute();
$total=$buscarusuario->rowCount();
echo"<center>";
echo'<div style="padding:3px;color:#808080;">Total Encontrado: '.$total.'</div>';
echo'<form name="select" method="post">';
if($total >0){echo'<p><center><input class="link" type="button" onclick="Botao1()" value="Exportar em .CSV"> | <input class="link" type="button" onclick="Botao2()" value="Exportar em .KML"><p>';}
if($buscarusuario->rowCount() > 0){
echo '<div class="table_1"><table border="0">';
echo'<tr><th></th><th>Geocodigo</th><th>Estado</th><th>Munic&iacute;pio</th><th>Regi&atilde;o</th><th>Mesoregi&atilde;o</th><th>Microregi&atilde;o</th></tr>';
while($registro=$buscarusuario->fetch(PDO::FETCH_ASSOC)){
echo'
<tr><td>
<input type="checkbox" CHECKED VALUE="'.$registro['geocodigo_kml'].'" name="checke[]"/>
</td><td>'.$registro['geocodigo'].'</td><td>
'.$registro['sigla'].'</td><td>
'.$registro['nome_municipio'].'</td><td>
'.$registro['regiao'].'</td><td>
'.$registro['nome_meso'].'</td><td>
'.$registro['nome_micro'].'</td></tr>
</div>';
}}else{echo"<div style='color:red;'>Nenhum resultado encontrado para sua busca!</div>";}
if($total >0){echo'</center></table><p><input class="link" type="button" onclick="Botao1()" value="Exportar em .CSV"> | <input class="link" type="button" onclick="Botao2()" value="Exportar em .KML"></form><p>';}
?>
<BR>
<CENTER><div class="copy">Desenvolvido por GEOPRO e LABCOM</div></CENTER>
</body>
</html>
