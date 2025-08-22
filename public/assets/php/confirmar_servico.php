<?php
session_start();
require_once '../../config/config.php';

$usuarioId = $_SESSION['id']; // ID do contratante logado

// Recebe dados do formulário
$pedidoId = $_POST['pedido_id'] ?? '';
$codigo = $_POST['codigo'] ?? '';

if (empty($pedidoId) || empty($codigo)) {
    echo '<div class="text-danger">Pedido ou código não informado.</div>';
    exit;
}

try {
    // Verifica se o pedido existe e pertence ao contratante
    $stmt = $conn->prepare("
        SELECT id, status, codigo_confirmacao
        FROM pedidos
        WHERE id = ? AND id_contratante = ?
    ");
    $stmt->bind_param("ii", $pedidoId, $usuarioId);
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
    $stmt->close();

    if (!$pedido) {
        echo '<div class="text-danger">Pedido não encontrado ou não pertence a você.</div>';
        exit;
    }

    if ($pedido['status'] === 'concluido') {
        echo '<div class="text-warning">Este pedido já foi concluído.</div>';
        exit;
    }

    if ($pedido['codigo_confirmacao'] !== $codigo) {
        echo '<div class="text-danger">Código de confirmação incorreto.</div>';
        exit;
    }

    // Atualiza o pedido como concluído
    $stmt = $conn->prepare("
        UPDATE pedidos
        SET status = 'concluido', concluido_em = NOW()
        WHERE id = ?
    ");
    $stmt->bind_param("i", $pedidoId);
    $stmt->execute();
    $stmt->close();

    echo '<div class="text-success">Serviço concluído com sucesso!</div>';

} catch (Exception $e) {
    echo '<div class="text-danger">Erro: ' . $e->getMessage() . '</div>';
}
?>
