document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form_contactos');
    
    if (form) {
        form.addEventListener('submit', function(e) {
          e.preventDefault(); 

          const formData = new FormData(this);

          // 1. Selecionar o botão e desativá-lo
          const btn = form.querySelector('.btn-submit'); // Usei a tua classe do HTML
          const originalText = btn.innerHTML; // Guarda o texto "Send Message"
          
          btn.disabled = true;
          btn.innerHTML = 'Sending...'; // Dá feedback visual

          // 2. Fazer apenas UM fetch
          fetch('actions/insert_contacts.php', {
              method: 'POST',
              body: formData,
              headers: {
                  'X-Requested-With': 'XMLHttpRequest'
              }
          })
          .then(response => response.text())
          .then(data => {
              if (data.trim() === 'sucesso') {
                  form.reset();
                  alert('Enviado com sucesso via JavaScript!'); 
              } else {
                  alert('Erro do servidor: ' + data);
              }
          })
          .catch(error => {
              console.error('Erro:', error);
              alert('Erro na ligação ao servidor.');
          })
          .finally(() => {
              // 3. O 'finally' corre quer dê erro ou sucesso
              // Volta a ativar o botão para o utilizador poder usar de novo
              btn.disabled = false;
              btn.innerHTML = originalText;
          });
        });
    }
});