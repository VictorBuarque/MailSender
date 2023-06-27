<?php
//--------------------------Conexão-------------------------------------
try {
    $pdo = New PDO ("mysql:dbname=cadastro;host=localhost", "root", "");
} catch (PDOException $e) { 
    echo "Error: Erro com banco de dados: " . $e->getMessage();
    
} catch (Exception $e) {
    echo "Error: Erro de conexão: " . $e->getMessage();
} 
//-------------------------Inserção-------------------------------------
//1ª Forma  INSERT
/*$res = $pdo->prepare("INSERT INTO usuarios(nome,telefone,email,senha) VALUES (:nome, :telefone,:email,:senha)");
$res->bindValue(":nome","Teste"); 
$res->bindValue(":telefone","988888888");
$res->bindValue(":email","digite um email");
$res->bindValue(":senha","teste");
$res->execute(); 

//2ª Forma INSERT
//$pdo->query("INSERT INTO usuarios(nome,telefone,email,senha) VALUES ('Paulo', '977777777','paulo@email.com','Paulo123')");

//-----------------------Delete e Update-----------------------------------------
//1ª Forma DELETE
$cmd = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
$cmd ->bindValue(":id",""); 
$cmd ->execute();

//2ª Forma DELETE
//$cmd = $pdo->query("DELETE FROM usuarios WHERE id = '2' ");

//1ª Forma UPDATE
$cmd = $pdo->prepare("UPDATE usuarios SET email = :email WHERE id = :id ");
$cmd->bindValue(":email","eunice@email.com");
$cmd ->bindValue(":id","4"); 
$cmd ->execute();

//2ª Forma UPDATE
//$cmd = $pdo->query("UPDATE usuarios SET email = 'Paulo@gmail.com' WHERE id = '4' ");

//------------------------------SELECT-----------------------------------------------
//1ª Forma SELECT - apenas 1 linha do banco de dados
$cmd=$pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
$cmd->bindValue(":id",'4');
$cmd->execute();
$resultado = $cmd->fetchAll();
$json = json_encode($resultado);
echo ($json);
//2ª Forma SELECT - todos os dados do banco de dados*/

?>