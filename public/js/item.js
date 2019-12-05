console.log("Esotu aqui");

function mostraCampoPrioridade(obj) {
    var select = document.getElementById('prioridade');
    var txt = document.getElementById("Outra");
    txt.style.visibility = (select.value == 'Outra') 
        ? "visible"
        : "hidden";  
  }


  function optionCheck(){
      var option = document.getElementById("tipo_material").value;
      if(option == "Teses"){//se for igual "teses" o campo irá aparecer
        document.getElementById("hiddenDiv").style.visibility ="visible";
      }else if(option != "Teses") {
        document.getElementById("hiddenDiv").style.visibility ="hidden";
      }
      if(option == "Outros"){
        document.getElementById("hiddenInput").style.visibility ="visible";
      }else if(option != "Outros"){
        document.getElementById("hiddenInput").style.visibility ="hidden";
      }
      if(option == "Mapas"){
        document.getElementById("hiddenEscala").style.visibility ="visible";
      }else if(option != "Mapas"){
        document.getElementById("hiddenEscala").style.visibility ="hidden";
      }
    }

function mostraCampo(obj) {
    var select = document.getElementById('verba');
    var txt = document.getElementById("Outras");
    txt.style.visibility = (select.value == 'Outras') 
        ? "visible"
        : "hidden";  
  }

function mostraCampoStatus(obj) {
    var select = document.getElementById('status');
    var txt = document.getElementById("Outro");
    txt.style.visibility = (select.value == 'Outro') 
        ? "visible"
        : "hidden";  
  }

