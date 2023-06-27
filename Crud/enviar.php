<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST['envia'])){
    $name = htmlentities($_POST['nome']);
    $email = htmlentities($_POST['email']);
    $subject = htmlentities($_POST['assunto']);
    $message = htmlentities($_POST['mensagem']);
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'seuemail@gmail.com';
    $mail->Password = 'suasenha';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom('seuemail@gmail.com');
    $mail->addAddress($_POST["email"]);
    $mail->Subject = $_POST["assunto"];
    $mail->Body = $_POST["mensagem"];
    
    // Processar arquivos enviados
    if(isset($_FILES['anexo']) && $_FILES['anexo']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['anexo']['tmp_name'];
        $fileName = $_FILES['anexo']['name'];
        $mail->addAttachment($fileTmpPath, $fileName);
    }
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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os valores do formulário
    $nome = $_POST['nome'];
    $assunto = $_POST['assunto'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Enviar o e-mail
    try {
        $mail->send();
        echo("<script>");
        echo("alert('E-mail enviado com sucesso!');");
        echo("document.location.href='email.php';");
        echo("</script>");
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
    }

    // Atualiza o total_enviados na tabela registro_email
    $sql_update_total = "UPDATE registro_email SET total_enviados = total_enviados + 1";
    $conn->query($sql_update_total);
}

$conn->close();
    
}

?>

