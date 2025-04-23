<?php
header('Content-Type: application/json');
require 'conexao.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
    exit;
}

$nome = $data['nome'] ?? '';
$email = $data['email'] ?? '';
$telefone = $data['telefone'] ?? '';
$data_nascimento = $data['data_nascimento'] ?? '';
$sexo = $data['sexo'] ?? '';
$mensagem = $data['mensagem'] ?? '';
$termos = $data['termos'] ?? false;

if (empty($nome) || empty($email) || empty($data_nascimento) || empty($sexo) || !$termos) {
    echo json_encode(['success' => false, 'message' => 'Preencha todos os campos obrigatórios.']);
    exit;
}

try {
    $sql = "INSERT INTO contatos (nome, email, telefone, data_nascimento, sexo, mensagem, termos)
            VALUES (:nome, :email, :telefone, :data_nascimento, :sexo, :mensagem, :termos)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':telefone' => $telefone,
        ':data_nascimento' => $data_nascimento,
        ':sexo' => $sexo,
        ':mensagem' => $mensagem,
        ':termos' => $termos ? 1 : 0
    ]);

    echo json_encode(['success' => true, 'message' => 'Contato salvo com sucesso.']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao salvar contato.']);
}
?>