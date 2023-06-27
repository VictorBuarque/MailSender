<?php //conexão
    require_once 'cadastroPDO.php';
    $conn = new Pessoa("cadastro", "localhost", "root","");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSLEC TECNOLOGY - CADASTRO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    // CLICK NO BOTÃO CADASTRAR OU EDITAR
    if(isset($_POST['nome'])){
     
        //-----------EDITAR: buscando dados-----------------
        if(isset($_GET['id_up']) && !empty($_GET['id_up'])){
            $id_updt = addslashes($_GET['id_up']); 
            $array = $conn->buscarDadosPessoa($id_updt);
        //----------Atualizar: atualizando dados------------
            $id_updt = addslashes($_GET['id_up']);
            $nome = addslashes(($_POST['nome']));
            $telefone = addslashes(($_POST['telefone']));
            $email = addslashes(($_POST['email']));
            $senha = addslashes(($_POST['senha']));
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha)){
            //Atualizar
               $conn -> atualizarDados($id_updt, $nome, $telefone, $email, $senha);
               header("Location: cadastro.php");
            } else {?>
                <div class="aviso">
                <img src="Assets/Img/aviso.jpeg" style="width: 50px;" alt="Aviso" />
                    <h4>Preencha os dados corretamente!</h4>
                </div>
                <?php
            }
        }
        //-----------Cadastrar: cadastro de dados----------- 
    else 
    {
        //A função addslashes vai trazer mais segurança para os dados
        $nome = addslashes(($_POST['nome']));
        $telefone = addslashes(($_POST['telefone']));
        $email = addslashes(($_POST['email']));
        $senha = addslashes(($_POST['senha']));
        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha)){
        //cadastrar
            if (!$conn -> cadastrarPessoa($nome, $telefone, $email, $senha)){
                ?>
                <div class="aviso">
                <img src="Assets/Img/aviso.jpeg" style="width: 50px;"  alt="Aviso" />
                    <h4>E-Mail já cadastrado!</h4>
                </div>
                <?php
            }
        } else {
            ?>
                <div class="aviso">
                <img src="Assets/Img/aviso.jpeg" style="width: 50px;" alt="Aviso" />
                    <h4>Preencha os dados corretamente!</h4>
                </div>
                <?php
        }
    }
}
?>
<?php
//Clicou no botão editar 
    //buscando dados
    if(isset($_GET['id_up'])){
        $id_updt = addslashes($_GET['id_up']); 
        $array = $conn->buscarDadosPessoa($id_updt);
    }
?>
    <section id="esquerda">
        <form id="form-box"action="" method="POST">
            <h2>Cadastrar Usuário</h2>
            <label for="nome">Nome</label>
            <!--SE EXISTE A VARIAVEL ARRAY É PORQUE A PESSOA CLICOU EM ATUALIZAR DADOS-->
            <input type="text" name="nome" id="nome" value="<?php if(isset($array)){echo $array['nome'];}?>">
            <label for="telefone">Telefone</label>
            <input type="text"name="telefone" id="telefone" value="<?php if(isset($array)){echo $array['telefone'];}?>">
            <label for="email">E-mail</label>
            <input type="email"name="email" id="email" value="<?php if(isset($array)){echo $array['email'];}?>">
            <label for="senha">Senha</label>
            <input type="password"name="senha" id="senha" value="<?php if(isset($array)){echo $array['senha'];}?>">
            <!-- Trocando o texto do botão com PHP -->
            <button type="submit" value="<?php if(isset($array)){echo "Atualizar";} else {echo"Cadastrar";}?>">
                <?php if(isset($array)){echo "Atualizar";} else {echo"Cadastrar";}?>
            </button>
            <a class="register-button" href="login.php"> Voltar</a>
        </form>
    </section>
    <section id="direita">
        <table id="form-box">
            <tr id="titulo">
                <td>Nome</td>
                <td>Telefone</td>
                <td>Email</td>
                <td colspan="2">Senha</td>
            </tr>
            <?php
            $dados = $conn->buscarDados();
            if(count($dados)>0) //Se tem pessoas cadastradas
            {
                for($i=0; $i<count($dados); $i++)
                {
                    echo "<tr>";
                    foreach($dados[$i] as $k => $v)
                    {
                        if($k!="id")
                        {
                            echo " <td>".$v."</td> ";
                        }
                    }
                    ?>
                    <td>
                        <a id="black" href="cadastro.php?id_up=<?php echo $dados[$i]['id']?>">Editar</a> 
                        <a id="black" href="cadastro.php?id=<?php echo $dados[$i]['id']?>">Excluir</a>
                    </td>
                    <?php
                    echo "</tr>";
                }
            }
    else{
        ?>
        </table>
    
        <div class="aviso">
        <img src="Assets/Img/aviso.jpeg" style="width: 50px;" alt="Aviso" />
            <h4>Ainda não existem pessoas cadastradas</h4>
        </div>
        <?php
        }
    ?>
    </section>
</body>
</html>
<?php
    if(isset($_GET['id'])){
        $id_user = addslashes($_GET['id']);
        $conn -> excluirPessoa($id_user);
        header("Location: cadastro.php");
    }
?>