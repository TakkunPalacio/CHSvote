div_c = document.querySelector("#confirm-modal");
function showmodal(id){
    modal = document.getElementById(id);
    modal.style.display = "block";
}

function closemodal(id){
    var modal = document.getElementById(id);
    modal.style.display = 'none';
}
document.onclick = function(event){
    if(event.target.id == 'modal'){
        var modal = document.getElementById('modal');
        modal.style.display = 'none';
        div_c.style.display = "none";
    }
    if(event.target.id == 'modalB'){
        var modal = document.getElementById('modalB');
        modal.style.display = 'none';
        window.location.replace("Profile.php"); 
        div_c.style.display = "none";
    }
}    
function closemodalB(id){
    var modal = document.getElementById(id);
    modal.style.display = 'none';
    window.location.replace("Profile.php");
}