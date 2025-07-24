function carregarMensagensContratante(pedidoId) {
  $('#chatContainerContratante').html('Carregando mensagens...');
  $.getJSON('assets/php/chat.php?acao=listar&pedido_id=' + pedidoId, function (res) {
    if (res.status === 'sucesso') {
      let html = '';
      if (res.mensagens.length === 0) {
        html = '<p class="text-muted">Nenhuma mensagem ainda.</p>';
      } else {
        res.mensagens.forEach(m => {
          const classe = m.remetente === 'contratante' ? 'msg-contratante' : 'msg-domestica';
          const remetente = m.remetente === 'contratante' ? 'Contratante' : 'Doméstica';
          html += `<div class="${classe}"><strong>${remetente}</strong>: ${m.mensagem} <small class="text-muted">(${m.data_envio})</small></div>`;
        });
      }
      $('#chatContainerContratante').html(html);
      $('#chatContainerContratante').scrollTop($('#chatContainerContratante')[0].scrollHeight);
    } else {
      $('#chatContainerContratante').html('<p class="text-danger">Erro ao carregar mensagens.</p>');
    }
  });
}

$(function () {
  $('#formPedido').submit(function (e) {
    e.preventDefault();
    $.post('assets/php/contratante_busca.php?acao=fazer_pedido', $(this).serialize())
      .done(function (res) {
        if (res.status === 'sucesso') {
          Swal.fire('Pedido enviado!', res.mensagem, 'success').then(() => location.reload());
        } else {
          Swal.fire('Erro', res.mensagem, 'error');
        }
      })
      .fail(function () {
        Swal.fire('Erro', 'Falha na requisição AJAX', 'error');
      });
  });

  $('#pedidoSelecionadoContratante').change(function () {
    const pedidoId = $(this).val();
    if (pedidoId) {
      $('#pedido_id_contratante').val(pedidoId);
      $('#formChatContratante').show();
      carregarMensagensContratante(pedidoId);
    } else {
      $('#formChatContratante').hide();
      $('#chatContainerContratante').html('<p>Selecione um pedido para carregar as mensagens.</p>');
    }
  });

  $('#formChatContratante').submit(function (e) {
    e.preventDefault();
    const pedidoId = $('#pedido_id_contratante').val();
    const mensagem = $('#mensagem_contratante').val().trim();

    if (!pedidoId || mensagem === '') {
      alert('Selecione um pedido e escreva uma mensagem.');
      return;
    }

    $.post('assets/php/chat.php?acao=enviar', { pedido_id: pedidoId, mensagem }, function (res) {
      if (res.status === 'sucesso') {
        $('#mensagem_contratante').val('');
        carregarMensagensContratante(pedidoId);
      } else {
        alert('Erro: ' + res.mensagem);
      }
    }, 'json');
  });

  // Atualização automática
  setInterval(() => {
    const pedidoId = $('#pedido_id_contratante').val();
    if (pedidoId) carregarMensagensContratante(pedidoId);
  }, 5000);
});
