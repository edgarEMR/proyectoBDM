(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

$(document).ready(function(){
  console.log('Listo');

  if (getParameterByName('error') == 1) {
    $('#liveToast > .toast-body').text("Usuario o contraseña incorrectos. Verifique su información.")
    const toast = new bootstrap.Toast($('#liveToast'));
    toast.show();
  }

  if (getParameterByName('error') == 2) {
    $('#liveToast > .toast-body').text("No se ha podido completar el registro. Vuelva a intentarlo.")
    const toast = new bootstrap.Toast($('#liveToast'));
    toast.show();
  }
});

function verContra() {
  var contra = document.getElementById("contraseña");
  
  if (contra.type === "password") {
    contra.type = "text";
    document.getElementById("verIcon").className = "bi bi-eye-fill";
  } else {
    contra.type = "password";
    document.getElementById("verIcon").className = "bi bi-eye-slash-fill";
  }
}

function verContraR() {
    var contra = document.getElementById("inputContraseña");
    
    if (contra.type === "password") {
      contra.type = "text";
      document.getElementById("verIconR").className = "bi bi-eye-fill";
    } else {
      contra.type = "password";
      document.getElementById("verIconR").className = "bi bi-eye-slash-fill";
    }
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("inputFecha").setAttribute("max", today);

$('#customFileLangHTML').on('change',function(){
    //get the file name
    var fileName = $(this).val().replace('C:\\fakepath\\', " ");
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
    document.getElementById('inputImagenN').value = fileName;
}); 

document.getElementById("customFileLangHTML").addEventListener("change", readFile);

function readFile() {
  
  if (this.files && this.files[0]) {
    
    var FR= new FileReader();
    
    FR.addEventListener("load", function(e) {
      document.getElementById("imgPrev").src = e.target.result;
    }); 
    
    FR.readAsDataURL( this.files[0] );
  }
  
}

function getParameterByName(name, url = window.location.search) {
  name = name.replace(/[\[\]]/g, '\\$&');
  var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
      results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return '';
  return decodeURIComponent(results[2].replace(/\+/g, ' '));
}