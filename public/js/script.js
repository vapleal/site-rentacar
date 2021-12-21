var request;
$("#enviar").click(function(event){
    event.preventDefault();

    if(request)
    {
        request.abort();
    }

    var form = $("#registros");

    var inputs = form.find("input");

    var serializeData = form.serialize();

    alert(serializeData);
    
    request = $.ajax({
        url: "funcoes/cadusuario.php",
        type: "post",
        data: serializeData
    });

    request.done(function (response, textStatus, jqXHR)
    {
        alert(response);
        //console.log(response + ' - ' + textStatus + ' - ' + jqXHR[0]);
        window.location = "index.php";
        // aplicar na próxima aula
        //$("#RegisterModal").modal('hide');
    });

    request.fail( function (jqXHR, textStatus, errorThrown){
        alert("Erro ao cadastrar: " + textStatus, errorThrown);
    });
    
});

// Login
$("#start").click(function(event){
    event.preventDefault();

    if(request)
    {
        request.abort();
    }

    var form = $("#entrar");

    var inputs = form.find("input");

    var serializeData = form.serialize();

    request = $.ajax({
        url: "funcoes/login.php",
        type: "post",
        data: serializeData
    });

    request.done(function (response, textStatus, jqXHR)
    {
        dados = jQuery.parseJSON(response);

        if (dados.Nome == "") 
        {
            alert("Cadastro não encontrado.");
        }
        else
        {
            window.location = "http://localhost/site-rentacar/";
        }
        //console.log( dados.Nome + ' - ' + textStatus + ' - ' + jqXHR.Nome);
        //window.location = "index.php";
        // aplicar na próxima aula
        $("#LoginModal").modal('hide');
    });

    request.fail( function (jqXHR, textStatus, errorThrown){
        alert("Erro ao entrar: " + textStatus, errorThrown);
    });
});

//CEP
$("#cep").on('blur', function(event){
    event.preventDefault();
    //alert($("#cep").val());
    if(request) {
        request.abort();
    }
    var CEP = $("#cep").val();
    
    if(CEP !== "")
    {    
        request = $.ajax({
            url: "../funcoes/cep.php",
            type: "post",
            data: "cep=" + CEP
        });
        request.done(function (response, textStatus, jqXHR)
        {
            dados = jQuery.parseJSON(response);
            //alert(dados.cep);
            
            if (dados.cep == "")
            {
                alert("CEP não encontrado.");
            }
            else
            {
                if($("#endereco").val() === "")
                {
                    $("#endereco").val(dados.logradouro);
                }
                if($("#bairro").val() === "")
                {
                    $("#bairro").val(dados.bairro);
                }                
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);

            }
        });

        request.fail( function (jqXHR, textStatus, errorThrown){
            alert("Erro ao localizar CEP: " + textStatus, errorThrown);
        });
    }

});

// Botão Salvar
$("#salva").click(function(event){
    event.preventDefault();

    if(request)
    {
        request.abort();
    }
    var URL = "";
    var destino = "";
    var form = "";    

    if( $("#tpcad").val() === "veiculo")
    {
        URL = "../funcoes/veiculoVeic.php";
        destino = "formSistema.php?prl=1";
        form = new FormData($("#frmSistema")[0]);
    }

    else if( $("#tpcad").val() === "fabricante")
    {
        URL = "../funcoes/fabricanteVeic.php";
        destino = "formSistema.php?prl=2";
        form = new FormData($("#frmSistema")[0]);
    }

    else if( $("#tpcad").val() === "cor")
    {
        URL = "../funcoes/corVeic.php";
        destino = "formSistema.php?prl=3";
        form = new FormData($("#frmSistema")[0]);
    }

    else if( $("#tpcad").val() === "tipo")
    {
        URL = "../funcoes/tipoVeic.php";
        destino = "formSistema.php?prl=4";
        form = new FormData($("#frmSistema")[0]);
    }

    else if( $("#tpcad").val() === "profile")
    {
        URL = "../funcoes/cliente.php";
        destino = "formProfile.php?prl=0";
        form = new FormData($("#frmProfile")[0]);
    }

    else if( $("#tpcad").val() === "usuario")
    {
        URL = "../funcoes/cadusuario.php";
        destino = "formProfile.php?prl=1";
        form = new FormData($("#frmProfile")[0]);
    }

    request = $.ajax({
        url: URL,
        type: "post",
        processData: false, //necessário
        contentType: false, //necessário
        data: form
    });

    request.done(function (response, textStatus, jqXHR)
    {
        alert(response);
        //console.log(response + ' - ' + textStatus + ' - ' + jqXHR[0]);
        window.location = destino;
        // aplicar na próxima aula
        //$("#RegisterModal").modal('hide');
    });

    request.fail( function (jqXHR, textStatus, errorThrown){
        alert("Erro ao cadastrar: " + textStatus, errorThrown);
    });
   
});

// Botão Cancelar
$(".cancelar").click(function(event){
    if (confirm("Tem certeza que quer excluir esta informação?"))
    {
        event.preventDefault();
        var valor = $(this).val();

        if(request)
        {
            request.abort();
        }
        var URL = "../funcoes/relReserva.php";
        var destino = "formProfile.php?prl=2";

        request = $.ajax({
            url: URL,
            type: "post",
            data: "idreserva=" + valor
        });

        request.done(function (response, textStatus, jqXHR)
        {
            alert(response);
            //console.log(response + ' - ' + textStatus + ' - ' + jqXHR[0]);
            window.location = destino;
        });

        request.fail( function (jqXHR, textStatus, errorThrown){
            alert("Erro ao cadastrar: " + textStatus, errorThrown);
        });
    }
    else
    {
        return false;
    }
  
});

// Botão Reservar
$("#reservar").click(function(event){
    if (confirm("Confirma a reserva?"))
    {
        event.preventDefault();
        var valor = $(this).val();

        if(request)
        {
            request.abort();
        }

        var URL = "../funcoes/relReserva.php";
        var destino = "formProfile.php?prl=2";
        var form = new FormData($("#frmReserva")[0]);

        
        request = $.ajax({
            url: URL,
            type: "post",
            processData: false, //necessário
            contentType: false, //necessário
            data: form
        });

        request.done(function (response, textStatus, jqXHR)
        {
            alert(response);
            console.log(response + ' - ' + textStatus + ' - ' + jqXHR[0]);
            window.location = destino;
            // aplicar na próxima aula
            //$("#RegisterModal").modal('hide');
        });

        request.fail( function (jqXHR, textStatus, errorThrown){
            alert("Erro ao cadastrar: " + textStatus, errorThrown);
        });
    }
    else
    {
        return false;
    }
  
});
