<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../config/config.php';

header('Content-Type: application/json');

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'] ?? '';

if (!$email || strlen($senha) < 4) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos.']);
    exit;
}

$stmt = $conn->prepare("SELECT id, senha, perfil FROM cadastro WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Email não cadastrado.']);
    exit;
}

$stmt->bind_result($id, $senha_bd, $perfil);
$stmt->fetch();

// Se a senha está salva em texto puro (não recomendado), compara direto
if ($senha !== $senha_bd) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Senha incorreta.']);
    exit;
}

// Salva na sessão o usuário e o perfil
$_SESSION['usuario'] = ['id' => $id, 'email' => $email];
$_SESSION['perfil'] = $perfil;

echo json_encode(['status' => 'sucesso', 'email' => $email]);
