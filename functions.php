<?php
function directoryReader($directory, array $exclude = array('.', '..')){
    $files = [];

    if (!is_dir($directory)) {
        return null;
    }

    if (!($fileDirectory = opendir($directory))) {
        return null;
    }

    while (($file = readdir($fileDirectory)) !== false) {
        if (in_array($file, $exclude)) {
            continue;
        }

        $files[] = $directory . '/' . $file;
    }

    closedir($fileDirectory);

    return $files;
}