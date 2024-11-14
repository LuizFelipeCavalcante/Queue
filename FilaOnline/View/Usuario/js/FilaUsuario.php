<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

// Usa o valor do ID PHP diretamente na URL
    const id = <?php echo json_encode($_SESSION['user_id']); ?>;
    setInterval(function() {
    fetch(`../../Controller/FilaController.php?action=readfila_usuario&id=${id}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('fila').innerHTML = data;  // Atualiza o conteúdo diretamente com os dados recebidos
        })
        .catch(error => console.error('Erro ao atualizar a fila:', error));
}, 5000);  // Atualiza a cada 5 segundos


</script>