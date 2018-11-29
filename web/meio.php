<?php
if($type == "meio"){
$result = $db->prepare("SELECT COUNT(*) AS total FROM entidadeMeio WHERE nomeEntidade = :nomeentidade;");
$result->bindParam(':nomeentidade', $_REQUEST['nomeentidade']);
$result->execute();  
foreach($result as $row){
    if($row['total']<1){
    $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    $result->execute();
    }
}
    $result = $db->prepare("INSERT INTO meio VALUES(:numMeio, :nomeMeio, :nomeEntidade);");
    $result->bindParam(':numMeio', $_REQUEST['nummeio']);
    $result->bindParam(':nomeMeio', $_REQUEST['nomemeio']);
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    $result->execute();
}
elseif($type=='entidade'){
    $result = $db->prepare("INSERT INTO entidadeMeio VALUES(:nomeEntidade);");
    $result->bindParam(':nomeEntidade', $_REQUEST['nomeentidade']);
    $result->execute();
}
?>