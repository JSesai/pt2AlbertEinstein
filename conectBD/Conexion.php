<?PHP
try{
  //HOST LOCAL
    //cadena de conexion para PDO
    //instanciamos la clase PDO para hacer uso de sus metodos con la variable $bds le pasamos cadena de conexion esta es local
   $bds= new PDO('mysql:host=localhost; dbname=educae', 'root', '');

   //HOST DE HANIEL
    //instanciamos la clase PDO y le pasamos la cadena de conexion, en este caso sera para neubox
      //  $bds= new PDO('mysql:host=localhost; dbname=coleg369_JS_educae', 'coleg369', '@z]M12pC9aXOv8'); 

      //MI HOST PERSONAL
      //instanciamos la clase PDO para hacer uso de sus metodos con la variable $bds le pasamos cadena de conexion esta es local
   //$bds= new PDO('mysql:host=localhost; dbname=u738088629_educae', 'u738088629_sesai', 'J1s9m2e7');
    
    //establecemos los codigos de error
    $bds->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //establecemos el uso de caracteres especiales
    $bds->exec("SET CHARACTER SET utf8");

   

}catch( Exception $e){
    //si falla la conexion la terminamos
    die("error". $e->getMessage());
    echo "Linea del error". $e->getLine();

}


?>



