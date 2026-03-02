<?php

function get_contacto(){
  $resultado = select_sql_unico("SELECT * FROM contactos");
  return $resultado;
}

function get_contactos(){
  $resultado = select_sql("SELECT * FROM contactos");
  return $resultado;
}
?>