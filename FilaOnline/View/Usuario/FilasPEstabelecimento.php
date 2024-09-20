<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Filas</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/HomeEstabelecimento.css">

</head>

<!-- header include-->

<?php
    include "../Layout/HeaderUsuario.php"
?>
<!-- Lista de Filas -->
<div class="container">
    <div class="row">


        <div class="col-md-6 col-lg-3">

            <div class="card">
                <a class="adicionar" href="../Estabelecimento/cadastrofila.php">
                    <p>+</p>
                </a>
            </div>
        </div>



        <?php if (!empty($_SESSION['filas'])): ?>
            <?php foreach ( array_reverse($_SESSION['filas']) as $fila): ?>
                <div class="col-md-6 col-lg-3">
                    <a href="FilaExistente/?id=<?php echo htmlspecialchars($fila['id']); ?>" class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Fila 1">
                        <div class="card-header"><?php echo htmlspecialchars($fila['nome']); ?></div>
                        <div class="fila-info">
                            <p><strong>Endereço:</strong> <?php echo htmlspecialchars($fila['endereco']); ?></p>
                            <p class="tempo-espera">Tempo de espera: </p>
                            <p class="num-pessoas">Pessoas na fila: </p>
                            <p><strong>Inicio:</strong> <?php echo htmlspecialchars($fila['inicio']); ?> </p>
                            <p><strong>Termino:</strong> <?php echo htmlspecialchars($fila['termino']); ?> </p>
                            <p><strong>Prévia das pessoas:</strong> </p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma fila cadastrada.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>