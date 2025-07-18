<?php
// --------------------------------------------------aaaa
// INÍCIO DA SESSÃO E REDIRECIONAMENTO SE JÁ LOGADOaaaaaaaaaaaaaa
// --------------------------------------------------a
session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: home.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- =========================================
  🔧 Configurações Básicas da Página
  ========================================== -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- =========================================
  🎨 Estilos e Ícone da Página
  ========================================== -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon" />
  <link rel="stylesheet" href="assets/css/session.css">


  <!-- --------------------------------------------------
       JAVASCRIPT EXTERNO E DEPENDÊNCIAS
  -------------------------------------------------- -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/auth.js" defer></script>

  <!-- =========================================
  🧩 Bibliotecas e Frameworks
  ========================================== -->
  <!-- Bootstrap CSS e JS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
    defer></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/12a0142524.js" crossorigin="anonymous" defer></script>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- =========================================
  📝 Título e Estilo Rápido
  ========================================== -->
  <title>Home | SparTask</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>
</head>

<body>
  <!-- =========================================
  🔝 Cabeçalho Fixo
  ========================================== -->
  <div class="bg-personality">
    <header id="header" class="header d-flex align-items-center fixed-top">
      <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-end">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <img src="assets/img/logo.png" alt="logo" />
        </a>

        <nav id="navmenu" class="navmenu">
          <ul style="margin-right: 20px;">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="about.php">Sobre</a></li>
            <li><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Cadastre-se
              </button></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
      </div>
    </header>

    <!-- Espaço para compensar o header fixo -->
    <div style="height: 70px;"></div>

    <!-- =========================================
  📘 Seção Principal / Banner
  ========================================== -->
    <section class="primary text-white position-relative overflow-hidden">
      <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center text-center py-5">
        <h1 class="display-4 fw-bold mb-4 text-white">
          Serviços domésticos para <br />
          <span class="text-primary">todos!</span>
        </h1>

        <p class="lead mb-4 col-lg-8 text-white">
          O melhor website para serviços domésticos, sendo rápido, prático e fácil de
          utilizar! Ache os melhores profissionais da sua região ou trabalhe com a
          SparTask.
        </p>

        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-primary btn-lg px-4" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Ache já perto de você
          </button>
          <button type="button" class="btn btn-outline-light btn-lg px-4">
            Trabalhe conosco
          </button>
        </div>
      </div>
  </div>

  <!-- Cards -->
  <div class="container px-4 py-5 text-dark">
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
      <!-- CARD 1 -->
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white rounded-4 shadow-lg position-relative bg-dark"
          style="
              background-image: url('assets/img/card2.png');
              background-size: cover;
              background-position: center;
            ">
          <div class="overlay-dark"></div>
          <div class="d-flex flex-column h-100 p-5 pb-3 z-1 position-relative">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
              Ache já perto de você
            </h3>
          </div>
        </div>
      </div>

      <!-- CARD 2 -->
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white rounded-4 shadow-lg position-relative bg-dark"
          style="
              background-image: url('assets/img/card3.png');
              background-size: cover;
              background-position: center;
            ">
          <div class="overlay-dark"></div>
          <div class="d-flex flex-column h-100 p-5 pb-3 z-1 position-relative">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
              Mais seguro, mais prático e mais rápido
            </h3>
          </div>
        </div>
      </div>

      <!-- CARD 3 -->
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-white rounded-4 shadow-lg position-relative bg-dark"
          style="
              background-image: url('assets/img/card4.png');
              background-size: cover;
              background-position: center;
            ">
          <div class="overlay-dark"></div>
          <div class="d-flex flex-column h-100 p-5 pb-3 z-1 position-relative">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
              O serviço que você precisa <br /> na sua <br /> mão
            </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>

  <!-- =========================================
  📣 Seção Juntar-se
  ========================================== -->
  <section class="bg-primary">
    <div class="container-fluid bg-primary">
      <div class="row text-white p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
          <h1 class="display-4 fw-bold lh-1 text-white">Quer se juntar?</h1>
          <p class="lead text-white">
            Aqui você encontra facilidade de divulgar seu serviço e um lugar seguro para administrar seus
            trabalhos feitos e renda feita com eles, com um design fácil e acessível, além de ter o histórico dos
            seus
            serviços
            e o valor de cada um, não perca tempo e comece já a ter seu trabalho facilitado pela SparTask.
          </p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
            <button type="button" class="btn btn-outline-light btn-lg px-4 me-md-2 fw-bold">
              Começar agora!
            </button>
          </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
          <img class="rounded-lg-3" src="assets/img/banner.png" alt="Banner SparTask" width="720" />
        </div>
      </div>
    </div>
  </section>

  <!-- Espaço extra -->
  <div class="br">
    <br /><br /><br /><br />
  </div>

  <!-- =========================================
  📍 Seção Profissionais e Clientes
  ========================================== -->
  <div class="container py-4">
    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Está procurando profissionais?</h2>
          <p class="text-white">
            Aqui em nosso site você irá achar os mais bem avaliados da sua região e
            poderá se conectar com eles direto no site. Clique abaixo.
          </p>
          <button class="btn btn-outline-light" type="button">Veja já!</button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-body-tertiary border rounded-3">
          <h2>Procura novos clientes?</h2>
          <p>
            Com a SparTask você se conectará com diversos clientes e aumentará sua visibilidade,
            além de
            um local organizado e com uma gestão fácil dos seus serviços prestados.
          </p>
          <button class="btn btn-outline-secondary" type="button">Comece já!</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Espaço extra -->
  <div class="br">
    <br /><br /><br />
  </div>

  <!-- =========================================
  ⭐ Seção Qualidades
  ========================================== -->
  <section>
    <div class="container px-4 py-5" id="featured-3">
      <h2 class="pb-2 border-bottom">Aqui você encontra:</h2>
      <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
          <div
            class="feature-icon d-inline-flex align-items-center rounded-3 justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
            <i class="fa fa-user text-white" style="margin: 10px;" width="1em" height="1em"></i>
          </div>
          <h3 class="fs-2 text-body-emphasis">Facilidade</h3>
          <p>
            Com apenas alguns cliques já é possível achar um profissional qualificado e com a possibilidade
            para negociar com o mesmo.
          </p>
        </div>

        <div class="feature col">
          <div
            class="feature-icon d-inline-flex rounded-3 align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
            <i class="fa fa-comment text-white" style="margin: 10px;" width="1em" height="1em"></i>
          </div>
          <h3 class="fs-2 text-body-emphasis">Confiança</h3>
          <p>
            Aqui nós possibilitamos o método de avaliação do profissional, ficando visível para todos os
            usuários, com comentários sobre o mesmo.
          </p>
        </div>

        <div class="feature col">
          <div
            class="feature-icon d-inline-flex align-items-center justify-content-center rounded-3 text-bg-primary bg-gradient fs-2 mb-3">
            <i class="fa fa-dashboard text-white" style="margin: 10px;" width="1em" height="1em"></i>
          </div>
          <h3 class="fs-2 text-body-emphasis">Dashboard</h3>
          <p>
            Quer gerir seus serviços? aqui você pode com nosso dashboard onde terá todos os serviços feitos por você
            e seus respectivos valores.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Espaço extra -->
  <div class="br">
    <br />
  </div>

  <!-- =========================================
  📢 Seção Buscar Profissionais
  ========================================== -->
  <section class="bg-primary" style="width: 100%">
    <div class="px-4 pt-5 my-5 text-center border-bottom">
      <h1 class="display-4 fw-bold text-white">
        Ache agora seus <b class="text-warning">profissionais</b>
      </h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4 text-white">
          Ache o profissional mais próximo de você que pode atingir suas demandas,
          converse e agende já sua visita com algum dos nossos profissionais disponíveis no momento que melhor
          atende
          suas necessidades.
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <button type="button" class="btn btn-warning text-white btn-lg px-4 me-sm-3">
            Ache agora!
          </button>
        </div>
      </div>
      <div class="overflow-hidden" style="max-height: 30vh">
        <div class="container px-5">
          <img src="assets/img/banner.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Banner SparTask"
            width="700" height="500" loading="lazy" />
        </div>
      </div>
    </div>
  </section>

  <!-- Espaço extra -->
  <div class="br">
    <br />
  </div>
  <!-- =========================================
