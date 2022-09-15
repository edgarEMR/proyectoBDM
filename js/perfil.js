$('#navigation').load("navbar.html");

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
    desactivarCampos();
    $("#editarUsuario").submit(function(event) {
      event.preventDefault();
  
      console.log('Entro');
      
      const toast = new bootstrap.Toast($('#liveToast'));
      toast.show();
  
      
    });
  });
  
  function verContra() {
    var contra = document.getElementById("inputContraseña");
    
    if (contra.type === "password") {
      contra.type = "text";
      document.getElementById("verIcon").className = "bi bi-eye-fill";
    } else {
      contra.type = "password";
      document.getElementById("verIcon").className = "bi bi-eye-slash-fill";
    }
  }

  function desactivarCampos() {
    document.getElementById('fileDiv').style.display = "none";
    document.getElementById('inputNombre').disabled = true;
    document.getElementById('inputApellidos').disabled = true;
    document.getElementById('inputEmail').disabled = true;
    document.getElementById('inputContraseña').disabled = true;
    document.getElementById('inputFecha').disabled = true;
    document.getElementById('inputSexo').disabled = true;
    document.getElementById('idGuardar').style.visibility = "hidden";
}

function editar()
{
    if(document.getElementById('idEditar').title === "editar"){
        
        document.getElementById('fileDiv').style.display = "flex";
        document.getElementById('inputNombre').disabled = false;
        document.getElementById('inputApellidos').disabled = false;
        document.getElementById('inputEmail').disabled = false;
        document.getElementById('inputContraseña').disabled = false;
        document.getElementById('inputFecha').disabled = false;
        document.getElementById('inputSexo').disabled = false;
        document.getElementById('idGuardar').style.visibility = "visible";
        document.getElementById('idEditar').innerHTML = "<i class='bi bi-x-circle-fill'></i>";
        document.getElementById('idEditar').title = "x";
    }
    else {
        desactivarCampos();
        document.getElementById('idEditar').innerHTML = "<i class='bi bi-pencil-fill'></i>";
        document.getElementById('idEditar').title = "editar";
        document.getElementById('inputImagenN').value = "";
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