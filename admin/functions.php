<?php

function canUpload($file)
{
    if ($file['name'] == '') {
        return false;
    }
    if ($file['size'] == 0) {
        return false;
    }

    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    $types = array('png', 'svg', 'jpg', 'jpeg');
    
    if (!in_array($mime, $types)) {
        return false;
    }
    return true;
}

function makeUpload($file, $type, $default)
{
    if (!canUpload($file)) {
        return $default;
    }
    $name = time() . '_' . $file['name'];

    copy($file['tmp_name'], __DIR__ . "/../images/{$type}/$name");

    return $name;
}