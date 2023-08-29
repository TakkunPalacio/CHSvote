var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
const form = document.querySelector(".modal-content form"),
editBtn = form.querySelector(".form-button input.edit"),
addBtn = form.querySelector(".form-button input.add.form"),
errorText = document.querySelector(".error-text"),
Name_field = form.querySelector("#name"),
Position_field = form.querySelector("#position"),
ID_field = form.querySelector("#id"),
Year_field = form.querySelector("#year"),
Course_field= form.querySelector("#course"),
Section_field= form.querySelector("#section"),
Platform_field=form.querySelector("#platform"),
Image_field = form.querySelector("#image"),
Candidate_field = form.querySelector("#candi_id");
const table_data = document.querySelector(".Candidate");
status_modal = document.getElementById("status_msg");
status_msg = document.getElementById("status_p");
addBtnshow = document.querySelector(".content button.add");
const search_form = document.querySelector(".search form");
searchterm = search_form.querySelector("#search");
courseterm = search_form.querySelector("#coursesearch");
yearterm = search_form.querySelector("#yearsearch");
sectionterm = search_form.querySelector("#sectionsearch");
posterm = search_form.querySelector("#positionsearch");
delete_btn = document.querySelector("#delete");

function searching(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/getcdata.php",true);
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
posterm.onchange=()=>{
    searching();
}


search_form.onsubmit = (e)=>{
    e.preventDefault();
}
function load_table(){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/getcdata.php",true);
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
window.onload = load_table();//load table

function editdata(candidate_id){
    editBtn.style.display="block";
    addBtn.style.display="none";
    php_string = "php/get-data-edit.php?c_id="+candidate_id;
    modal.style.display = "block";
    Candidate_field.value = candidate_id;
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                console.log("Successfully got data!");
                let data = JSON.parse(xhr.response);//parse encoded json
                Name_field.value = data[0];
                Position_field.selectedIndex =parseInt(data[1])-1;
                ID_field.value = data[2];
                Year_field.value = data[3];
                Course_field.value = data[4];
                Section_field.value=data[5];
                Platform_field.value=data[6];
                Image_field.value = "";
            }
        }
      }
    xhr.send();
}

function deletedata(candidate_id){
    modal.style.display="block";
    form.style.display="none";
    delete_btn.style.display="block";
    errorText.style.display="block";
    errorText.innerHTML = "Are you sure you want to delete this entry?";
    delete_btn.value = candidate_id;
    
}
delete_btn.onclick = () =>{
    candidate_id = delete_btn.value;
    console.log('delete ',candidate_id);
    php_string = "php/delcdata.php?c_id="+candidate_id;
    let xhr = new XMLHttpRequest();
    xhr.open("POST",php_string,true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
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
span.onclick = function() {
    modal.style.display = "none";
    status_modal.style.display="none";
    errorText.style.display="none";
    form.style.display = "block";
    delete_btn.style.display="none";
}

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


form.onsubmit = (e)=>{
    e.preventDefault();
}
addBtn.onclick=()=>{
    console.log("adding candidates");
    php_string = "php/addcdata.php";
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
editBtn.onclick = ()=>{
    console.log("Sent form data for editing");
    php_string = "php/editcdata.php";
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
addBtnshow.onclick = ()=>{//Add Candidate show modal
    console.log("Clicked the Add Candidate Button");
    modal.style.display="block";
    Name_field.value = "";
    Position_field.selectedIndex =0;
    ID_field.value = "";
    Year_field.value = "";
    Course_field.value = "";
    Section_field.value="";
    Platform_field.value="";
    Image_field.value = "";
    Candidate_field.value = "1";
    editBtn.style.display="none";
    addBtn.style.display="block";
}


function imgerror(e){
    e.setAttribute("src","assets/place_holder.webp");
    e.removeAttribute("onError");
    e.removeAttribute("onclick");
}