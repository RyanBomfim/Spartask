<?php
session_start();
require_once 'config/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não autenticado']);
    exit;
}

$usuarioId = $_SESSION['usuario']['id'];
$usuarioPerfil = $_SESSION['usuario']['perfil'] ?? null;

$acao = $_GET['acao'] ?? '';

if ($acao === 'listar') {
    $pedidoId = intval($_GET['pedido_id'] ?? 0);
    if ($pedidoId <= 0) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Pedido inválido']);
        exit;
    }

    // Verifica se usuário pertence ao pedido (contratante ou doméstica)
    $stmt = $conn->prepare("SELECT id FROM pedidos WHERE id = ? AND (id_contratante = ? OR id_domestica = ?)");
    $stmt->bind_param("iii", $pedidoId, $usuarioId, $usuarioId);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado ao chat deste pedido']);
        exit;
    }
    $stmt->close();

    // Buscar mensagens do pedido
    $stmt = $conn->prepare("SELECT remetente, mensagem, DATE_FORMAT(data_envio, '%d/%m/%Y %H:%i') AS data_envio FROM chat_mensagens WHERE pedido_id = ? ORDER BY data_envio ASC");
    $stmt->bind_param("i", $pedidoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $mensagens = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    echo json_encode(['status' => 'sucesso', 'mensagens' => $mensagens]);
    exit;
}

if ($acao === 'enviar') {
    $pedidoId = intval($_POST['pedido_id'] ?? 0);
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($pedidoId <= 0 || empty($mensagem)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Dados inválidos']);
        exit;
    }

    // Verifica se usuário pertence ao pedido
    $stmt = $conn->prepare("SELECT id FROM pedidos WHERE id = ? AND (id_contratante = ? OR id_domestica = ?)");
    $stmt->bind_param("iii", $pedidoId, $usuarioId, $usuarioId);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Acesso negado ao chat deste pedido']);
        exit;
    }
    $stmt->close();

    // Definir remetente com base no perfil
    $remetente = ($usuarioPerfil === 'contratante') ? 'contratante' : 'domestica';

    $stmt = $conn->prepare("INSERT INTO chat_mensagens (pedido_id, remetente, mensagem, data_envio) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $pedidoId, $remetente, $mensagem);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Mensagem enviada']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Falha ao enviar mensagem']);
    }
    $stmt->close();
    exit;
}

echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
exit;
