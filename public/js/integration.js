async function start(id) {

    //servidor MYZAP
    HOST_MYZAP = $(`#server_${id}`).val();

    //inicia o socket
    const socket = io(HOST_MYZAP);

    //receivedMessage
    socket.on('events', (events) => {
        $(`#situacao_${events?.session?.replace(' ', '')}`).attr('src', events?.qrCode);
        $(`#messages_${events?.session?.replace(' ', '')}`).html(events?.message);

        console.log(events);

        if(events?.state == 'CONNECTED' || events?.status == 'inChat') {
            $(`#situacao_${events?.session?.replace(' ', '')}`).attr('src', `https://uxwing.com/wp-content/themes/uxwing/download/34-crime-security-military-law/security.svg`);
            $(`.session-status_${events?.session?.replace(' ', '')}`).html(`<i class="fas fa-check-circle text-success"></i> Online!`);
            $(`.btn-start_${events?.session?.replace(' ', '')}`).removeClass('btn-success').addClass('btn-danger').html('Desconectar &raquo;').attr('onclick', `close(${events?.session?.replace(' ', '')})`);
        }

    })

    let body = JSON.stringify({ "id": `${id}` });
    server = `/painel/sessoes/`;
    await request(server, `iniciar`, `POST`, body)
}

async function request(server, action, method, body) {
    
    try {
        await $.post({
            url: `${server}${action}`,
            method: method ?? `POST`,
            headers: {
                "Content-Type": "application/json",
            },
            data: body ?? `{}`,
            beforeSend: function () {
                // pode fazer alguma ação antes de enviar a requisição
                $.LoadingOverlay("show");
            },
            success: function(callback) {
                // faz o que quiser com o callback...
                $(".modal-body").html(`<code> ${callback} </code>`);

                callback = JSON.parse(callback);

                $("#situacao").attr('src', callback?.qrCode);
                $(`#situacao_${callback?.session?.replace(' ', '')}`).attr('src', `https://mir-s3-cdn-cf.behance.net/project_modules/max_632/04de2e31234507.564a1d23645bf.gif`);

                if(callback?.state == 'CONNECTED' || callback?.status == 'inChat') {
                    $(`#situacao_${callback?.session?.replace(' ', '')}`).attr('src', `https://uxwing.com/wp-content/themes/uxwing/download/34-crime-security-military-law/security.svg`);
                    $(`.session-status_${callback?.session?.replace(' ', '')}`).html(`<i class="fas fa-check-circle text-success"></i> Online!`);
                    $(`.btn-start_${callback?.session?.replace(' ', '')}`).removeClass('btn-success').addClass('btn-danger').html('Desconectar &raquo;').attr('onclick', `close(${callback?.session?.replace(' ', '')})`);
                }

                $.LoadingOverlay("hide");
                $("#modalSession").modal('show');
            },
            error: function(exception) {
                // trate a exception de acoroo com a situação...
                console.log(exception);
                $.LoadingOverlay("hide");
                $("#modalSession").modal('show');
                $(".modal-body").html(`<code> ${exception} </code>`);
            },
        });
        
    } catch (error) {
        // trate o erro de acoroo com a situação...
        console.log(error);
    }
    
}
