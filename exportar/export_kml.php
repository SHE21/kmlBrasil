<!DOCTYPE HTML>
<html>
<head><title>KML Busca Brasil</title>
<link href="../css/style.css" rel="stylesheet" />
</head>
<body>
<?php
include("../conexao/conexao2.php");
/*
* Criando e exportando planilhas do Excel
* http://blog.thiagobelem.net/
*/

// Definimos o nome do arquivo que será exportado
if (!empty($_POST['checke'])) {
$queryData = implode(',', $_POST['checke']) . '';}
//consulta o banco de dados
$pdo=conectar();
$buscarusuario=$pdo-> prepare("SELECT DISTINCT*FROM brasil,kml_brasil WHERE brasil.geocodigo IN($queryData) AND brasil.geocodigo=kml_brasil.geocodigo_kml");
$buscarusuario->execute();
$total=$buscarusuario->rowCount();

// Descreve o caminho e nome do arquivo .CSV a ser gerado ou atualizado
$file_path = 'PLANILHA.kml';


// Cria uma variável dados com valor null
$dados = '<';$dados.='?xml version="1.0" encoding="utf-8" ?>
<kml xmlns="http://www.opengis.net/kml/2.2">
<Document><Folder><name>planilha kml</name>
';$dados .="\n";
while($registro=$buscarusuario->fetch(PDO::FETCH_ASSOC)){
$dados .= '<Placemark>';$dados .="\n";
$dados .='<Style><LineStyle><color>ff0000ff</color></LineStyle><PolyStyle><fill>0</fill></PolyStyle></Style>';$dados .="\n";
$dados .= '	<ExtendedData><SchemaData schemaUrl="#planilha_kml">';$dados .="\n";
$dados .= '	<SimpleData name="geocodigo">'.$registro['geocodigo'].'</SimpleData>';$dados .="\n";
$dados .= '	<SimpleData name="sigla">'.$registro['sigla'].'</SimpleData>';$dados .="\n";
$dados .= '	<SimpleData name="nome municipio">'.$registro['nome_municipio'].'</SimpleData>';$dados .="\n";
$dados .= '	<SimpleData name="região">'.$registro['regiao'].'</SimpleData>';$dados .="\n";
$dados .= '	<SimpleData name="mesoregiao">'.$registro['nome_meso'].'</SimpleData>';$dados .="\n";
$dados .= '	<SimpleData name="microregiao">'.$registro['nome_micro'].'</SimpleData>';$dados .="\n";
$dados .= '	</SchemaData></ExtendedData>';$dados .="\n";
$dados .= ''.$registro['kml'].'';$dados .="\n";
$dados .= '</Placemark>';$dados .="\n";}	

$dados .= '</Folder>';$dados .="\n";
$dados .= '<Schema name="planilha_kml" id="estados_brasil">';$dados .="\n";
$dados .= '<SimpleField name="geocodigo" type="int"></SimpleField>';$dados .="\n";
$dados .= '<SimpleField name="sigla" type="string"></SimpleField>';$dados .="\n";
$dados .= '<SimpleField name="nome_municipio" type="string"></SimpleField>';$dados .="\n";
$dados .= '<SimpleField name="regiao" type="string"></SimpleField>';$dados .="\n";
$dados .= '<SimpleField name="nome_micro" type="string"></SimpleField>';$dados .="\n";
$dados .= '</Schema>';$dados .="\n";
$dados .= '</Document></kml>';



// Verifica se vc tem permissão de leitura e escrita neste diretorio
if(fwrite($file=fopen($file_path,'w+'),$dados)) {
fclose($file);
echo "<center>Arquivo gravado com sucesso!</center><br>";


echo'<center><a class="link_2" href="PLANILHA.kml">Baixar Arquivo</a></center><br>';

} else {
echo "Problemas ao gerar o arquivo, tente novamente!";
}
?>
<CENTER><div class="copy">Desenvolvido por GEOPRO e LABCOM</div></CENTER>
</body>
</html>