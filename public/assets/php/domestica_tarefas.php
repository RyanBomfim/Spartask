<?php
session_start();
if (!isset($_SESSION['usuario']) || ($_SESSION['perfil'] ?? '') !== 'domestica') {
    http_response_code(403);
    echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado']);
    exit;
}
require_once '../config/config.php';
header('Content-Type: application/json');

$id_domestica = $_SESSION['usuario']['id'];

$acao = $_GET['acao'] ?? '';

if ($acao === 'listar') {
    $stmt = $conn->prepare("SELECT id, titulo, descricao, data, concluido FROM tarefas_domestica WHERE id_domestica = ? ORDER BY data ASC");
    $stmt->bind_param("i", $id_domestica);
    $stmt->execute();
    $result = $stmt->get_result();
    $tarefas = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['status' => 'sucesso', 'tarefas' => $tarefas]);
    exit;
}

if ($acao === 'adicionar') {
    $titulo = $_POST['titulo'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $data = $_POST['data'] ?? null;

    if (!$titulo || !$data) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Título e data são obrigatórios']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO tarefas_domestica (id_domestica, titulo, descricao, data) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id_domestica, $titulo, $descricao, $data);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Tarefa adicionada']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao adicionar tarefa']);
    }
    exit;
}

if ($acao === 'remover') {
    $id_tarefa = intval($_POST['id'] ?? 0);
    if ($id_tarefa <= 0) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'ID inválido']);
        exit;
    }
    $stmt = $conn->prepare("DELETE FROM tarefas_domestica WHERE id = ? AND id_domestica = ?");
    $stmt->bind_param("ii", $id_tarefa, $id_domestica);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Tarefa removida']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao remover tarefa']);
    }
    exit;
}

echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
