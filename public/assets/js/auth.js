$(function () {
  console.log("auth.js carregado");

  // Cadastro
  const formCadastro = $('#formCadastro');
  if (formCadastro.length === 0) {
    console.warn("⚠️ #formCadastro não encontrado no DOM.");
  } else {
    formCadastro.submit(function (e) {
      e.preventDefault();
      console.log("➡️ Enviando cadastro...");

      $.ajax({
        url: 'assets/php/cadastro.php',
        method: 'POST',
        data: formCadastro.serialize(),
        dataType: 'json',
        success: function (res) {
          console.log("✅ Resposta do cadastro:", res);
          if (res.status === 'sucesso') {
            $('#msgCadastro').html('<div class="alert alert-success">Bem-vindo, ' + res.email + '!</div>');
            setTimeout(() => window.location.href = 'home.php', 1000);
          } else {
            $('#msgCadastro').html('<div class="alert alert-danger">' + res.mensagem + '</div>');
          }
        },
        error: function (xhr, status, error) {
          console.error("❌ Erro na requisição de cadastro:", error);
          console.error("Detalhes:", xhr.responseText);
          $('#msgCadastro').html('<div class="alert alert-danger">Erro na requisição.</div>');
        }
      });
    });
  }

  // Login
  const formLogin = $('#formLogin');
  if (formLogin.length === 0) {
    console.warn("⚠️ #formLogin não encontrado no DOM.");
  } else {
    formLogin.submit(function (e) {
      e.preventDefault();
      console.log("➡️ Enviando login...");

      $.ajax({
        url: 'assets/php/login.php',
        method: 'POST',
        data: formLogin.serialize(),
        dataType: 'json',
        success: function (res) {
          console.log("✅ Resposta do login:", res);
          if (res.status === 'sucesso') {
            $('#msgLogin').html('<div class="alert alert-success">Login realizado! Bem-vindo, ' + res.email + '.</div>');
            setTimeout(() => window.location.href = 'home.php', 1000);
          } else {
            $('#msgLogin').html('<div class="alert alert-danger">' + res.mensagem + '</div>');
          }
        },
        error: function (xhr, status, error) {
          console.error("❌ Erro na requisição de login:", error);
          console.error("Detalhes:", xhr.responseText);
          $('#msgLogin').html('<div class="alert alert-danger">Erro na requisição.</div>');
        }
      });
    });
  }
});
