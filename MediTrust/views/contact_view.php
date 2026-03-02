<?php

  $erros = [];
  $sucesso = "";

  if (!empty($_GET["sucesso"]) && $_GET["sucesso"] == "1") {
    $sucesso = "Formulário enviado com sucesso!";
  }

  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome   = trim($_POST["nome"] ?? "");
    $email  = trim($_POST["email"] ?? "");
    $titulo = trim($_POST["titulo"] ?? "");
    $texto  = trim($_POST["texto"] ?? "");

    if($nome === "" || $email === "" || $titulo === "" || $texto === "") $erros[] = "Preencha todos os campos.";
    if(mb_strlen($nome) > 20) $erros[] = "Nome demasiado grande.";
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "Email inválido.";
    if(mb_strlen($texto) > 150) $erros[] = "Mensagem demasiado grande."; 

    if(empty($erros)) {
      $stmt = $pdo->prepare("INSERT INTO contactos (nome, email, titulo, texto) VALUES (:nome, :email, :titulo, :texto)");
      $stmt->execute([
        "nome" => $nome,
        "email" => $email,
        "titulo" => $titulo,
        "texto" => $texto,
      ]);

      header("Location: contact.php?sucesso=1");
      exit;
    }
    
  }
  

?>



  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="breadcrumbs">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="bi bi-house"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Category</a></li>
            <li class="breadcrumb-item active current">Contact</li>
          </ol>
        </nav>
      </div>

      <div class="title-wrapper">
        <h1>Contact</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container">
        <div class="contact-wrapper">
          <div class="contact-info-panel">
            <div class="contact-info-header">
              <h3>Contact Information</h3>
              <p>Dignissimos deleniti accusamus rerum voluptate. Dignissimos rerum sit maiores reiciendis voluptate inventore ut.</p>
            </div>

            <div class="contact-info-cards">
              <div class="info-card">
                <div class="icon-container">
                  <i class="bi bi-pin-map-fill"></i>
                </div>
                <div class="card-content">
                  <h4>Our Location</h4>
                  <p>4952 Hilltop Dr, Anytown, CA 90210</p>
                </div>
              </div>

              <div class="info-card">
                <div class="icon-container">
                  <i class="bi bi-envelope-open"></i>
                </div>
                <div class="card-content">
                  <h4>Email Us</h4>
                  <p>info@example.com</p>
                </div>
              </div>

              <div class="info-card">
                <div class="icon-container">
                  <i class="bi bi-telephone-fill"></i>
                </div>
                <div class="card-content">
                  <h4>Call Us</h4>
                  <p>+1 (555) 123-4567</p>
                </div>
              </div>

              <div class="info-card">
                <div class="icon-container">
                  <i class="bi bi-clock-history"></i>
                </div>
                <div class="card-content">
                  <h4>Working Hours</h4>
                  <p>Monday-Saturday: 9AM - 7PM</p>
                </div>
              </div>
            </div>

            <div class="social-links-panel">
              <h5>Follow Us</h5>
              <div class="social-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
          </div>

          <div class="contact-form-panel">
            <div class="map-container">
              <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="form-container">
              <h3>Send Us a Message</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipiscing elit mauris hendrerit faucibus imperdiet nec eget felis.</p>

              <form action="contact.php" method="post" id="form_contactos">

              <?php if(!empty($sucesso)): ?>
                <div class="guardar w-100 mb-y p-2 text-success"><?= $sucesso ?></div>
              <?php endif; ?>
              <?php if(!empty($erros)): ?>
                <div class="cancelar w-100 mb-3 p-2 text-danger">
                  <ul class="mb-0">
                    <?php foreach($erros as $e): ?>
                      <li><?= $e ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="nameInput" name="nome" placeholder="Full Name" maxlength="20" required>
                  <label for="nameInput">Full Name</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="emailInput" name="email" placeholder="Email Address" maxlength="50" required>
                  <label for="emailInput">Email Address</label>
                </div>

                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="subjectInput" name="titulo" placeholder="Subject" maxlength="40" required>
                  <label for="subjectInput">Subject</label>
                </div>

                <div class="form-floating mb-3">
                  <textarea class="form-control" id="messageInput" name="texto" rows="5" placeholder="Your Message" maxlength="150" style="height: 150px" required></textarea>
                  <label for="messageInput">Your Message</label>
                </div>

                <div class="d-grid">
                  <button type="submit" class="btn-submit">Send Message <i class="bi bi-send-fill ms-2"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Contact Section -->

  </main>

 