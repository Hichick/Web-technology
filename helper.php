<?php

/**
 * @author Hichas
 * @copyright 2015
 */

class helper {
    
    public function getRandomFileName($path, $extension='') // Функция для генерирования рандомного имени
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
 
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
 
        return $name;
    }
}

?>