<?php
// 1. Conectar ao banco de dados MySQL
$host = 'localhost';
$dbname = 'cadastro_usuarios';
$username = 'root'; // Usuário padrão no XAMPP
$password = '';     // Senha padrão no XAMPP é vazia

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// 2. Capturar os dados do formulário
$email = $_POST['email'];
$nome = $_POST['name'];
$sobrenome = $_POST['lastname'];
$senha = $_POST['password'];
$confirmacao_senha = $_POST['passconfirmation'];
$termos_aceitos = isset($_POST['agreement']) ? 1 : 0; // Verifica se o checkbox foi marcado

// 3. Verificar se a confirmação da senha é igual à senha
if ($senha !== $confirmacao_senha) {
    die("Erro: As senhas não coincidem!");
}

// 4. Criptografar a senha usando bcrypt
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

// 5. Preparar e executar a inserção no banco de dados
$sql = "INSERT INTO usuarios (email, nome, sobrenome, senha, termos_aceitos) 
        VALUES (:email, :nome, :sobrenome, :senha, :termos_aceitos)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':sobrenome', $sobrenome);
$stmt->bindParam(':senha', $senha_hash); // Senha criptografada
$stmt->bindParam(':termos_aceitos', $termos_aceitos);

if ($stmt->execute()) {
    echo "Usuário registrado com sucesso!";
} else {
    echo "Erro ao registrar o usuário.";
}
?>
