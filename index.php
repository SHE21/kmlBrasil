<!--Direitos resevados 2015.Desenvolvido por Lenilson Santiago - GEOPRO E LABCOM/UMFA--->

<!DOCTYPE HTML>
<html>
<head><title>KML Busca Brasil</title>
<link href="css/style.css" rel="stylesheet" />
</head>
<body><center><img src="images/kml_source.png"/></center><br>
<form name="searcheform" method="post" action="resultado.php">
<center>
<table border="0">
<tr>
<td>
Filtro: <select name="filtro" class="filtro">
<option value="nome_municipio">Nome Município
<option value="geocodigo">Geocodigo
<option value="sigla">Estado
<option value="regiao">Região
<option value="nome_meso">Mesoregião
<option value="nome_micro">Microregião
</select>
<input class="campo"placeholder="Pesquisar" type="text" id="buscar" name="buscar"/></td>
<td valign="top"><input class="ok"type="submit" name="ok" value="Ok" class="campo_busca"></td></tr>
</table></center>
</form><P>
<CENTER><div class="copy">Desenvolvido por GEOPRO e LABCOM</div></CENTER>
</body>
</html>