function contador(valor){
    var cont = valor.length;
    const limite = 200;
    document.querySelector('.desc').innerHTML = cont + '/' + limite;
}


function troca_img() {
	var prewview = document.querySelector('.prewview');
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

function setMinMaxDate (setMax, tag, dateID, value) {
	var dateInput = document.querySelector('#' + dateID);
	tag.setAttribute("value", value);

	if(setMax)
		tag.setAttribute("max", dateInput.getAttribute("value"));
	else
		tag.setAttribute("min", dateInput.getAttribute("value"));
}

function checkAll (name, checkbox) {
    var checkboxes = document.querySelectorAll("." + name);

    if(checkbox.checked == true) {
        checkboxes.forEach(function(checkInput){
            checkInput.checked = true;
        });
    } else {
        checkboxes.forEach(function(checkInput){
            checkInput.checked = false;
        });
    }
}