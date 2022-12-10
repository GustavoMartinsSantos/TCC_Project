function boxfocus(){
    document.querySelector('.lbSenha').style.transform = 'translateY(-20px)';
}

function boxblur(tam){
    $lbSenha = document.querySelector('.lbSenha');
    cont = tam.length

    if( cont == 0 ){ $lbSenha.style.transform = 'translateY(0px)'; }
    else{ $lbSenha.style.transform = 'translateY(-20px)'; }
}

function verSenha(){
    let input = document.querySelector('.txt_boxes');
    var icon = document.querySelector('.icon');

    if(input.getAttribute('type') == 'password') {
        input.setAttribute('type', 'text');
        icon.classList.add('bi-eye-slash-fill');
        icon.classList.remove('bi-eye-fill');
    } else {
        input.setAttribute('type', 'password');
        icon.classList.add('bi-eye-fill');
        icon.classList.remove('bi-eye-slash-fill');
    }
}

function sair(){
    var screen = document.querySelector('.excl_screen');
    var fundo = document.querySelector('.fundo');

    fundo.style.opacity = '1';
    screen.style.display = 'none';
}