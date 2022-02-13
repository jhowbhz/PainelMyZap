async function start(id, sessionName, sessionkey) {

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
            $(`.btn-start_${events?.session?.replace(' ', '')}`).removeClass('btn-success').addClass('btn-danger').html('Desconectar &raquo;').attr('onclick', `closeSession('${id}', '${sessionName}', '${sessionkey}')`);
        }

    })

    let body = JSON.stringify({ "id": `${id}` });
    server = `/painel/sessoes/`;
    await request(server, `iniciar`, `POST`, body, id, sessionkey, sessionName)
}

async function closeSession(id, sessionName, sessionkey) {

    HOST_MYZAP = $(`#server_${id}`).val();

    await $.post({
        url: `${HOST_MYZAP}/close`,
        method: `POST`,
        headers: {
            "Content-Type": "application/json",
            "sessionkey": `${sessionkey}`,
        },
        data: JSON.stringify({'session': `${sessionName}`}),
        beforeSend: function () {
            // pode fazer alguma ação antes de enviar a requisição
            $.LoadingOverlay("show");
        },
        success: function(callback) {
            // faz o que quiser com o callback...
            callback = JSON.stringify(callback);
            $(".modal-body").html(`<code> ${callback} </code>`);

            $.LoadingOverlay("hide");
            $("#modalSession").modal('show');
        },
        error: function(exception) {
            // trate a exception de acoroo com a situação...
            console.log(exception);
            $.LoadingOverlay("hide");
            $("#modalSession").modal('show');
            $(".modal-body").html(`<code> ${JSON.stringify(exception)} </code>`);
        },
    });

}

async function request(server, action, method, body, id, sessionkey) {
    
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
                
                console.log(callback);
                $("#situacao").attr('src', callback?.qrCode);
                $(`#situacao_${callback?.session?.replace(' ', '')}`).attr('src', `https://mir-s3-cdn-cf.behance.net/project_modules/max_632/04de2e31234507.564a1d23645bf.gif`);

                if(callback?.state == 'CONNECTED' || callback?.status == 'inChat') {
                    $(`#situacao_${callback?.session?.replace(' ', '')}`).attr('src', `https://uxwing.com/wp-content/themes/uxwing/download/34-crime-security-military-law/security.svg`);
                    $(`.session-status_${callback?.session?.replace(' ', '')}`).html(`<i class="fas fa-check-circle text-success"></i> Online!`);
                    $(`.btn-start_${callback?.session?.replace(' ', '')}`).removeClass('btn-success').addClass('btn-danger').html('Desconectar &raquo;').attr('onclick', `closeSession('${id}', '${callback?.session?.replace(' ', '')}', '${sessionkey}')`)
                }

                $.LoadingOverlay("hide");
                $("#modalSession").modal('show');
            },
            error: function(exception) {
                // trate a exception de acoroo com a situação...
                console.log(exception);
                $.LoadingOverlay("hide");
                $("#modalSession").modal('show');
                $(".modal-body").html(`<code> ${JSON.stringify(exception)} </code>`);
            },
        });
        
    } catch (error) {
        // trate o erro de acoroo com a situação...
        console.log(error);
    }
    
}
