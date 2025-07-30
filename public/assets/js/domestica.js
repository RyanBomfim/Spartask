function atualizarStatus(id, status) {
  $.post('assets/php/contratante_busca.php?acao=atualizar_status', { id, status }, function (res) {
    if (res.status === 'sucesso') {
      Swal.fire('Sucesso', res.mensagem, 'success').then(() => location.reload());
    } else {
      Swal.fire('Erro', res.mensagem, 'error');
    }
  }, 'json');
}

function carregarTarefas() {
  $.getJSON('assets/php/domestica_tarefas.php?acao=listar', function (res) {
    if (res.status === 'sucesso') {
      let html = '';
      res.tarefas.forEach(t => {
        html += `<li>
            <div><strong>${t.titulo}</strong><br>${t.descricao}<br><small>${t.data}</small></div>
            <button class="btn btn-danger btn-sm" onclick="removerTarefa(${t.id})">Excluir</button>
          </li>`;
      });
      $('#listaTarefas').html(html);
    }
  });
}

function removerTarefa(id) {
  $.post('assets/php/domestica_tarefas.php?acao=remover', { id }, function (res) {
    alert(res.mensagem);
    carregarTarefas();
  }, 'json');
}

function carregarMensagens(pedidoId) {
  $('#chatContainer').html('<p>Carregando mensagens...</p>');
  $.getJSON('assets/php/chat.php?acao=listar&pedido_id=' + pedidoId, function (res) {
    if (res.status === 'sucesso') {
      let html = '';
      if (res.mensagens.length === 0) {
        html = '<p class="text-muted">Nenhuma mensagem ainda.</p>';
      } else {
        html = '<div style="display:flex; flex-direction: column;">';
        res.mensagens.forEach(m => {
          const classe = m.remetente === 'contratante' ? 'msg-contratante' : 'msg-domestica';
          const remetente = m.remetente === 'contratante' ? 'Contratante' : 'Doméstica';
          html += `<div class="${classe}"><strong>${remetente}</strong>: ${m.mensagem} <small>(${m.data_envio})</small></div>`;
        });
        html += '</div>';
      }
      $('#chatContainer').html(html);
      $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight);
    } else {
      $('#chatContainer').html('<p class="text-danger">Erro ao carregar mensagens.</p>');
    }
  });
}

$(function () {
  carregarTarefas();

  $('#formTarefa').submit(function (e) {
    e.preventDefault();
    $.post('assets/php/domestica_tarefas.php?acao=adicionar', $(this).serialize(), function (res) {
      alert(res.mensagem);
      if (res.status === 'sucesso') {
        $('#formTarefa')[0].reset();
        carregarTarefas();
      }
    }, 'json');
  });

  $('#pedidoSelecionado').change(function () {
    const pedidoId = $(this).val();
    if (pedidoId) {
      $('#pedido_id').val(pedidoId);
      $('#formChat').show();
      carregarMensagens(pedidoId);
    } else {
      $('#formChat').hide();
      $('#chatContainer').html('<p>Selecione um pedido para carregar as mensagens.</p>');
    }
  });

  $('#formChat').submit(function (e) {
    e.preventDefault();
    const pedidoId = $('#pedido_id').val();
    const mensagem = $('#mensagem').val().trim();

    if (!pedidoId || mensagem === '') {
      alert('Selecione um pedido e escreva uma mensagem.');
      return;
    }

    $.post('assets/php/chat.php?acao=enviar', { pedido_id: pedidoId, mensagem }, function (res) {
      if (res.status === 'sucesso') {
        $('#mensagem').val('');
        carregarMensagens(pedidoId);
      } else {
        alert('Erro: ' + res.mensagem);
      }
    }, 'json');
  });

  // Atualização automática
  setInterval(() => {
    const pedidoId = $('#pedido_id').val();
    if (pedidoId) carregarMensagens(pedidoId);
  }, 5000);
});
