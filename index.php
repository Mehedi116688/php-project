<?php
include "functions.php";

$images = directoryReader('images');

if (!$images) {
    die('No Folder Found');
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <?php
    
        if (isset($_FILES['photo'])) {
            $allowed = ['image/jpg', 'image/png', 'image/jpeg'];

            if (in_array($_FILES['photo']['type'], $allowed)) {
                echo 'only jpg, png, jpeg files are allowed';
            }

            foreach ($_FILES['photo']['tmp_name'] as $key => $erros) {
                $fileName = $_FILES['photo']['name'][$key];
                $fileType = $_FILES['photo']['type'][$key];
                $fileTmp = $_FILES['photo']['tmp_name'][$key];
                $fileSize = $_FILES['photo']['size'][$key];

                $upload = 'images/';
                $rand = rand(100,1000);

                if (move_uploaded_file($fileTmp, $upload . $rand . $fileName)) {
                    $msg =  'Image Upload successfully';
                    echo $msg;
                    header("location: http://localhost:8888/");
                }else {
                    echo 'Error upload';
                }
            }
        }
    ?>

    <div class="p-4">
        
        <div class="flex justify-center mt-4">
            <form method="POST" enctype="multipart/form-data">
                <label for="inputImage">Upload Image</label>
                <input type="file" id="inputImage" name="photo[]" multiple>
                <button type="submit" class="btn bg-blue-500 px-3 py-2 rounded text-white hover:bg-blue-700">Upload</button>
            </form>
        </div>

        <div class="grid grid-cols-3 gap-4 border-t mt-6 justify-center">
            <?php foreach ($images as $image): ?>
                <img class="rounded max-w-full h-auto" src="<?= $image ?>" alt="Image Gallery" width="640" height="480">
            <?php endforeach ?>
        </div>
        
    </div>
</body>
</html>