<!DOCTYPE html>
<html>
<head>
    <title>Estatísticas de Envio de E-mails</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-1">
    <div class="form-box">
        <h1>OSLEC TECNOLOGY - ESTATISTICAS</h1>
        <a class="register-button" href="menu.php">Voltar</a>
        <?php
        // Dados do banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cadastro";

        // Cria conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica se a conexão foi bem-sucedida
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Verifica se a tabela registro_email já existe, caso contrário, cria-a
        $sql_create_table = "CREATE TABLE IF NOT EXISTS registro_email (
            id INT AUTO_INCREMENT PRIMARY KEY,
            total_enviados INT NOT NULL
        )";
        $conn->query($sql_create_table);

        // Verifica se já existem registros na tabela, caso contrário, insere um registro inicial com total_enviados igual a zero
        $sql_check_records = "SELECT COUNT(*) AS count_records FROM registro_email";
        $result_check_records = $conn->query($sql_check_records);
        $row_check_records = $result_check_records->fetch_assoc();
        $count_records = $row_check_records["count_records"];
        if ($count_records == 0) {
            $sql_insert_initial_record = "INSERT INTO registro_email (total_enviados) VALUES (0)";
            $conn->query($sql_insert_initial_record);
        }
        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Atualiza o total_enviados na tabela registro_email
            $sql_update_total = "UPDATE registro_email SET total_enviados = total_enviados + 1";
            $conn->query($sql_update_total);
        }
        // Recupera o total_enviados da tabela registro_email
        $sql_total_enviados = "SELECT total_enviados FROM registro_email";
        $result_total_enviados = $conn->query($sql_total_enviados);
        $row_total_enviados = $result_total_enviados->fetch_assoc();
        $total_enviados = $row_total_enviados["total_enviados"];
        // Exibe o total de e-mails enviados na página HTML
        echo "<p>Total de E-mails Enviados: " . htmlspecialchars($total_enviados) . "</p>";
        $conn->close();
        ?>
    </div>
</body>
</html>
