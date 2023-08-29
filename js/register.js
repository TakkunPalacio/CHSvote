function closemodal(con_id){
    document.getElementById(con_id).style.display = "none";
    window.location.replace('Register.php')
}
document.onclick = function(e){
    if(e.target.id == 'err_div'){
        err_div.style.display='none';
        window.location.replace('Register.php')
    }
    if(e.target.id == 'id_exists'){
        id_exists.style.display='none';
        window.location.replace('Register.php')
    }
    if(e.target.id=='success'){
        success.style.display='none';
        window.location.replace('Register.php')
    }
}

function showmid(con_id){
    document.getElementById(con_id).style.display = "block";
   
}

function genPass(){
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    document.getElementById("password").value = retVal;
}