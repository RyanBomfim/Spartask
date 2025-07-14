<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'Usuário não logado']);
    exit;
}

$acao = $_GET['acao'] ?? '';

if ($acao === 'listar_domesticas') {
    $sql = "SELECT id, email FROM cadastro WHERE perfil = 'domestica'";
    $result = $conn->query($sql);

    if ($result) {
        $domesticas = [];
        while ($row = $result->fetch_assoc()) {
            $domesticas[] = $row;
        }
        echo json_encode(['status' => 'sucesso', 'domesticas' => $domesticas]);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro na consulta']);
    }
    exit;
}

if ($acao === 'fazer_pedido') {
    $idDomestica = $_POST['id_domestica'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    if (empty($idDomestica) || empty($descricao)) {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Preencha todos os campos']);
        exit;
    }

    $idContratante = $_SESSION['usuario']['id'];

    $stmt = $conn->prepare("INSERT INTO pedidos (id_contratante, id_domestica, descricao, data_pedido) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iis", $idContratante, $idDomestica, $descricao);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Pedido enviado com sucesso!']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao enviar pedido']);
    }
    $stmt->close();
    exit;
}
if ($acao === 'atualizar_status') {
    $id = $_POST['id'] ?? '';
    $status = $_POST['status'] ?? '';

    if ($status === 'aceito') {
        $codigo = rand(100000, 999999); // ou uma string aleatória
        $stmt = $conn->prepare("UPDATE pedidos SET status = ?, codigo_confirmacao = ? WHERE id = ? AND id_domestica = ?");
        $stmt->bind_param("ssii", $status, $codigo, $id, $_SESSION['usuario']['id']);
    } else {
        $stmt = $conn->prepare("UPDATE pedidos SET status = ? WHERE id = ? AND id_domestica = ?");
        $stmt->bind_param("sii", $status, $id, $_SESSION['usuario']['id']);
    }

    if ($stmt->execute()) {
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Status atualizado com sucesso']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Erro ao atualizar']);
    }
    exit;
}

if ($acao === 'validar_codigo') {
    $id = $_POST['id_pedido'] ?? '';
    $codigo = $_POST['codigo'] ?? '';

    $stmt = $conn->prepare("SELECT codigo_confirmacao FROM pedidos WHERE id = ? AND id_domestica = ?");
    $stmt->bind_param("ii", $id, $_SESSION['usuario']['id']);
    $stmt->execute();
    $stmt->bind_result($codigoCerto);
    $stmt->fetch();
    $stmt->close();

    if ($codigoCerto === $codigo) {
        $stmt = $conn->prepare("UPDATE pedidos SET status = 'concluido' WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo json_encode(['status' => 'sucesso', 'mensagem' => 'Pedido concluído com sucesso!']);
    } else {
        echo json_encode(['status' => 'erro', 'mensagem' => 'Código inválido']);
    }
    exit;
}


echo json_encode(['status' => 'erro', 'mensagem' => 'Ação inválida']);
exit;

