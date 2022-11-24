
//evento que altera as duas caixas de password para a visualização da senha
//caixa de password
function troca() {
    let passw = document.querySelector('.senha');
    let conf_passw = document.querySelector('.senha1');

    if(passw.getAttribute('type') == 'password') {
        passw.setAttribute('type', 'text');
	    conf_passw.setAttribute('type', 'text');
    } else {
        passw.setAttribute('type', 'password');
	    conf_passw.setAttribute('type', 'password');
    }
}

 //evento que conferem se as senhas possuem o mesmo valor
function conf() {
     const senha = document.querySelector('.senha');
     const senha1 = document.querySelector('.senha1');

     if(senha.value === senha1.value)
        senha1.setCustomValidity('');  
     else
        senha1.setCustomValidity('As senhas não conferem!!!');
}

 //troca de imagem de perfil
function troca_img() {
	var prewview = document.querySelector('.user_cad_img');
	var file = document.querySelector('input[type=file]').files[0];
	var reader = new FileReader();
	
	reader.onloadend = function () {
		prewview.src = reader.result;
	}
	
	if(file)
		reader.readAsDataURL(file);
	else
		file;
}

 //opção caso o usuário deseja que seu login seja lembrado
 //projeto a ser iniciado
  document.cookie = "input[name=[user]]";