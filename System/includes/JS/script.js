// /* menu lateral com setores da pag e alteração
// da posição dos elementos principais do body */

// function menu_topo(){
//     // variaveis de controle de posição
//     var div_menu = document.querySelector('.menu_topo');
//     var pos = document.querySelector('.titulos_body');

//     // variaveis de animações
//     var links_menu = document.querySelectorAll('.link_main');
//     let icon_alterado = document.querySelector('.icon_menu');
    
    
//     if( div_menu.style.height == '20%' ){     
//         icon_alterado.classList.remove('bi-arrow-bar-up');
//         icon_alterado.classList.add('bi-arrow-bar-down');
//         div_menu.style.height = '7%';
//         pos.style.top = '15.5%';

//         // for utilizado para retirar o atributo opacity em todos os elementos do array    
//         for(let i = 0; i < links_menu.length; i++){
//             links_menu[i].style.opacity = '0'; // links_fr_menu.style.opacity = '1'; links_fr_menu.style.transition = '1s';
//             links_menu[i].style.transition = '0s';
//         }        
//     }                     
//     else{
//         icon_alterado.classList.remove('bi-arrow-bar-down');
//         icon_alterado.classList.add('bi-arrow-bar-up');
//         div_menu.style.height = '20%';
//         pos.style.top = '28.5%';

//         // for utilizado para setar o atributo opacity em todos os elementos do array
//         for(let i = 0; i < links_menu.length; i++){
//             links_menu[i].style.opacity = '1'; // links_fr_menu.style.opacity = '1'; links_fr_menu.style.transition = '1s';
//             links_menu[i].style.transition = '2s'; 
//         }
//     }
// }

// funções tela de login
// função aparecer e desaparecer tela de login

function tela_login(){  
    var div_log = document.querySelector('.tela_login');

    if( div_log.style.display === 'block' ){
        div_log.style.display = 'none';
    }
    else{
        div_log.style.display = 'block';
    }
}

// função mostrar senha
function mostrar_senha(){
    let input = document.querySelector('.txt_log'); 

    if(input.getAttribute('type') == 'password'){
        input.setAttribute('type', 'text');
    }else{
        input.setAttribute('type', 'password');
    }
}

function cl_txt(){
    document.querySelector('.txt_pesq').value = '';
}