    //capturamos el boton actualizar y le agregamos un evento 
    let btnAct = document.querySelectorAll('.actualizar');
    //recorremos todos los elementos que tengan la clase actualizar
    for(let i=0; i<btnAct.length; i++){
      //agregamos un evento para cada boton
      btnAct[i].addEventListener('click', function(){

        
        //podemos recuperar el item
        let id= btnAct[i].getAttribute('item');
        console.log(id);

        //llamamos al metodo eliminaPreguntra y le pasamos el item seleccionado a traves de su atributo
        actualizarTema(id);
        
      });
    }