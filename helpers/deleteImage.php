<?php

function deleteImage(array $name_files, string $pathImg): bool
{
    $all_deleted = true;
    $pathImg = rtrim($pathImg, '/\\') . '/';

    foreach ($name_files as $file) {
        $fullPath = $pathImg . $file;

   
        if (file_exists($fullPath)) {
            $res = unlink($fullPath);
            if (!$res) {
                $all_deleted = false; 
            }
        }
    }

    return $all_deleted;
}
