<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="image.php" method="POST">
        <label>Поставить оценку </label><input type="text" name="setMarks"><br>
        <input type="submit" name="submitMark" value="Подтвердить оценку">
        <input type="submit" name="submit" value="Показать диаграмму">
        <link rel="stylesheet" href="style.css">
    </form>
    <?php
    if (isset($_GET['picture'])) {
        echo "<img src = '{$_GET['picture']}'>";
    }
    ?>
</body>

</html>