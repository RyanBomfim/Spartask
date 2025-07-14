$(document).ready(function () {
  $('#formCadastro').submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: 'assets/php/cadastro.php',
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
});
