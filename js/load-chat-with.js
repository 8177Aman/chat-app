 // const form=document.querySelector("#send-msg-form"),
I_id=form.querySelector(".incoming_id").value,
chatBox = document.querySelector(".load-chat"),
chatWith=document.querySelector("#chat-with-user");

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "files/show-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
           
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("I_id="+incoming_id);
}, 500);