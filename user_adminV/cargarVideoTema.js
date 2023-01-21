


//seleccionamos el formulario por selector CSS en este caso es class
let form= document.querySelector(".formulario");

//agregamos un escuchador para el boton submit y una funcion anonima
form.addEventListener('submit', function(){

    //seleccionamos el inputfile que corresponde al video y guadamos en variable
    let inputFile= document.querySelector("#videoTema").files[0];
    //seleccionamos la barra de carga
    let barraCarga= document.querySelector(".barraCarga");

    //instanciamos FormData para obtener datos del formulario para que primero pase por este codigo JS y despues se envien los datos del formulario al documento PHP
    let datosFormulario= new FormData();

    //usamos el metodo apeend para agregar las variables del formulario
    datosFormulario.append("inputFile",inputFile);

    //instanciamos XmlHttpRequest para enviar datos del formulario
    let enviaAjax= new XMLHttpRequest();

    //agregamos un evento cuando se suba un archivo se maneja un evento de progreso con una funcion anonima
    enviaAjax.upload.addEventListener("progress", function(e){
        //calculamos el porcentaje de carga con (lo cargado / el total de carga) *100
        let porcentajeCarga= (e.loaded/e.total)* 100;

        //agremaos el porcentaje de carga a la barra de carga
        barraCarga.value= Math.round(porcentajeCarga);

    });

    //enviando datos para procesar archivo 
    enviaAjax.open("POST", "subirCurso.php");   

    //indicamos los datos a enviar
    enviaAjax.send(datosFormulario);

});
