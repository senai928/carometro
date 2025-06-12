// Funcionalidades JavaScript para o Carômetro Digital

document.addEventListener('DOMContentLoaded', function() {
    // Animação dos cards ao carregar a página
    const cards = document.querySelectorAll('.card');
    cards.forEach(function(card, index) {
        setTimeout(function() {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });

    // Efeito de hover nos cards
    cards.forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
        });
    });

    // Adicionar funcionalidade de confirmação aos botões de exclusão
    const botoesExcluir = document.querySelectorAll('.excluir');
    botoesExcluir.forEach(function(botao) {
        botao.addEventListener('click', function(e) {
            if (!confirm('Tem certeza que deseja excluir este aluno?')) {
                e.preventDefault();
            }
        });
    });

    // Funcionalidade de busca dinâmica se existir o campo de busca
    const campoBusca = document.querySelector('input[name="busca"]');
    if (campoBusca) {
        campoBusca.addEventListener('input', function() {
            const termo = this.value.toLowerCase();
            
            cards.forEach(function(card) {
                const nome = card.querySelector('h3').textContent.toLowerCase();
                const email = card.querySelector('.email').textContent.toLowerCase();
                const cpf = card.querySelector('.cpf').textContent.toLowerCase();
                
                if (nome.includes(termo) || email.includes(termo) || cpf.includes(termo)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Funcionalidade para fechar mensagens de alerta automaticamente
    const mensagens = document.querySelectorAll('.mensagem');
    mensagens.forEach(function(mensagem) {
        setTimeout(function() {
            mensagem.style.opacity = '0';
            setTimeout(function() {
                mensagem.style.display = 'none';
            }, 500);
        }, 5000);
    });
});