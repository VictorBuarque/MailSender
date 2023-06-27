<?
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSLEC TECNOLOGY - Envio de E-mail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body-1">
    <div class="form-box">
    <h1>OSLEC TECNOLOGY</h1>
        <form action="enviar.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required maxlenght="50">
            <label for="assunto">Assunto:</label>
            <input type="text" id="assunto" name="assunto" required maxlenght="50">
            
            <label for="email">Endereço de E-mail:</label>
            <input type="email" id="email" name="email" required maxlenght="70">
            
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" required minlenght="5"></textarea>
            <label for="anexo">Anexar:</label>
            <input type="file" name="anexo">
            <button type="submit" name ="envia">Enviar Mensagem</button>
            <button type="reset">Limpar</button>
            <a class="register-button" href="menu.php"> Voltar</a>
        </form>
    </div>
</body>
</html>
