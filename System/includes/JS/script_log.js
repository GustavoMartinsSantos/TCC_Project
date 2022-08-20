// função de troca entre a tela primaria e secundaria 
function tr_func(){
    
    let valid = document.querySelector('.txt_boxes');
    let pry_screen = document.querySelector('.tela_login');
    let sec_screen = document.querySelector('.tela_login_2');
    
    document.addEventListener("keypress", function(e) {
        if(e.key === 'Enter') {
        
            var btn = document.querySelector("#submit");
          
          btn.click();
        
        }
      });


    if( valid.value == '' ){
        alert('Coloque um email!!!');
    }
    else{
        if( pry_screen.style.display == 'none' ){
            pry_screen.style.display = 'block';
            sec_screen.style.display = 'none';
        } else{
            pry_screen.style.display = 'none';
            sec_screen.style.display = 'block';
        }
    } 
}

// função para mostrar a senha 
function most_pass(){
    let $valid = document.querySelector('.valid');
    let $eye = document.querySelector('.bi-eye-fill');

    if( $valid.getAttribute('type') == "password"){
        $valid.setAttribute('type', 'text');
        $eye.classList.remove('bi-eye-fill');
        $eye.classList.add('bi-eye-slash-fill');
    } else{
        $valid.setAttribute('type', 'password');
        $eye.classList.remove('bi-eye-slash-fill');
        $eye.classList.add('bi-eye-fill');
    }
}