const form=document.querySelector("#send-msg-form"),
I_id=form.querySelector(".incoming_id").value,
chatBox = document.querySelector(".load-chat");



setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "files/show-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("I_id="+incoming_id);
}, 500);


function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }