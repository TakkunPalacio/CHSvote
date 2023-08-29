const form = document.querySelector(".import");
submit = form.querySelector(".submit");
errorText = document.querySelector(".error-text");
successText = document.querySelector(".success-text");
processText =document.querySelector(".process-text");
form.onsubmit = (e)=>{
    e.preventDefault();
}
submit.onclick = ()=>{
    errorText.style.display="none";
    successText.style.display="none";
    processText.style.display="block";
    console.log("Sent file!");
    php_string = "php/importexcel.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data=="success"){
                  successText.style.display="block";
                  processText.style.display="none";
                }else{
                    errorText.style.display="block";
                    processText.style.display="none";
                    errorText.innerHTML=data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