Seção: Newsletter + Depoimentos + FAQ
========================================== -->
  <section class=" py-5">
    <div class="container">


      <!-- Depoimentos -->
      <h2 class="text-center fw-bold mb-4"> O que dizem sobre nós</h2>
      <div class="row g-4 mb-5 ">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-lg bg-white rounded-4">
            <div class="card-body position-relative">
              <i class="bi bi-chat-left-quote-fill text-warning fs-2 mb-3"></i>
              <p class="card-text fst-italic">"Achei o profissional perfeito para minha casa, super recomendo!"</p>
            </div>
            <div class="card-footer border-0 bg-transparent text-end fw-semibold text-primary">Maria Silva</div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-lg bg-white rounded-4">
            <div class="card-body position-relative">
              <i class="bi bi-chat-left-quote-fill text-warning fs-2 mb-3"></i>
              <p class="card-text fst-italic">"A plataforma facilitou muito meu trabalho, com organização e
                agilidade."
              </p>
            </div>
            <div class="card-footer border-0 bg-transparent text-end fw-semibold text-primary">João Pereira</div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card h-100 border-0 shadow-lg bg-white rounded-4">
            <div class="card-body position-relative">
              <i class="bi bi-chat-left-quote-fill text-warning fs-2 mb-3"></i>
              <p class="card-text fst-italic">"Atendimento rápido e profissionais de qualidade, parabéns SparTask."
              </p>
            </div>
            <div class="card-footer border-0 bg-transparent text-end fw-semibold text-primary">Ana Costa</div>
          </div>
        </div>
      </div>


      <!-- FAQ -->
      <div class="mt-5 ">
        <h2 class="text-center fw-bold mb-4" style="margin-top: 200px;"> Perguntas Frequentes</h2>
        <div class="accordion" id="faqAccordion" role="tablist">

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne">
                Como faço para contratar um profissional?
              </button>
            </h2>
            <div id="faqCollapseOne" class="accordion-collapse collapse " aria-labelledby="faqHeadingOne"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Basta criar uma conta, buscar o profissional desejado na sua região e enviar uma proposta
                diretamente
                pela plataforma.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo">
                Como me cadastrar como prestador de serviços?
              </button>
            </h2>
            <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Clique no botão "Cadastre-se", preencha suas informações e aguarde a aprovação para começar a
                receber
                pedidos.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree">
                Posso gerenciar meus serviços e pagamentos pela plataforma?
              </button>
            </h2>
            <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Sim! Você terá acesso a um dashboard completo para acompanhar serviços, clientes e pagamentos.
              </div>
            </div>
          </div>

          <!-- Novas perguntas -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseFour" aria-expanded="false" aria-controls="faqCollapseFour">
                A plataforma é gratuita?
              </button>
            </h2>
            <div id="faqCollapseFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Sim! Criar conta e buscar profissionais é totalmente gratuito. Algumas funcionalidades premium podem
                ser
                oferecidas no futuro.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseFive" aria-expanded="false" aria-controls="faqCollapseFive">
                Como funciona a aprovação dos prestadores?
              </button>
            </h2>
            <div id="faqCollapseFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Após o cadastro, nossa equipe analisa os dados enviados para garantir qualidade e segurança. Você
                será
                notificado por e-mail assim que for aprovado.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeadingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#faqCollapseSix" aria-expanded="false" aria-controls="faqCollapseSix">
                Posso editar meu perfil e serviços oferecidos?
              </button>
            </h2>
            <div id="faqCollapseSix" class="accordion-collapse collapse" aria-labelledby="faqHeadingSix"
              data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Sim, você pode atualizar seu perfil, fotos, descrição dos serviços e valores sempre que quiser no
                seu
                painel.
              </div>
            </div>
          </div>

        </div>


        <!-- Newsletter -->
        <div class="text-center mb-5" style="margin-top: 200px;">
          <h2 class="fw-bold mb-3">🎉 Quer receber novidades?</h2>
          <p class="lead text-muted mb-4">Assine para receber atualizações, promoções e novidades exclusivas da
            <strong>SparTask</strong>.
          </p>
          <form class="row justify-content-center g-2 needs-validation" novalidate>
            <div class="col-sm-6 col-md-5 col-lg-4">
              <input type="email" class="form-control form-control-lg rounded-pill shadow-sm"
                placeholder="Seu melhor e-mail" required>
              <div class="invalid-feedback text-start">Insira um e-mail válido.</div>
            </div>
            <div class="col-auto">
              <button type="submit"
                class="btn btn-warning btn-lg px-4 rounded-pill text-white shadow-sm">Inscrever-se</button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </section>

  <script>
    // Validação simples do formulário da newsletter
    (() => {
      'use strict';
      const form = document.querySelector('section.bg-light form');
      form.addEventListener('submit', e => {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
        }
        form.classList.add('was-validated');
      });
    })();
  </script>

  <!-- Espaço extra -->
  <div class="br">
    <br />
  </div>

  <!-- =========================================
  📢 Rodapé (Footer)
  ========================================== -->
  <footer class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center border-top pt-4">
      <p class="col-md-4 mb-0 text-body-secondary">SparTask &copy; 2025</p>

      <a href="/"
        class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <img class="bi me-2" width="40" height="40" src="assets/img/logo.png" />
      </a>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3">
          <a class="text-body-secondary" href="#" aria-label="Instagram">
            <i class="fa fa-instagram" style="font-size: 30px"></i>
          </a>
        </li>
        <li class="ms-3">
          <a class="text-body-secondary" href="#" aria-label="WhatsApp">
            <i class="fa fa-whatsapp" style="font-size: 30px"></i>
          </a>
        </li>
      </ul>
    </div>
  </footer>


  <!-- =========================================
  📢 Modal de Cadastro
  ========================================== -->
<!-- Firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>

<!-- Modal Cadastro/Login -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Cadastre-se grátis</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-5 pt-0">
        <!-- Formulário padrão -->
        <div class="auth-card">
          <div id="cadastroView">
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
              <p class="text-center mt-3">Ainda não tem conta? <span class="toggle-link" id="showCadastro">Cadastre-se 🧼</span></p>
            </form>
          </div>
        </div>

        <small class="text-body-secondary">Ao se cadastrar, você aceita todos os termos.</small>
        <hr class="my-4" />

        <h2 class="fs-5 fw-bold mb-3">Ou entre com sua conta Google</h2>
        <button onclick="loginGoogle()" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="button">
          <i class="fa fa-google me-2" style="font-size: 15px;"></i>
          Entrar com Google
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal de Cadastro/Login com Firebase Google Auth -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <h1 class="fw-bold mb-0 fs-2">Cadastre-se grátis</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-5 pt-0">
        <!-- ÁREA DE CADASTRO -->
        <div id="cadastroView">
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

        <!-- ÁREA DE LOGIN -->
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
            <p class="text-center mt-3">Ainda não tem conta? <span class="toggle-link" id="showCadastro">Cadastre-se 🧼</span></p>
          </form>
        </div>

        <small class="text-body-secondary">Ao se cadastrar, você aceita todos os termos.</small>
        <hr class="my-4" />
        <h2 class="fs-5 fw-bold mb-3">Ou entre com</h2>

        <!-- BOTÃO GOOGLE FUNCIONAL -->
       <button onclick="loginGoogle()" class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3">
  <i class="fa fa-google me-2" style="font-size: 15px;"></i>
  Entrar com Google
