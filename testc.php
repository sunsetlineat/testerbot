<?php


function curlData($auth, $data) {
    
$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/richmenu");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_POST, 1);

    $headers = array();
    $headers[] = "Authorization: Bearer " . $auth;
    $headers[] = "Content-Type: application/json";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    
    return json_decode($result);
}

function curlImages($menuId, $name, $pathImages, $auth) {
    
    $file_name_with_full_path = realpath($pathImages);
    $postimg = array('myfile'=>'@'.$file_name_with_full_path);
    

    $headers = array();
    $headers[] = '  Content-Type:multipart/form-data';
    $headers[] = "Authorization: Bearer " . $auth;
    $headers[] = 'Content-Type: image/jpeg';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.line.me/v2/bot/richmenu/' . $menuId . '/content');  
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postimg);
    curl_setopt($ch, CURLOPT_HEADER, 1);  
    $data = curl_exec($ch);        
    curl_close($ch);
}