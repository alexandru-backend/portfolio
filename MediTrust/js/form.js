document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Ouvimos o evento de submissão no documento inteiro
    document.addEventListener('submit', function(e) {
        
        // 2. Verificamos se o formulário enviado tem um ID que começa por 'form_'
        const form = e.target;
        if (form && form.id && form.id.startsWith('form_')) {
            
            e.preventDefault(); // Impede o recarregamento da página

            // 3. Selecionamos os elementos dentro DESTE formulário específico
            const statusDiv = form.querySelector('.mensagem-status');
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            const formData = new FormData(form);
            const actionUrl = form.getAttribute('action'); // Pega o caminho do action (ex: actions/insert_contacts.php)

            // 4. Feedback visual inicial
            btn.disabled = true;
            btn.innerHTML = 'Sending...';
            
            if (statusDiv) {
                statusDiv.classList.add('d-none');
                statusDiv.classList.remove('text-success', 'guardar', 'text-danger', 'cancelar', 'alert', 'alert-success', 'alert-danger');
            }

            // 5. Envio via Fetch
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                if (statusDiv) {
                    statusDiv.classList.remove('d-none');
                    
                    if (data.trim() === 'sucesso') {
                        form.reset();
                        statusDiv.innerHTML = "Submetido com sucesso!";
                        statusDiv.classList.add('text-success', 'guardar');
                        
                        // Opcional: desaparecer após 5 segundos
                        setTimeout(() => {
                            statusDiv.classList.add('d-none');
                        }, 5000);
                    } else {
                        // Mostra os erros vindos do PHP (ex: "Email inválido")
                        statusDiv.textContent = "Erro: " + data;
                        statusDiv.classList.add('text-danger', 'cancelar');
                    }
                }
            })
            .catch(error => {
                if (statusDiv) {
                    statusDiv.classList.remove('d-none');
                    statusDiv.textContent = "Erro na ligação ao servidor.";
                    statusDiv.classList.add('text-danger');
                }
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        }
    });
});