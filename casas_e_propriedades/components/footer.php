<footer class="container-fluid">
    <div class="row">
      <div class="col-12 menu text-center d-none d-md-block">
        <div>
          <a href="index.php" class="<?= ($menu_atual == "home") ? "active" : "" ?>">HOME</a>
          <a href="#" onclick="abrir_menu_delay('empresas')" class="<?= ($menu_atual == "empresa") ? "active" : "" ?>">EMPRESA</a>
          <a href="#" onclick="abrir_menu_delay('projetos')" class="<?= ($menu_atual == "projeto" || $menu_atual == "predio") ? "active" : "" ?>">PROJECTOS EM COMERCIALIZAÇÃO</a>
          <a href="#" onclick="abrir_menu_delay('portfolio')" class="<?= ($menu_atual == "portfolio") ? "active" : "" ?>">PORTFÓLIO</a>
          <a href="contactos.php" class="<?= ($menu_atual == "contactos") ? "active" : "" ?>">CONTACTOS</a>
        </div>
      </div>
    </div>
  
    <div class="row">
      <div class="col-12">
        <div class="container-fluid">
          <!-- Desktop -->
          <div class="row text-white d-none d-md-flex">
            <div class="col-10 offset-2 text-start t1">Contactos</div>
            <div class="col-3 offset-2 campos">Morada</div>
            <div class="col-2 text-center campos">Telefone</div>
            <div class="col-2 text-end campos">E-mail</div>
            <div class="col-3 offset-2 campos-c"><?= $contactos["morada"] ?></div>
            <div class="col-2 text-end campos-c padding "><?= $contactos["telefone"] ?></div>
            <div class="col-3 text-end campos-c px-2"><?= $contactos["email"] ?></div>
          </div>
          <!-- Mobile -->
          <div class="row text-white text-center d-block d-md-none">
            <div class="col-12 t1">Contactos</div>
            <div class="col-12 campos">Morada</div>
            <div class="col-12 campos-c mt-2"><?= $contactos["morada"] ?></div>
            <div class="col-12 campos">Telefone</div>
            <div class="col-12 campos-c mt-2"><?= $contactos["telefone"] ?></div>
            <div class="col-12 campos">E-mail</div>
            <div class="col-12 campos-c mt-2"><?= $contactos["email"] ?></div>
          </div>
          <div class="row">
            <div class="col-8 offset-2 separador mx-auto"></div>
          </div>
          <div class="row icones d-none d-md-flex justify-content-center">
            <div class="col-1 offset-1 facebook">
              <a href="https://www.facebook.com/" class="w-100 h-100 d-block" target="_blank"></a>
            </div>
            <div class="col-1 ralc text-center">
              <a href="ralc.php" class="w-100 h-100 d-block"></a>
            </div>
          </div>
           <div class="row icones d-md-none d-flex justify-content-center">
            <div class="col-1 facebook  me-4">
              <a href="https://www.facebook.com/" class="w-100 h-100 d-block" target="_blank"></a>
            </div>
            <div class="col-1 ralc ms-5">
              <a href="ralc.php" class="w-100 h-100 d-block"></a>
            </div>
          </div>
            
  
          <div class="row copy text-center text-white">
            <div class="col">
              <a href="cookies.php">
                <p class="my-0 text-white">Política de cookies.</p>
              </a>
              <p class="my-0">Copyright &copy; 2025 Grupo Mediamaster. Todos os direitos reservados.</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </footer>
  
</body>

</html>