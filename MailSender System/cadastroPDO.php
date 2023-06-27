<?php
class Pessoa {
    private $_pdo;
    // Conectar banco de dados
    public function __construct($dbname, $host, $user, $senha) {
        try {
            $this->_pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
        } catch (PDOException $e) {
            echo "Error: Erro com banco de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Error: Erro de conexão: " . $e->getMessage();
            exit();
        }
    }
    // Selecionar dados
    public function buscarDados() {
        $array = array();
        $cmd = $this->_pdo->query("SELECT * FROM usuarios ORDER BY nome");
        $array = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $array;
    }
    //Cadastro de usuarios
    public function cadastrarPessoa($nome,$telefone,$email,$senha){
        //Antes de cadastrar verificar email cadastrado.
        $cmd = $this->_pdo->prepare("SELECT id FROM usuarios WHERE email=:email");
        $cmd -> bindValue(':email',$email);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            // Email já cadastrado
            return false;
        } else {
            // Email não cadastrado, realizar o cadastro
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT); // Gerar o hash da senha
            
            $cmd = $this->_pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) 
                VALUES(:nome, :telefone, :email, :senha)");
            $cmd->bindValue(':nome', $nome);
            $cmd->bindValue(':telefone', $telefone);
            $cmd->bindValue(':email', $email);
            $cmd->bindValue(':senha', $hashSenha); // Armazenar o hash da senha
            $cmd->execute();
            
            return true;
        }
    }
    //Exclusão de usuario
    public function excluirPessoa($id){
        $cmd = $this->_pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $cmd ->bindValue(":id", $id); 
        $cmd ->execute();
    }
    //Buscar dados
    public function buscarDadosPessoa($id){
        $array = array();
        $cmd = $this->_pdo->prepare("SELECT * FROM usuarios WHERE id=:id");
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $array = $cmd->fetch(PDO::FETCH_ASSOC);
        return $array;
    }
    //Atualizar dados
    public function atualizarDados($id, $nome, $telefone, $email, $senha){
        //Atualizar dados
            $cmd = $this->_pdo->prepare("UPDATE usuarios SET nome = :nome, telefone=:telefone,
            email = :email, senha = :senha WHERE id = :id ");
            $cmd -> bindValue(':nome',$nome);
            $cmd -> bindValue(':telefone',$telefone);
            $cmd -> bindValue(':email',$email);
            $cmd -> bindValue(':senha',$senha);
            $cmd ->bindValue(":id",$id); 
            $cmd ->execute();  
        }
    public function buscarDadosPessoaPorEmail($email) {
            $cmd = $this->_pdo->prepare("SELECT email, senha FROM usuarios WHERE email = :email");
            $cmd->bindValue(":email", $email);
            $cmd->execute();
            $result = $cmd->fetch(PDO::FETCH_ASSOC);
            return $result; // Retorna um array associativo com o e-mail e o hash da senha encontrados
        }
    }
?>