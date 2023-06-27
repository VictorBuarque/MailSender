<?php
// Dados do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro";

// Conectando ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verificando se os campos de e-mail e senha estão preenchidos
if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para verificar se o e-mail e a senha correspondem a um registro no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login bem-sucedido
        header("Location: menu.php"); // Redireciona para a página menu.php
        exit();
    } else {
        // Login falhou
        echo "E-mail ou senha inválidos.";
    }
}

?>
