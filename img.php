<?php
$filename = "marks.json";
$fileOpen = fopen($filename, "r");
$fileContent = fread($fileOpen, filesize($filename));
$fileContent = json_decode($fileContent);
// Диаграмма будет представлена для значений следующего массива:
$values = array();
for ($i = 0; $i < count($fileContent); $i++) {
    $values[$i] = $fileContent[$i];
}
fclose($fileOpen);
// Количество столбцов диаграммы:
$columns = count($values);
// Задаем щирину и высоту всего изображения
$width = 1500;
$height = 1000;
// Задаем пространство между колонками:
$padding = 2;
// Получаем ширину одной колонки:
$column_width = ($width-50) / $columns;
// Создаем переменные
$im = imagecreate($width, $height);
$gray = imagecolorallocate($im, 0xcc, 0xcc, 0xcc);
$gray_lite = imagecolorallocate($im, 0xce, 0xee, 0xee);
$gray_dark = imagecolorallocate($im, 0x7f, 0x7f, 0x7f);
$white = imagecolorallocate($im, 0xaf, 0xff, 0xff);
// Заполняем фон картинки
imagefilledrectangle($im, 0, 0, $width, $height, $white);
$maxv = 0;
// Вычисляем максимум
for ($i = 0; $i < $columns; $i++)
    $maxv = max($values[$i], $maxv);
// Рисуем каждую колонку
for ($i = 0; $i < $columns; $i++) {
    $column_height = $values[$i];
    $x1 = ($i * $column_width)+50;
    $y1 = $height - $column_height;
    $x2 = ((($i + 1) * $column_width) - $padding)+50;
    $y2 = $height;
    imagefilledrectangle($im, $x1, $y1, $x2, $y2, $gray);
    //для 3D эффекта
    imageline($im, $x1, $y1, $x1, $y2, $gray_lite);
    imageline($im, $x1, $y2, $x2, $y2, $gray_lite);
    imageline($im, $x2, $y1, $x2, $y2, $gray_dark);
}
$black = imagecolorallocate($im, 0, 0, 0);
imageline($im, 27, 0, 27, $height, $black);
$distance1 = $height / 20;
$distance2 = ($height-1) / 20;
$count = $height - 1;
$numCount = 0;
for ($i = 0; $i <= $distance1; $i++) {
    imagestring($im, 1, 0, $count-10, (int)$numCount, $black);
    imageline($im, 20, $count, 34, $count, $black);
    $numCount += $distance1;
    $count -= $distance2;
}
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);
