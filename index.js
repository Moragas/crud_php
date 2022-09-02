var contatos = [];

function sendForm(e) {
    e.preventDefault();
    var $nome = $('#nome');
    var $email = $('#email');
    var $celular = $('#celular');
    var $id = $('#idSelected');

    //verifico se o id está preenchido, se estiver, é uma edição, se não, é um novo contato
    if(!$id.val()){
        $.ajax({
            url: "cadastro.php",
            type: "POST",
            data: {
                nome: $nome.val(),
                email: $email.val(),
                celular: $celular.val(),
                cadUsuario: 'Cadastrar'
            },
            success: function (data) {
                console.log('sucesso');
                getContatos();
                //apagando textos
                $nome.val('');
                $email.val('');
                $celular.val('');
            },
            error: function (data) {
                console.log('erro');
            }
        });
    }else{
        console.log("editar")
        $.ajax({
            url: "cadastro.php",
            type: "POST",
            data: {
                id_contatos: $id.val(),
                nome: $nome.val(),
                email: $email.val(),
                celular: $celular.val(),
                cadUsuario: 'Editar', 
            },
            success: function (data) {
                console.log('sucesso');
                getContatos();
                //apagando textos
                $nome.val('');
                $email.val('');
                $celular.val('');
                $id.val('');
                //alterando botão
                $('#submitButton').val('Cadastrar');
            },
            error: function (data) {
                console.log('erro');
            }
        });
    }
}

 $(function () {
    
    getContatos();

    //onclick do exluir
    $(document).on('click', '.excluir', function () {
        var $id = $(this).parent().attr('id');
        console.log($id);
        $.ajax({
            url: "cadastro.php",
            type: "POST",
            data: {
                "id_contatos": $id,
                "cadUsuario": 'Deletar'
            },
            success: function (data) {
                console.log('sucesso');
                getContatos();
            },
            error: function (data) {
                console.log('erro');
            }
        });
    });

    //onclick do editar
    $(document).on('click', '.editar', function () {
        var $id = $(this).parent().attr('id');
        //pego os valores do contato e jogo nos inputs
        var contato = contatos.find(function (contato) {
            return contato.id == $id;
        });
        $('#nome').val(contato.nome);
        $('#email').val(contato.email);
        $('#celular').val(contato.celular);
        $('#idSelected').val(contato.id);

        $('#submitButton').val('Editar');
    });

    //onclick do limparButton
    $('#limparButton').on('click', function () {
        $('#nome').val('');
        $('#email').val('');
        $('#celular').val('');
        $('#idSelected').val('');
        $('#submitButton').val('Cadastrar');
    });
}) 


function getContatos () {
    $.ajax({
        url: "contatos.php",
        method: 'GET',
        success: function (data) {
            if(data){
                var $response = JSON.parse(data);
                var $contatos = $('#contatos');
                $contatos.html('');
                $response.forEach(function (contato) {
                    $contatos.append(`<div id="${contato.id}">` + contato.nome + '&nbsp&nbsp&nbsp' + contato.email +  '&nbsp&nbsp&nbsp' + contato.celular + `&nbsp&nbsp&nbsp` + `<button class="editar">Editar</button>` + `&nbsp ` + `<button class="excluir">Excluir</button>` + '</div><br/>');
                });
                contatos = $response;
            }
        },
        error: function (data) {
            console.log(data)
        }
    })
}