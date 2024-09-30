<!DOCTYPE html>
<html lang="pt-BR">

<head>
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fila</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
    .navbar-nav .nav-link {
        color: #2e9fea !important;
        /* Cor personalizada para os links */
        border: 1px solid #d3d3d3;
        /* Borda cinza claro */
        border-radius: 4px;
        /* Borda arredondada */
        padding: 8px 12px;
        /* Espaçamento interno */
        margin: 2px;
        /* Espaçamento entre os links */
        transition: background-color 0.3s, border-color 0.3s;
        /* Transição suave para o hover */
    }

    .navbar-nav .nav-link:hover {
        background-color: #e9f5fc;
        /* Cor de fundo ao passar o mouse */
        border-color: #2e9fea;
        /* Cor da borda ao passar o mouse */
        color: #2e9fea !important;
        /* Cor do texto ao passar o mouse */
    }

    .navbar-brand img {
        max-height: 50px;
        /* Ajuste a altura da imagem do logotipo */
    }

    .navbar {
        text-align: center;
        /* Centraliza o texto no header */
    }

    .navbar-collapse {
        justify-content: center;
        /* Centraliza o conteúdo da barra de navegação */
    }
</style>

<body>
    <?php
    include "../Layout/HeaderEstabelecimento.php"
        ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Cadastro de Fila</h3>
            </div>
            <div class="card-body">
                <form id="filaForm" action="../../Controller/FilaController?action=create_fila" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="logo">Logo do Site:</label>
                        <div>
                            <input type="file" id="logo" name="logo" accept="image/*" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nome">Nome da Fila:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da Fila"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço:</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="inicio">Horário de Início:</label>
                        <input type="time" class="form-control" id="inicio" name="inicio" required>
                    </div>
                    <div class="form-group">
                        <label for="termino">Horário de Término:</label>
                        <input type="time" class="form-control" id="termino" name="termino" required>
                    </div>
                    <!-- <div class="form-group">
                    <label for="img">Envie uma imagem para sua fila:</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    </div> -->
                    <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>

</html>

<?php
// Processa o formulário se ele foi enviado
// Processa o formulário se ele foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeFila = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $horarioInicio = $_POST['inicio'];
    $horarioTermino = $_POST['termino'];

    $logo = $_FILES['logo'];
    $logoName = $logo['name'];
    $logoTmpName = $logo['tmp_name'];
    $logoSize = $logo['size'];
    $logoType = $logo['type'];

    if ($logoType == 'image/jpeg' || $logoType == 'image/png') {

        $uploadDir = 'uploads/logos/';
        $logoPath = $uploadDir . $logoName;
        move_uploaded_file($logoTmpName, $logoPath);

        $dados = "$nomeFila|$endereco|$horarioInicio|$horarioTermino|$logoPath\n";
        file_put_contents($arquivo, $dados, FILE_APPEND);
    } else {
        echo '<script>alert("Erro: O arquivo não é uma imagem válida!");</script>';
    }

    // Redirecionar para a página de sucesso ou exibir uma mensagem de sucesso
    echo '<script>alert("Fila cadastrada com sucesso!");</script>';

}
?>