</button>

      </div>
    </div>
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



  <!-- =========================================
  📜 Script JS personalizado
  ========================================== -->
  <script src="assets/js/script.js" defer></script>

  <!-- Firebase JS SDK (compatível com HTML puro) -->
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-auth-compat.js"></script>
<script>
  // Config Firebase
  const firebaseConfig = {
    apiKey: "AIzaSyAt5LHSo2KOhxLgImJW1VJkYIEDwkt16Qc",
    authDomain: "spartask-14572.firebaseapp.com",
    projectId: "spartask-14572",
    storageBucket: "spartask-14572.firebasestorage.app",
    messagingSenderId: "689319831698",
    appId: "1:689319831698:web:7b771ba5976c81403e1e4b",
    measurementId: "G-QX079ZF105"
  };

  firebase.initializeApp(firebaseConfig);
  const auth = firebase.auth();

  function loginGoogle() {
    const provider = new firebase.auth.GoogleAuthProvider();

    auth.signInWithPopup(provider)
      .then(result => {
        const user = result.user;
        const email = user.email;
        const nome = user.displayName;

        // ⚠️ Gera uma senha padrão aleatória ou fixa (já que o Firebase não fornece)
        const senhaFake = "GoogleLogin123"; // Pode ser criptografada no PHP também

        // Preencher o formulário de login automático
        document.getElementById('loginView').style.display = 'block';
        document.getElementById('cadastroView').style.display = 'none';

        document.querySelector('#formLogin input[name="email"]').value = email;
        document.querySelector('#formLogin input[name="senha"]').value = senhaFake;

        // Submeter o formulário de login
        setTimeout(() => {
          document.getElementById('formLogin').submit();
        }, 500);

      })
      .catch(error => {
        console.error("Erro no login Google:", error);
        alert("Erro ao fazer login com Google: " + error.message);
      });
      $('#formLogin').submit();

  }

  // Alternância manual
  document.getElementById('showLogin').addEventListener('click', () => {
    document.getElementById('cadastroView').style.display = 'none';
    document.getElementById('loginView').style.display = 'block';
  });

  document.getElementById('showCadastro').addEventListener('click', () => {
    document.getElementById('loginView').style.display = 'none';
    document.getElementById('cadastroView').style.display = 'block';
  });

</script>


</body>

</html>
