<?php
class Image {
    function upload($file) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($file["name"]);

        if (!move_uploaded_file($file["tmp_name"], $target_file))  {
            var_dump($target_file);
            exit();
            $_SESSION['mess'] = "Sorry, there was an error uploading your file.";
            header("location: index.php");
        }
        return false;
    }
    function getImage($image) {
        if ($image) {
            $link =  "img/" . $image;
        } else
            $link = "img/no-image.jpg";
            return $link;
        }
    }

        ?>

