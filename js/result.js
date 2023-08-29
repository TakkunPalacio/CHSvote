const table_data = document.querySelector(".table-result");
setInterval(() =>{
    console.log("Running...");
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/result.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            table_data.innerHTML = data;
          }
      }
    }
    xhr.send();
    
}, 2000);
