<?php
$target_dir = "./asset/usr/";
$target_file = $target_dir . basename($_FILES["profileImg"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["profileImg"]["tmp_name"]);
    if ($check !== false) {
        echo "file id an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "file is not image.";
        $uploadOk = 0;
    }
}

// Mengecek apakah file sudah ada 
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Menggatur ukuran file maksimal yang dapat diterima
if ($_FILES["profileImg"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Menggatur file apa saja yang dapat diterima
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

//! FIXME still error in moving tmp file to target dir
// NOTE try change dir permission, see if its work

// Mengecek apakah niali $uploadOk sama dengan 0 
// yang berarti error atau 1 yang berarti tidak ada error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // jika semua ok, maka akan dicoba upload file
} else {
    var_dump(is_dir($target_dir) && is_writable($target_dir));
    // if (move_uploaded_file($_FILES["profileImg"]["tmp_name"], $target_file)) {
    //     echo "The file " . htmlspecialchars(basename($_FILES["profileImg"]["name"])) . " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
}
