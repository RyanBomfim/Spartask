<?php
// --------------------------------------------------
// INÍCIO DA SESSÃO E REDIRECIONAMENTO SE JÁ LOGADO
// --------------------------------------------------
session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: assets/php/session.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <!-- --------------------------------------------------
       METADADOS E TÍTULO
  -------------------------------------------------- -->
  <meta charset="UTF-8" />
  <title>Spartask - Login e Cadastro AJAX</title>

  <!-- --------------------------------------------------
       ESTILOS E FONTE EXTERNA
  -------------------------------------------------- -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/session.css">
  <style>
    body {
      background-size: cover;
      margin: 0;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }
  </style>

  <!-- --------------------------------------------------
       JAVASCRIPT EXTERNO E DEPENDÊNCIAS
  -------------------------------------------------- -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/auth.js" defer></script>
</head>

<body>

  <!-- --------------------------------------------------
     CARTÃO DE AUTENTICAÇÃO
-------------------------------------------------- -->

 <div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-4 d-flex flex-column position-static"> <strong
          class="d-inline-block mb-2 text-primary-emphasis">World</strong>
        <h3 class="mb-0">Featured post</h3>
        <div class="mb-1 text-body-secondary">Nov 12</div>
        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional
          content.</p> <a href="#" class="icon-link gap-1 icon-link-hover stretched-link">
          Continue reading
          <svg class="bi" aria-hidden="true">
            <use xlink:href="#chevron-right"></use>
          </svg> </a>
      </div>
      <div class="col-auto d-none d-lg-block"> <svg aria-label="Placeholder: Thumbnail" class="bd-placeholder-img "
          height="250" preserveAspectRatio="xMidYMid slice" role="img" width="200" xmlns="http://www.w3.org/2000/svg">
          <title>Placeholder</title>
          <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
            dy=".3em">Thumbnail</text>
        </svg> </div>
    </div>
  </div>

  <div class="auth-card">
    <!-- CADASTRO -->
    <div id="cadastroView">
      <h2 class="text-center mb-4">Cadastre-se grátis</h2>
      <form id="formCadastro">
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" required />
          <label>Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="senha" class="form-control" required />
          <label>Senha</label>
        </div>
        <button class="w-100 mb-3 btn btn-lg btn-primary btn-emoji" type="submit">Cadastrar</button>
        <div id="msgCadastro" class="text-center mt-2"></div>
        <p class="text-center mt-3">Já tem uma conta? <span class="toggle-link" id="showLogin">Faça login 🔑</span></p>
      </form>
    </div>

    <!-- LOGIN -->
    <div id="loginView" style="display: none;">
      <h2 class="text-center mb-4">Faça seu login</h2>
      <form id="formLogin">
        <div class="form-floating mb-3">
          <input type="email" name="email" class="form-control" required />
          <label>Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="senha" class="form-control" required />
          <label>Senha</label>
        </div>
        <button class="w-100 mb-3 btn btn-lg btn-secondary btn-emoji" type="submit">Entrar</button>
        <div id="msgLogin" class="text-center mt-2"></div>
        <p class="text-center mt-3">Ainda não tem conta? <span class="toggle-link" id="showCadastro">Cadastre-se
            🧼</span></p>
      </form>
    </div>
  </div>

  <!-- --------------------------------------------------
     SCRIPT PARA TROCAR ENTRE LOGIN E CADASTRO
-------------------------------------------------- -->
  <script>
    $('#showLogin').click(function () {
      $('#cadastroView').hide();
      $('#loginView').fadeIn();
    });

    $('#showCadastro').click(function () {
      $('#loginView').hide();
      $('#cadastroView').fadeIn();
    });
  </script>

  <!-- --------------------------------------------------
     OBSERVADOR DE MENSAGENS (EXIBE ALERTAS)
-------------------------------------------------- -->
  <script>
    function watchMessages() {
      const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
          const target = mutation.target;
          const text = target.textContent.trim();
          if (text !== "") {
            let icon = 'info';
            const lowerText = text.toLowerCase();

            if (
              lowerText.includes('erro') ||
              lowerText.includes('já') ||
              lowerText.includes('senha') ||
              lowerText.includes('inválido') ||
              lowerText.includes('incorreto') ||
              lowerText.includes('não')
            ) {
              icon = 'error';
            } else if (
              lowerText.includes('cadastrado com sucesso') ||
              lowerText.includes('cadastro realizado') ||
              lowerText.includes('login realizado') ||
              lowerText.includes('sucesso')
            ) {
              icon = 'success';
            }

            Swal.fire({
              title: 'Spartask 🧼',
              text: text,
              icon: icon,
              confirmButtonText: 'OK'
            });

            target.textContent = ""; // Limpa para evitar alertas repetidos
          }
        });
      });

      const msgLogin = document.getElementById("msgLogin");
      const msgCadastro = document.getElementById("msgCadastro");

      if (msgLogin) observer.observe(msgLogin, { childList: true });
      if (msgCadastro) observer.observe(msgCadastro, { childList: true });
    }

    document.addEventListener("DOMContentLoaded", watchMessages);
  </script>

  <!-- --------------------------------------------------
     BOOTSTRAP JS
-------------------------------------------------- -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>