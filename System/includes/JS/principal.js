// função aparecer e desaparecer tela de login
function most_log(){
    let $tela_login = document.querySelector('.tela_login');
    

    if( $tela_login.style.height == '120px' ){
        $tela_login.style.height = '0%';
        $tela_login.style.opacity = '0';        
    }else{
        $tela_login.style.height = '120px';
        $tela_login.style.opacity = '1';
    }
}

//Limpar caixa de texto de pesquisa
function cl_txt(){
    document.querySelector('.txt_pesq').value = '';
}

function btn_ver(){
    let limp = document.querySelector('.txt_pesq').value;
    if ( limp.length == '0'){ alert('caixa de pesquisa vazia!'); }
}

function most_star(){ document.querySelector('.resp').innerHTML = 'Favoritos'; } function clean_star(){ document.querySelector('.resp').innerHTML = ''; }

function most_plus(){ document.querySelector('.resp').innerHTML = 'Adicionar Eventos'; } function clean_plus(){ document.querySelector('.resp').innerHTML = ''; }

function most_chat(){ document.querySelector('.resp').innerHTML = 'Suporte'; } function clean_chat(){ document.querySelector('.resp').innerHTML = ''; }

function most_group(){ document.querySelector('.resp').innerHTML = 'Grupos'; } function clean_group(){ document.querySelector('.resp').innerHTML = ''; }

function btn_ex(principal, nome, cat, id){
    var screen = document.querySelector('.excl_screen');
    var title = document.querySelector('.titleWindow');
    var button = document.querySelector('#btnExcluir');
    var fundo = document.querySelector('.fundo');

    button.setAttribute("onclick", "btn_ex_conf(" + principal + ",'" + cat + "'," + id + ")");
    title.textContent = 'deseja excluir ' + nome + '?';
    fundo.style.opacity = '0.3';
    screen.style.display = 'block';
}

function btn_ex_conf (principal, cat, id) {
    var link = '../includes/excluir.php';

    if(principal)
        link = 'includes/excluir.php';

    $.ajax({
        'url': link,
        'method': 'POST',
        'dataType': 'json',
        'data': {cat : cat, id : id},
	     success:function(data) {
            console.log(data);
         }
    });
    
    document.location.reload(true);
}

function sair(){
    var screen = document.querySelector('.excl_screen');
    var fundo = document.querySelector('.fundo');

    fundo.style.opacity = '1';
    screen.style.display = 'none';
}

function fav(cod_evento, id_user){
    var icon_fav = document.getElementById(cod_evento);

    var favorited = icon_fav.classList.contains('bi-star-fill');

    if(favorited) {
        icon_fav.classList.remove('bi-star-fill');
        icon_fav.classList.add('bi-star');
        icon_fav.style.color = 'black';
    } else{
        icon_fav.classList.remove('bi-star');
        icon_fav.classList.add('bi-star-fill');
        icon_fav.style.color = '#f3d500';
    }
    
    var data = {favorito : favorited, cod_evento : cod_evento, id_user : id_user};

    $.ajax({
        'url' : 'Eventos/favoritar.php',
        'method' : 'POST',
        'dataType' : 'json',
        'data' : data
    });
}

// const progress_bar = document.querySelector('.scroll_bar')
// const section = document.querySelector('section')

// const animate_progress = () => {
//     let scroll_sec = section.getBoundingClientRect();
//     console.log(scroll_sec);
// }

// function progress_bar(){
//     const scroll = document.documentElement.scrollTop;
//     var altura = document.documentElement.scrollHeight - document.documentElement.clientHeight;
//     var rolagem = ( scroll / altura ) * 100;

//     document.querySelector('.scroll_progress').style.widht = rolagem + '%';
// }

// window.onscroll = function(){
//     progress_bar();
// }