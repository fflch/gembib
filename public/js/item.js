console.log("Estou aqui");


  function optionCheck(){
      var option = document.getElementById("tipo_material").value;
      if(option == "Tese"){
        document.getElementById("subcategoria").style.visibility ="visible";
      }else if(option != "Tese") {
        document.getElementById("subcategoria").style.visibility ="hidden";
      }
      if(option == "Outros Tipos"){
        document.getElementById("outromaterial").style.visibility ="visible";
      }else if(option != "Outros Tipos"){
        document.getElementById("outromaterial").style.visibility ="hidden";
      }
      if(option == "Mapas"){
        document.getElementById("escala").style.visibility ="visible";
      }else if(option != "Mapas"){
        document.getElementById("escala").style.visibility ="hidden";
      }
    }

  function optionNegado(){
      var option = document.getElementById("status").value;
      if(option == "Negado"){
        document.getElementById("hiddenMotivo").style.visibility ="visible";
      }else if(option != "Negado") {
        document.getElementById("hiddenMotivo").style.visibility ="hidden";
      }
    }

function mostraCampo(obj) {
    var select = document.getElementById('verba');
    var txt = document.getElementById("Outras");
    txt.style.visibility = (select.value == 'Outras') 
        ? "visible"
        : "hidden";  
  }


