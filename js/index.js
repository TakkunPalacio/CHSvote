function abt(GetId){
    document.getElementById(GetId).style.display = "block";
}
function closemodal(id){
    document.getElementById(id).style.display = "none";
    window.location.replace("index.php");
}

document.onclick = function(e){
    if(e.target.id == 'about_us'){
        about_us.style.display='none';
        window.location.replace("index.php");
    }
    if(e.target.id == 'f_login'){
        f_login.style.display='none';
        window.location.replace("index.php");
    }   
}
function fail(){
    document.getElementById('f_login').style.display = "block";
}