<!DOCTYPE HTML>
<html>
<head><title>KML Busca Brasil</title>
<link href="../css/style.css" rel="stylesheet" />
</head>
<body>
<?php
header('Content-Type: text/html; charset=UTF-8');
include("../conexao/conexao2.php");
/*
* Criando e exportando planilhas do Excel
* http://blog.thiagobelem.net/
*/

// Definimos o nome do arquivo que será exportado
if (!empty($_POST['checke'])) {$queryData = implode(',', $_POST['checke']).'';}
//consulta o banco de dados
$pdo=conectar();
$buscarusuario=$pdo-> prepare("SELECT DISTINCT*FROM brasil,kml_brasil WHERE brasil.geocodigo IN($queryData) AND brasil.geocodigo=kml_brasil.geocodigo_kml");
$buscarusuario->execute();
$total=$buscarusuario->rowCount();

// Descreve o caminho e nome do arquivo .CSV a ser gerado ou atualizado
$file_path = 'planilha.csv';


// Cria uma variável dados com valor null
$dados = '';


// Informa os dados da primeira linha (cabeçalho) do arquivo .CSV a ser gerado
$dados .= "geocodigo";
$dados .="\n";


while($registro=$buscarusuario->fetch(PDO::FETCH_ASSOC)){
$dados .= '"'.$registro['geocodigo'].'","'.$registro['sigla'].'","'.$registro['nome_municipio'].'","'.$registro['regiao'].'","'.$registro['nome_meso'].'","'.$registro['nome_micro'].'","'.$registro['kml'].'",';
$dados .= "\n";}

// Verifica se vc tem permissão de leitura e escrita neste diretorio
if(fwrite($file=fopen($file_path,'w+'),$dados)) {
fclose($file);
echo "<center>Arquivo gravado com sucesso!</center><br>";
echo'<center><a class="link_2" href="planilha.csv">Baixar Arquivo</a></center><br>';

} else {
echo "<center>div style='color:red;'>Problemas ao gerar o arquivo, tente novamente!</div></center>";
}
?>
<CENTER><div class="copy">Desenvolvido por GEOPRO e LABCOM</div></CENTER>
</body>
</html>