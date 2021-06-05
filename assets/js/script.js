// user search box

function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

// login form

// const form = document.querySelector(".login form"),
// continueBtn = form.querySelector(".button input"),
// errorText = form.querySelector(".error-text");

// form.onsubmit = (e)=>{
//     e.preventDefault();
// }

// continueBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "files/login.php", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//               let data = xhr.response;
//               if(data === "success"){
//                 location.href = "users.php";
//               }else{
//                 errorText.style.display = "block";
//                 errorText.textContent = data;
//               }
//           }
//       }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }

//  profile form

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

