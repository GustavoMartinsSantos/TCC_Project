const regex = /\W|_/;
const maisc = /[A-Z]/;
const numb = /\d+/;

function nivelSenha(senha){
    let saida = document.querySelector('.internal_div');
    var veri = senha;
    let cont = 0;

    if ( regex.test(veri) == true ){ cont++; }
    if ( veri.length >= 8 ){ cont++; }
    if( maisc.test(veri) == true ){ cont++; }
    if( numb.test(veri) == true ){ cont++ }

    switch(cont){
        case 1: 
            saida.style.width = '25%';
            saida.style.background = '#f9004c';
        break;
        
        case 2: 
            saida.style.width = '50%';
            saida.style.background = '#fdc300';
        break;

        case 3: 
            saida.style.width = '75%';
            saida.style.background = '#06edac';
        break;
        
        case 4: 
            saida.style.width = '100%';
            saida.style.background = '#006de1';
        break;    

        default:
            saida.style.width = '0%';
        break;
    }
}

function conf() {
    const senha = document.querySelector('.txt_box');
    const senha1 = document.querySelector('.txt_box1');

    if(senha.value === senha1.value)
       senha1.setCustomValidity('');
    else
        senha1.setCustomValidity('As senhas não conferem!!!');
}

function verSenha(){
    let input = [document.querySelector('.txt_box'), document.querySelector('.txt_box1')];
    var icon = document.querySelector('.icon');

    input.forEach(input => {
        if(input.getAttribute('type') == 'password') {
            input.setAttribute('type', 'text');
            icon.classList.add('bi-eye-slash-fill');
            icon.classList.remove('bi-eye-fill');
        } else {
            input.setAttribute('type', 'password');
            icon.classList.add('bi-eye-fill');
            icon.classList.remove('bi-eye-slash-fill');
        } 
    });
}