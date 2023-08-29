const table_data = document.querySelector(".Voters");
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
const form = document.querySelector(".modal-content form"),
editBtn = form.querySelector(".form-button input.edit"),
addBtn = form.querySelector(".form-button input.add.form"),
errorText = document.querySelector(".error-text"),
Name_field = form.querySelector("#name"),
Password_field = form.querySelector("#pass"),
ID_field = form.querySelector("#id"),
Year_field = form.querySelector("#year"),
Course_field= form.querySelector("#course"),
Section_field= form.querySelector("#section");
status_modal = document.getElementById("status_msg");
status_msg = document.getElementById("status_p");
old_s_id = form.querySelector("#o_s_id");
addBtnshow = document.querySelector(".content button.add");
const search_form = document.querySelector(".search form");
searchterm = search_form.querySelector("#search");
courseterm = search_form.querySelector("#coursesearch");
yearterm = search_form.querySelector("#yearsearch");
sectionterm = search_form.querySelector("#sectionsearch");
delete_btn = document.querySelector("#delete");
function searching(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/getvdata.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                table_data.innerHTML = data;
            }
        }
    }
    let formData = new FormData(search_form);
    xhr.send(formData);
}
searchterm.onkeyup = () =>{
    searching();
}
courseterm.onchange= ()=>{
    searching();
}
yearterm.onchange= ()=>{
    searching();
}
sectionterm.onchange= ()=>{
    searching();
}


search_form.onsubmit = (e)=>{
    e.preventDefault();
}
form.onsubmit = (e)=>{//prevents the submit button to do actually anything
    e.preventDefault();
}

addBtn.onclick = () =>{
    console.log("Sent form data for add");
    php_string = "php/addvdata.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data=="success"){
                    modal.style.display="none";
                    status_modal.style.display="block";
                    status_p.innerHTML="Successfully Inserted Data";
                }else{
                    errorText.style.display="block";
                    errorText.innerHTML=data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
addBtnshow.onclick = ()=>{
    modal.style.display="block";
    editBtn.style.display="none";
    addBtn.style.display="block";
    Name_field.value="";
    Password_field.value="";
    ID_field.value="";
    Year_field.value="";
    Course_field.value="";
    Section_field.value="";
    old_s_id.value = "";
}
editBtn.onclick = () =>{
    console.log("Sent form data for editing");
    php_string = "php/editvdata.php";
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data=="success"){
                    modal.style.display="none";
                    status_modal.style.display="block";
                    status_p.innerHTML="Successfully Edited Data";
                }else{
                    errorText.style.display="block";
                    errorText.innerHTML=data;
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
function deletedata(S_ID){
    modal.style.display="block";
    form.style.display="none";
    delete_btn.style.display="block";
    errorText.style.display="block";
    errorText.innerHTML = "Are you sure you want to delete this entry?";
    delete_btn.value = S_ID;
}
delete_btn.onclick = () =>{
    S_ID = delete_btn.value;
    console.log('delete ',S_ID);
    php_string = "php/delvdata.php?s_id="+S_ID;
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                if(data=="success"){
                    status_modal.style.display="block";
                    status_p.innerHTML="Successfully Deleted Data";
                    modal.style.display="none";
                }else{
                    status_modal.style.display="block";
                    status_p.innerHTML="Something must have gone wrong. Please try again later.";
                    modal.style.display="none";
                }
            }
        }
    }
    xhr.send();
}
function editdata(S_ID){
    modal.style.display="block";
    editBtn.style.display="block";
    addBtn.style.display="none";
    php_string = "php/get-data-edit.php?s_id="+S_ID;
    old_s_id.value=S_ID;
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log("Successfully got data!");
                let data = JSON.parse(xhr.response);//parse encoded json
                console.log(data);
                Name_field.value=data[0];
                ID_field.value=data[1];
                Password_field.value=data[2];
                Year_field.value=data[3];
                Course_field.value=data[4];
                Section_field.value=data[5];
            }
        }
      }
    xhr.send();
}
function load_table(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/getvdata.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                table_data.innerHTML = data;
            }
        }
    }
    xhr.send();
}

window.onload = load_table();
window.onclick = function(event) {
    if (event.target == modal ) {
    modal.style.display = "none";
    errorText.style.display="none";
    form.style.display = "block";    
    delete_btn.style.display="none";
    }
    else if (event.target == status_modal ) {
        status_modal.style.display = "none";
        errorText.style.display="none";
        form.style.display = "block";
        delete_btn.style.display="none";
        load_table();
        
    }
    else if (event.target == document.getElementsByClassName("close")[1]) {
        status_modal.style.display = "none";
        errorText.style.display="none";
        form.style.display = "block";
        delete_btn.style.display="none";
        load_table();
    }
} 
span.onclick = function() {
    modal.style.display = "none";
    status_modal.style.display="none";
    errorText.style.display="none";
    form.style.display = "block";
    delete_btn.style.display="none";
}
