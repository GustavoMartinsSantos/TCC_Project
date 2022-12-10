// função para mostrar a senha 
function most_pass(){
    let $valid = document.querySelector('.valid');
    var eye = document.querySelector('.bi-eye-fill');

    if( $valid.getAttribute('type') == "password"){
        $valid.setAttribute('type', 'text');
    } else{
        $valid.setAttribute('type', 'password');
    }
    if( eye.classList == 'bi-eye-slash-fill' ){
        eye.classList.remove('bi-eye-slash-fill');
        eye.classList.add('bi-eye-fill');
        
    }else{
        eye.classList.remove('bi-eye-fill');
        eye.classList.add('bi-eye-slash-fill');
    }
}

function setForgotPasswdLink (link) {
    var linkForgotPasswd = document.querySelector('#linkPasswd');
    var link = "../Usuario/forgotPasswd.php?email=" + link;

    linkForgotPasswd.setAttribute("href", link);
}

function boxfocus(){
    let lb_email = document.querySelector('.lb_email');
    lb_email.style.transform = 'translateY(-23px)'; 
}

function boxblur(veri){
    let lb_email = document.querySelector('.lb_email');
    var cont = veri.length
    
    if( cont == 0 ){ lb_email.style.transform = 'translateY(0px)';  }
    else{ lb_email.style.transform = 'translateY(-23px)';  }
    
    setForgotPasswdLink(veri);
}

function boxfocus1(){
    let lb_senha = document.querySelector('.lb_senha');
    lb_senha.style.transform = 'translateY(-23px)'; 
}

function boxblur1(veri){
    let lb_email = document.querySelector('.lb_senha');
    var cont = veri.length
    
    if( cont == 0 ){ lb_email.style.transform = 'translateY(0px)';  }
    else{ lb_email.style.transform = 'translateY(-23px)';  }
}

function alt_pass(){
    let senha = document.querySelector('.pass');

    if ( senha.getAttribute('type') == 'password' ){
        senha.setAttribute(('type'), 'text');
    }else{
        senha.setAttribute(('type'), 'password');
    }
}