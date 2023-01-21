
//  function llenar_cmb2(){
//     //valor del primer combo
//     var valor= document.getElementById("combo1").value;
//     //window.alert(valor);
//     //si valor del selec es diferente de vacio hace:
//     if(valor!== " "){
//     $.ajax({
//     data:  {valor}, //datos que se envian a traves de ajax
//     url:   'prueba.php', //archivo que recibe la peticion
//     type:  'post', //método de envio
//     beforeSend: function () {
//             $("#resultado").html("Procesando, espere por favor...");
//     },
//     success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
//             $("#resultado").html(response);
//     }
//     });
        
        
//     }
// }


function llenar_cmb2(){
    //valor del primer combo
    var valor= document.getElementById("combo1").value;
    //window.alert(valor);
    //si valor del selec es diferente de vacio hace:
    if(valor!== " "){
    $.ajax({
    data:  {valor}, //datos que se envian a traves de ajax
    url:   'prueba.php', //archivo que recibe la peticion
    type:  'post', //método de envio
    beforeSend: function () {
            $("#combo2").html("Procesando, espere por favor...");
    },
    success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            let respuesta= JSON.parse(response);
            
           let template='';
           respuesta.forEach(tema =>{
           
            template+=`
            <selected>${tema.id_tema}
            <option>
            ${tema.Nombre_tema}
            </option>
            </selected
            `
           });
          
            $('#combo2').html(template);
       // console.log(respuesta);
    }
    });
        
        
    }
}


