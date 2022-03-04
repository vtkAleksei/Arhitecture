<?php
function treeDir($folder = "dir_1", $space)
{
    /* Получаем полный список файлов и каталогов внутри $folder */
    $obj = new DirectoryIterator($folder);
    foreach ($obj as $file) {
        /* Отбрасываем текущий и родительский каталог */
        if (($file == '.') || ($file == '..')) continue;
        $dir = $folder . '/' . $file; //Получаем полный путь к файлу
        /* Если это директория */
        if (is_dir($dir)) {
            /* Выводим, делая заданный отступ, название директории */
            echo $space . $file . "<br />";
            /* С помощью рекурсии выводим содержимое полученной директории */
            treeDir($dir, $space . '&nbsp;&nbsp;');
        }
        /* Если это файл, то просто выводим название файла */ else echo $space . $file . "<br />";
    }
}
/* Запускаем функцию для текущего каталога */
treeDir("./", "");
