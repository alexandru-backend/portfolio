<?php

  function get_pagina_especifica($id){
    $resultado = select_sql_unico("SELECT * FROM paginas WHERE id=$id LIMIT 1");
    return $resultado;
  }

?>