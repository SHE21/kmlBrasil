<?php //conexÃ£o com o banco de dados
include("../conexao/conexao2.php");
?>
<!DOCTYPE html>
<html>
<head>
<style>
body{
font-family:Arial;}
table td{background:#dedede;border:1px solid #333;font-size:13px}table td:hover{background:#f2f2f2;}
th{background:#dedede;border:1px solid #333;font-size:13px;font-weight:bold;}
</style>
<title>BUSCA BRASIL</title>
</head>

<body>
<form name="searcheform" method="post" action="resultado.php">
<center><table border="0">
<tr>
<td>
Filtro<select name="filtro">
<option value="nome_municipio">Nome Municipio
<option value="id_codigo">GEOCODIGO
<option value="sigla">Estado
<option value="regiao">Regiao
<option value="nome_meso">Mesoregiao
<option value="nome_micro">Microregiao
</select>
<input placeholder="Pesquisar" type="text" id="buscar" name="buscar" style="width:150px;"/></td>
<td valign="top"><input type="submit" name="ok" value="Ok" class="campo_busca"></td></tr>
</table></center>
</form>


<?php  
$buscar=$_POST['buscar'];
$filtro=$_POST['filtro'];
//consulta o banco de dados
$pdo=conectar();
$buscarusuario=$pdo-> prepare("SELECT DISTINCT*FROM brasil,kml_brasil WHERE $filtro LIKE '%".$buscar."%' AND brasil.geocodigo=kml_brasil.geocodigo_kml");
$buscarusuario->execute();
$total=$buscarusuario->rowCount();

echo'<div style="padding:3px;color:#808080;">Total Encontrado: '.$total.'</div>';

if($buscarusuario->rowCount() > 0){
echo '<table border="0">';
echo'<tr><th>Geocodigo</th><th>Estado</th><th>Municipio</th><th>Regiao</th><th>Meso Regiao</th><th>Micro Regiao</th></tr>';
while($registro=$buscarusuario->fetch(PDO::FETCH_ASSOC)){
echo'<tr><td>'.$registro['geocodigo'].'</td><td>'.$registro['sigla'].'</td><td>'.$registro['nome_municipio'].'</td><td>'.$registro['regiao'].'</td><td>'.$registro['nome_meso'].'</td><td>'.$registro['nome_micro'].'</td><td>'.$registro['geocodigo_kml'].'</td></tr>';
}}else{echo"dados nÃ£o encontrados";}
echo'</table>';
?>

</body>
</html>
