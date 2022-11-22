var IDs = Array();

$(document).ready(function(){
    var data = [];

    $('#search').keyup(function(){
        var words = $('#search').val();

        if(words != ''){
            $.ajax({
                'url' : '../includes/autocompleteUsers.php',
                'method' : 'POST',
                'dataType' : 'json',
                'data' : {s : words}
            })
            .done(function(response){
                $('.results').html('');

                $.each(response, function(key, val) {
                    var listItem = '<div class="item"><img src="../IMG/' + val['imagem'] + '" width="30" height="30" style="border-radius: 50%;"> ' + 
                    val['nome'] + '<div class="botaoAdd"><button type="button" onclick="addListItem(' + val['id'] + ')" class="btnAdd btn-success">+</button></div></div>';

                    $('.results').append(listItem);
                });
            })
            .fail(function(){
                $('.results').html('');
            });
        } else{
            $('.results').html('');
        }
    });
});


function addListItem (id) {
    var stop = false;

    IDs.forEach(function equals(element) {
        if(id == element) {
            stop = true;
            return;
        }
    });

    if(stop)
        return;

    $.ajax({
        'url' : '../includes/autocompleteUsers.php',
        'method' : 'POST',
        'dataType' : 'json',
        'data' : {id : id},
        success:function(data) {
            var listItem = '<div id="line' + data['id'] + '">' +
            '<div class="user_includes">' +
                '<input type="hidden" name="ids[]" value="' + data['id'] + '">'+
                '<div class="imagem"><img src="../IMG/' + data['imagem'] + '" width="30" height="30" style="border-radius: 50%;"></div>'+
                '<div class="nome"><h5>' + data['nome'] + '</h5></div>'+
            '</div>'+
            '<div><h7>'+ data['email'] + '</h7></div>'+
            '<div class="btnExcluir"><select class="forms permissao" name="permissao[]"><option value="0" selected>Padrão</option><option value="1">Administrador</option></select>'+
            '<button type="button" onclick="removeListItem(' + data['id'] + ')" class="btn-danger" style="border-radius: 5px;">Excluir</button></div></div>';
            
            IDs.push(data['id']);

            $('.dentro_grupo').append(listItem);
        }
    })
}

function removeListItem (id) {
    var btn_id = '#line' + id;

    IDs.forEach(function equals(element) {
        if(id == element) {
            IDs.splice(IDs.indexOf(element), 1);
            return;
        }
    });

    $(btn_id).remove();
}