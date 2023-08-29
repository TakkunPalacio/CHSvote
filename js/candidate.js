modal_content = document.querySelector("#expl-con");
form = document.querySelector("#voting-form");
button = form.querySelector("#submit");
div_c = document.querySelector("#confirm-modal");
confirm_button = document.querySelector("#confirm");
form.onsubmit = function(e){
    e.preventDefault();
}
button.onclick = function(){
    modal = document.getElementById("modal");
    modal.style.display = "block";
    div_c.style.display = "block";
    modal_content.innerHTML = "Are you sure with your votes?";
    confirm_button.style.display = "block";
}
confirm_button.onclick = function(){
    console.log('confirm');
    xhr = new XMLHttpRequest();
    xhr.open("POST","php/Voting.php",true);
    xhr.onload=function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                 data = xhr.response;
                if(data=="success"){
                    location.reload();
                }else{
                  modal_content.innerHTML = data;
                }
            }
        }
    }
     formData = new FormData(form);
    xhr.send(formData);
}
function ctxts(TXTID,canName){
    var temp = TXTID;
    TXTID = 'sel+'+TXTID;
    if(canName != 1){
    document.getElementById(TXTID).value = "You have selected "+ canName + " for "+temp;
    }
    else{
    document.getElementById(TXTID).value = "You decided to abstain voting for "+temp;
    }
}
function show_student_info(C_ID,M_ID){
    modal = document.getElementById(M_ID);
    modal.style.display = "block";
    confirm_button.style.display = "none";
    php_string = "php/getplatform.php?c_id="+C_ID;
    console.log(C_ID);
     xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload= function(){
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                 data = xhr.response;
                console.log("Got data");
                modal_content.innerHTML = data;
            }
        }
    }
    xhr.send();
}

