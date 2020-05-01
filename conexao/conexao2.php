<?php
function conectar(){
try{
$pdo=new PDO("mysql:host=localhost;dbname=maranhao;charset=utf8","root","");
}catch(PDOException $e){
echo $e-> getMessage();
}
return $pdo;
}
?>