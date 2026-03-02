<?php 

  function get_contacto(){
    $resultado = select_sql_unico("SELECT * FROM contactos");
    return $resultado;
  }

?>