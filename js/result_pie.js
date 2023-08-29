data_percent = document.querySelector(".jsedit");
under = document.querySelector(".undecided");
body = document.querySelector("body");
window.onload = () =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","php/getresultdata.php",true);
    xhr.onload=()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                data_percent.innerHTML = data;
            }
        }
    }
    xhr.send();
    let xhr1 = new XMLHttpRequest();
    xhr1.open("POST","php/getresultdata_under.php",true);
    xhr1.onload=()=>{
        if(xhr1.readyState === XMLHttpRequest.DONE){
            if(xhr1.status === 200){
                let data = xhr1.response;
                under.innerHTML = data;
            }
        }
    }
    xhr1.send();
}