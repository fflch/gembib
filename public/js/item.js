console.log("Esotu aqui");


  function optionCheck(){
      var option = document.getElementById("tipo_material").value;
      if(option == "Teses"){
        document.getElementById("hiddenDiv").style.visibility ="visible";
      }else if(option != "Teses") {
        document.getElementById("hiddenDiv").style.visibility ="hidden";
      }
      if(option == "Outros"){
        document.getElementById("outromaterial").style.visibility ="visible";
      }else if(option != "Outros"){
        document.getElementById("outromaterial").style.visibility ="hidden";
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


