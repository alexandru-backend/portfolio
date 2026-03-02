function abrir_popup(url){
  window.open(
    `http://localhost/casas_e_propriedades/backoffice/${url}`,
    "Popup IDU",
    "width=992,height=650"
  );
}

function abrir_popup_filemanager(id){
  window.open(
    `http://localhost/casas_e_propriedades/public/filemanager/dialog.php?field_id=${id}&popup=1`,
    "Gestor de Ficheiros",
    "width=992,height=650"
  );
}

function abrir_menu_delay(menu){
  setTimeout(function(){
    if(menu === 'empresas') menu_empresas.click();
    if(menu === 'projetos') menu_projetos.click();
    if(menu === 'portfolio') menu_portfolio.click();
  }, 750);
}

