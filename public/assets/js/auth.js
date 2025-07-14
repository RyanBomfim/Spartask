$(function () {
  $('#formCadastro').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '../php/cadastro.php',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function (res) {
        if (res.status === 'sucesso') {
          $('#msgCadastro').html('<div class="alert alert-success">Bem-vindo, ' + res.email + '!</div>');
          setTimeout(() => window.location.href = 'assets/php/session.php', 1000);
        } else {
          $('#msgCadastro').html('<div class="alert alert-danger">' + res.mensagem + '</div>');
        }
      },
      error: function () {
        $('#msgCadastro').html('<div class="alert alert-danger">Erro na requisição.</div>');
      }
    });
  });

  $('#formLogin').submit(function (e) {
    e.preventDefault();
    $.ajax({
      url: '../php/login.php',
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function (res) {
        if (res.status === 'sucesso') {
          $('#msgLogin').html('<div class="alert alert-success">Login realizado! Bem-vindo, ' + res.email + '.</div>');
          setTimeout(() => window.location.href = '../assets/php/session.php', 1000);
        } else {
          $('#msgLogin').html('<div class="alert alert-danger">' + res.mensagem + '</div>');
        }
      },
      error: function () {
        $('#msgLogin').html('<div class="alert alert-danger">Erro na requisição.</div>');
      }
    });
  });
});
