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
    $("#registroProducto").submit(function(event) {
      event.preventDefault();
  
      console.log('Entro');
      
      const toast = new bootstrap.Toast($('#liveToast'));
      toast.show();
  
      
    });
  });

$('#customFileLangHTML').on('change',function(){
    //get the file name
    var fileName = $(this).val().replace('C:\\fakepath\\', " ");
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
    document.getElementById('inputImagenN').value = fileName;
}); 

$('#customFileLangHTML2').on('change',function(){
    //get the file name
    var fileName = $(this).val().replace('C:\\fakepath\\', " ");
    //replace the "Choose a file" label
    $(this).next('.custom-file-label').html(fileName);
    document.getElementById('inputImagenN').value = fileName;
}); 

document.getElementById("customFileLangHTML").addEventListener("change", readFile);
document.getElementById("customFileLangHTML2").addEventListener("change", readFile2);

function readFile() {
  
  if (this.files && this.files[0]) {
    
    var FR= new FileReader();
    
    FR.addEventListener("load", function(e) {
      document.getElementById("imgPrev").src = e.target.result;
    }); 
    
    FR.readAsDataURL( this.files[0] );
  }
  
}

function readFile2() {
  
    if (this.files && this.files[0]) {
      
      var FR= new FileReader();
      
      FR.addEventListener("load", function(e) {
        document.getElementById("imgPrev2").src = e.target.result;
      }); 
      
      FR.readAsDataURL( this.files[0] );
    }
    
  }