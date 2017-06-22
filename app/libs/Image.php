<?php

class Image
{
    public static function upload($file)
    {
        $target_dir = CLIENT . "img/";
        $target_file = $target_dir . basename($file["name"]);
        if (!move_uploaded_file($file["tmp_name"], $target_file)) {

            $_SESSION['mess'] = "Sorry, there was an error uploading your file.";
            header("location: index.php");
        }
        return false;
    }

    public static function getImage($image)
    {
        $link = CLIENT . "img/" . $image;

        if (file_exists($link)) {
            return PATH . 'img/' . $image;
        } else
            $link = PATH . "img/no-image.jpg";
        return $link;
    }
}

?>

