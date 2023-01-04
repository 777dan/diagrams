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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Поставить оценку </label><input type="text" name="setMarks"><br>
        <input type="submit" name="submitMark" value="Подтвердить оценку">
        <input type="submit" name="submit" value="Показать диаграмму">
        <link rel="stylesheet" href="style.css">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        echo "<img src='img.php'>";
    }
    if (isset($_POST['submitMark'])) {
        $mark = $_POST['setMarks'];
        $filename = "marks.json";
        $fileOpen = fopen($filename, "r+");
        $fileContent = fread($fileOpen, filesize($filename));
        $fileContent = json_decode($fileContent);
        array_push($fileContent, $mark);
        $fileContent = json_encode($fileContent);
        fclose($fileOpen);
        $fileOpen = fopen($filename, "w");
        fwrite($fileOpen, "[]");
        fclose($fileOpen);
        $fileOpen = fopen($filename, "r+");
        fwrite($fileOpen, $fileContent);
        fclose($fileOpen);
    }
    ?>
</body>

</html>