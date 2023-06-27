<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="body-1">
    <div class="login-container">
        <h2 class="text1">OSLEC TECNOLOGY</h2>
        <form action="conexao-login.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Entrar">
            <a class="register-button" href="cadastro.php">Cadastre-se</a>
        </form>
    </div>
</body>
</html>
