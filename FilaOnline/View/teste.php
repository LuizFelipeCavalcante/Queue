<?php
include 'qrcode.php';



if(isset($_POST['qr'])) {   
    $text = $_POST['qr'];
    $name = md5(time()) . ".png";
    $file = "Files/{$name}";
    $options = array(
        'w' =>500,
        'h' =>500,
    );
    $generator = new QRCode($text, $options);
    $generator->output_image();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="qr" placeholder="Texto">
        <button type="submit">Gerar</button>
    </form>
</body>
</html>