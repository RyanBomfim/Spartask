<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config/config.php';

header('Content-Type: application/json');

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = $_POST['senha'] ?? '';

if (!$email || strlen($senha) < 4) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos.']);
    exit;
}

$check = $conn->prepare("SELECT id FROM cadastro WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Email já cadastrado.']);
    exit;
}

// Salva senha em texto puro (NÃO RECOMENDADO)
$insert = $conn->prepare("INSERT INTO cadastro (email, senha) VALUES (?, ?)");
$insert->bind_param("ss", $email, $senha);

if ($insert->execute()) {
    $_SESSION['usuario'] = [
        'id' => $insert->insert_id,
        'email' => $email
    ];
    echo json_encode(['status' => 'sucesso', 'email' => $email]);
} else {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao cadastrar.']);
}
