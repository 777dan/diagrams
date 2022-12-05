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
        <input type="submit" name="submit" value="Показать диаграмму">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        // Диаграмма будет представлена для значений следующего массива:
        $values = array(
            "23", "32", "35", "57", "12",
            "3", "36", "54", "32", "15",
            "43", "24", "30"
        );
        // Количество столбцов диаграммы:
        $columns = count($values);
        // Задаем щирину и высоту всего изображения
        $width = 300;
        $height = 200;
        // Задаем пространство между колонками:
        $padding = 2;
        // Получаем ширину одной колонки:
        $column_width = $width / $columns;
        // Создаем переменные
        $im = imagecreate($width, $height);
        $gray = imagecolorallocate($im, 0xcc, 0xcc, 0xcc);
        $gray_lite = imagecolorallocate($im, 0xee, 0xee, 0xee);
        $gray_dark = imagecolorallocate($im, 0x7f, 0x7f, 0x7f);
        $white = imagecolorallocate($im, 0xff, 0xff, 0xff);
        // Заполняем фон картинки
        imagefilledrectangle($im, 0, 0, $width, $height, $white);
        $maxv = 0;
        // Вычисляем максимум
        for ($i = 0; $i < $columns; $i++)
            $maxv = max($values[$i], $maxv);
        // Рисуем каждую колонку
        for ($i = 0; $i < $columns; $i++) {
            $column_height = ($height / 100) * (($values[$i] / $maxv) * 100);
            $x1 = $i * $column_width;
            $y1 = $height - $column_height;
            $x2 = (($i + 1) * $column_width) - $padding;
            $y2 = $height;
            imagefilledrectangle($im, $x1, $y1, $x2, $y2, $gray);
            //для 3D эффекта
            imageline($im, $x1, $y1, $x1, $y2, $gray_lite);
            imageline($im, $x1, $y2, $x2, $y2, $gray_lite);
            imageline($im, $x2, $y1, $x2, $y2, $gray_dark);
        }
        header("Content-type: image/png");
        ob_end_flush();
        imagepng($im);
    }
    ?>
</body>

</html>