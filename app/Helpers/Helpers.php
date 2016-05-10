<?php

// 占位图
function empty_image()
{
    return '';
}

// 相对路径
function relative_path($path1, $path2)
{
    $arr1 = explode(DIRECTORY_SEPARATOR, $path1);
    $arr2 = explode(DIRECTORY_SEPARATOR, $path2);
    $diff = array_diff_assoc($arr1, $arr2);
    $count = count($diff);

    $path = '';
    for ($i = 0; $i < $count - 1; $i++) {
        $path .= '..' . DIRECTORY_SEPARATOR;
    }
    $path .= implode(DIRECTORY_SEPARATOR, $diff);

    return $path;
}