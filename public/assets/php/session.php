<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../home.php");
    exit;
}

require_once '../../config/config.php';

$usuarioId = $_SESSION['usuario']['id'];
$usuarioEmail = $_SESSION['usuario']['email'];
$usuarioPerfil = $_SESSION['usuario']['perfil'] ?? null;

// Busca o perfil do usuário no banco
$stmt = $conn->prepare("SELECT perfil FROM cadastro WHERE id = ?");
$stmt->bind_param("i", $usuarioId);
$stmt->execute();
$stmt->bind_result($perfilAtual);
$stmt->fetch();
$stmt->close();

// Atualiza a sessão com perfil mais recente (útil caso tenha acabado de escolher)
if (!$usuarioPerfil && $perfilAtual) {
    $_SESSION['usuario']['perfil'] = $perfilAtual;
    $usuarioPerfil = $perfilAtual;
}

// Se receber POST para escolher perfil e não tiver perfil definido ainda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$perfilAtual) {
    $perfilEscolhido = $_POST['perfil'] ?? '';
    if (in_array($perfilEscolhido, ['domestica', 'contratante'])) {
        $upd = $conn->prepare("UPDATE cadastro SET perfil = ? WHERE id = ?");
        $upd->bind_param("si", $perfilEscolhido, $usuarioId);
        $upd->execute();
        $upd->close();

        $_SESSION['usuario']['perfil'] = $perfilEscolhido;
        header('Location: session.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spartask - Área do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/sidebar-toggle.js" defer></script>
    <link rel="stylesheet" href="../css/session.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/12a0142524.js" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>



    <div class="app-container">
        <!-- Sidebar para Desktop -->
<div class="d-flex flex-column flex-shrink-0 bg-body-tertiary sidebar sidebar-desktop"  role="navigation"
            aria-label="Menu lateral">
            <a href="" class="d-block p-3 link-body-emphasis text-decoration-none" title="Icon-only"
                data-bs-toggle="tooltip" data-bs-placement="right">      <img src="../img/logo.png" width="40" height="40">
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item">
            <a data-target="inicio" class="nav-link active py-3 border-bottom rounded-0" title="Home" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a data-target="tarefas" class="nav-link py-3 border-bottom rounded-0" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class="fa fa-dashboard"></i>
            </a>
        </li>
        <li>
            <a data-target="chat" class="nav-link py-3 border-bottom rounded-0" title="Chat" data-bs-toggle="tooltip" data-bs-placement="right">
                <i class="fa fa-users"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Products" data-bs-toggle="tooltip">
                <i class="fa fa-th-large"></i>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link py-3 border-bottom rounded-0" title="Customers" data-bs-toggle="tooltip">
                <i class="fa fa-user-circle"></i>
            </a>
        </li>
    </ul>
    <div class="dropdown border-top">
        <a href="#" class="d-flex align-items-center justify-content-center p-3 link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="logout.php" class="btn btn-danger btn-sm">Sair</a></li>
        </ul>
    </div>
</div>
<!-- Navbar Inferior para Mobile -->
<nav class="navbar navbar-expand d-md-none bg-body-tertiary fixed-bottom border-top mobile-bottom-nav">
  <ul class="navbar-nav nav-justified w-100">
    <li class="nav-item">
      <a data-target="inicio" class="nav-link text-center active">
        <i class="fa fa-home"></i><br>
        <small>Home</small>
      </a>
    </li>
    <li class="nav-item">
      <a data-target="tarefas" class="nav-link text-center">
        <i class="fa fa-dashboard"></i><br>
        <small>Dashboard</small>
      </a>
    </li>
    <li class="nav-item">
      <a data-target="chat" class="nav-link text-center">
        <i class="fa fa-users"></i><br>
        <small>Chat</small>
      </a>
    </li>
    <li class="nav-item">
      <a data-target="produtos" class="nav-link text-center">
        <i class="fa fa-th-large"></i><br>
        <small>Produtos</small>
      </a>
    </li>
    <li class="nav-item">
      <a data-target="perfil" class="nav-link text-center">
        <i class="fa fa-user-circle"></i><br>
        <small>Perfil</small>
      </a>
    </li>
  </ul>
</nav>




        <main class="container" role="main" tabindex="0">
            <!-- INÍCIO -->
            <section id="inicio" class="active">
                <h1 class="mb-4 text-center">Bem-vindo, <?= htmlspecialchars($usuarioEmail) ?>!</h1>

                <?php if (!$perfilAtual): ?>
                    <!-- Escolha de perfil -->
                    <div class="text-center mb-5">
                        <h3>Escolha seu perfil para continuar:</h3>
                        <form method="post" class="row justify-content-center mt-4">
                            <div class="col-md-4">
                                <div class="card perfil-card"
                                    onclick="document.getElementById('perfil_domestica').click();">
                                    <div class="card-body text-center">
                                        <img src="https://cdn-icons-png.flaticon.com/512/892/892781.png" alt="Doméstica"
                                            style="width:80px" />
                                        <h5 class="mt-3">Doméstica</h5>
                                        <p>Ofereça serviços domésticos e conecte-se com contratantes.</p>
                                        <input type="radio" name="perfil" value="domestica" id="perfil_domestica" required
                                            hidden />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card perfil-card"
                                    onclick="document.getElementById('perfil_contratante').click();">
                                    <div class="card-body text-center">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2913/2913461.png" alt="Contratante"
                                            style="width:80px" />
                                        <h5 class="mt-3">Contratante</h5>
                                        <p>Encontre profissionais domésticos confiáveis para o seu lar.</p>
                                        <input type="radio" name="perfil" value="contratante" id="perfil_contratante"
                                            required hidden />
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5">Confirmar Escolha</button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="alert alert-success text-center">
                        Seu perfil está definido como: <strong><?= htmlspecialchars(ucfirst($perfilAtual)) ?></strong>
                    </div>
                    <p>Use a sidebar para navegar pelas suas funcionalidades.</p>
                <?php endif; ?>
            </section>

            <!-- TAREFAS (somente para doméstica) -->
            <?php if ($perfilAtual === 'domestica'): ?>
                <section id="tarefas">
                    <?php
                    // Buscar pedidos recebidos por essa doméstica
                    $pedidosRecebidos = [];
                    $stmt = $conn->prepare("
          SELECT p.id, p.descricao, p.data_pedido, c.email AS email_contratante, p.status
          FROM pedidos p
          JOIN cadastro c ON c.id = p.id_contratante
          WHERE p.id_domestica = ?
          ORDER BY p.data_pedido DESC
        ");
                    $stmt->bind_param("i", $usuarioId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $pedidosRecebidos[] = $row;
                    }
                    $stmt->close();
                    ?>
<section class="container py-4">
    <!-- Gerenciar tarefas -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="dashboard-card p-4 shadow-sm rounded-4 bg-white">
                <h4 class="mb-4">Gerencie suas tarefas</h4>
                <form id="formTarefa">
                    <div class="mb-3">
                        <input type="text" name="titulo" placeholder="Título" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <textarea name="descricao" placeholder="Descrição" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-4">
                        <input type="date" name="data" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Adicionar tarefa</button>
                </form>
                <ul id="listaTarefas" class="list-unstyled mt-4 overflow-auto" style="max-height: 300px;"></ul>
            </div>
        </div>
    </div>

    <!-- Solicitações Recebidas -->
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card p-4 shadow-sm rounded-4 bg-white">
                <h4 class="mb-4">Solicitações Recebidas</h4>
                <div style="max-height: 300px; overflow-y: auto; padding-right: 6px;">
                    <?php if (empty($pedidosRecebidos)): ?>
                        <p class="text-muted">Nenhuma solicitação recebida até o momento.</p>
                    <?php else: ?>
                        <ul class="list-unstyled">
                            <?php foreach ($pedidosRecebidos as $pedido): ?>
                                <li class="list-group-item mb-3 border rounded-3 p-3 bg-light">
                                    <div>
                                        <strong>De:</strong> <?= htmlspecialchars($pedido['email_contratante']) ?><br>
                                        <strong>Descrição:</strong> <?= htmlspecialchars($pedido['descricao']) ?><br>
                                        <small class="text-muted">Recebido em <?= date('d/m/Y H:i', strtotime($pedido['data_pedido'])) ?></small>
                                    </div>
                                    <div class="mt-3">
                                        <?php if ($pedido['status'] === 'pendente'): ?>
                                            <button class="btn btn-success btn-sm me-2"
                                                onclick="atualizarStatus(<?= $pedido['id'] ?>, 'aceito')">Aceitar</button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="atualizarStatus(<?= $pedido['id'] ?>, 'recusado')">Recusar</button>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Status: <?= ucfirst($pedido['status']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

                <!-- CHAT (somente doméstica) -->
                <section id="chat" class="mt-4">
                    <div class="dashboard-card d-flex flex-column" style="min-height: 400px;">
                        <h5>Chat do Pedido</h5>
                        <select id="pedidoSelecionado" class="form-select mb-3" aria-label="Selecione pedido">
                            <option value="">Selecione um pedido para conversar</option>
                            <?php foreach ($pedidosRecebidos as $pedido): ?>
                                <option value="<?= $pedido['id'] ?>">Pedido #<?= $pedido['id'] ?> -
                                    <?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div id="chatContainer" class="flex-grow-1 d-flex flex-column border rounded p-3"
                            style="overflow-y: auto; background:#f9f9f9;">
                            <p class="text-muted">Selecione um pedido para carregar as mensagens.</p>
                        </div>

                        <form id="formChat" style="display:none;" class="mt-3">
                            <input type="hidden" name="pedido_id" id="pedido_id" />
                            <textarea name="mensagem" id="mensagem" class="form-control mb-2"
                                placeholder="Digite sua mensagem" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </form>
                    </div>
                </section>
            <?php endif; ?>

            <!-- Conteúdo para contratante -->
            <?php if ($perfilAtual === 'contratante'): ?>
                <section id="tarefas">
                    <?php
                    // Buscar domésticas para lista
                    $domesticas = [];
                    $stmt = $conn->prepare("SELECT id, email FROM cadastro WHERE perfil = 'domestica'");
                    $stmt->execute();
                    $res = $stmt->get_result();
                    while ($row = $res->fetch_assoc()) {
                        $domesticas[] = $row;
                    }
                    $stmt->close();

                    // Buscar pedidos feitos por esse contratante
                    $meusPedidos = [];
                    $stmt = $conn->prepare("SELECT p.id, p.descricao, p.data_pedido, c.email AS email_domestica, p.status FROM pedidos p JOIN cadastro c ON c.id = p.id_domestica WHERE p.id_contratante = ? ORDER BY p.data_pedido DESC");
                    $stmt->bind_param("i", $usuarioId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $meusPedidos[] = $row;
                    }
                    $stmt->close();
                    ?>

                    <h2>Buscar domésticas</h2>
                    <div id="listaDomesticas" class="list-group mb-3" style="max-height: 300px; overflow-y:auto;">
                        <?php if (empty($domesticas)): ?>
                            <p class="text-muted">Nenhuma doméstica cadastrada.</p>
                        <?php else: ?>
                            <?php foreach ($domesticas as $dom): ?>
                                <div class="list-group-item"><?= htmlspecialchars($dom['email']) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <h3>Fazer pedido para doméstica</h3>
                    <form id="formPedido" class="mb-5">
                        <select name="id_domestica" id="id_domestica" class="form-select mb-2" required>
                            <option value="">Selecione a doméstica</option>
                            <?php foreach ($domesticas as $dom): ?>
                                <option value="<?= $dom['id'] ?>"><?= htmlspecialchars($dom['email']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <textarea name="descricao" placeholder="Descreva o serviço desejado" class="form-control mb-2"
                            required></textarea>
                        <button type="submit" class="btn btn-primary">Enviar pedido</button>
                    </form>
                </section>

                <section id="chat" class="mt-5">
                    <h2>Meus Pedidos</h2>

                    <?php if (empty($meusPedidos)): ?>
                        <p class="text-muted">Você ainda não fez nenhum pedido.</p>
                    <?php else: ?>
                        <select id="pedidoSelecionadoContratante" class="form-select mb-3" aria-label="Selecione pedido">
                            <option value="">Selecione um pedido para conversar</option>
                            <?php foreach ($meusPedidos as $pedido): ?>
                                <option value="<?= $pedido['id'] ?>">Pedido #<?= $pedido['id'] ?> -
                                    <?= date('d/m/Y', strtotime($pedido['data_pedido'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div id="chatContainerContratante"
                            style="border: 1px solid #ccc; height: 300px; overflow-y: auto; padding: 10px; background:#fff; margin-bottom:10px;">
                            <p>Selecione um pedido para carregar as mensagens.</p>
                        </div>

                        <form id="formChatContratante" style="display:none;">
                            <input type="hidden" name="pedido_id" id="pedido_id_contratante" />
                            <textarea name="mensagem" id="mensagem_contratante" class="form-control mb-2"
                                placeholder="Digite sua mensagem" required></textarea>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    <?php endif; ?>
                </section>
            <?php endif; ?>

            <div class="mt-4">
                <form method="post" action="logout.php">
                    <button type="submit" class="btn btn-danger">Sair</button>
                </form>
            </div>
        </main>

        <?php if ($perfilAtual === 'domestica'): ?>
            <script src="../js/domestica.js"></script>
        <?php elseif ($perfilAtual === 'contratante'): ?>
            <script src="../js/contratante.js"></script>
        <?php endif; ?>

        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Ícones -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
          $(function () {
  // Sidebar e navbar mobile - troca de section
  $('.sidebar .nav-link, .mobile-bottom-nav .nav-link').click(function (e) {
    e.preventDefault();

    // Remove active de todos os botões (desktop e mobile)
    $('.sidebar .nav-link, .mobile-bottom-nav .nav-link').removeClass('active');
    $(this).addClass('active');

    // Pega o target e troca a section
    const target = $(this).data('target');
    $('main > section').removeClass('active').hide();
    $('#' + target).fadeIn(300).addClass('active');
  });
});

        </script>


</body>

</html>