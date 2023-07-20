<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}

class CpLUploadFile
{
    /**
     * @param array $config
     */
    public function uploadFile(array $config = []): array|bool
    {
        // pass value
        /* $config = array(
             'file' => $file,
             'rename' => true,
             'isimage' => true,
             'overwrite' => false,
             'minsize' => 50, //kb
             'maxsize' => 200, //kb
             'format' => array("jpg", "png","gif"), // optional
             'foldername' => 'foldername',
         );

         $result=$fileHandle->uploadFile( $config );  */
        $result = [];

        $file = $config['file'];
        $rename = $config['rename'];
        $isimage = $config['isimage'];
        $overwrite = $config['overwrite'];
        $minsize = $config['minsize'];
        $maxsize = $config['maxsize'];
        $format = $config['format'];
        $folderName = $config['foldername'];
        $_FILES['fileToUpload']['name'] = $file;

        $minsize *= 1000; //kb
        $maxsize *= 1000; //kb
        if ($rename) {
            $_FILES['fileToUpload']['name'] = time() . round(microtime(true)) . '.' . strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
        }
        if (! empty($folderName)) {
            if (! is_dir(ASSETS_PATH . $folderName)) {
                mkdir(ASSETS_PATH . $folderName, 0777, true);
            }
            $target_dir = ASSETS_PATH . $folderName . '/';
        } else {
            $target_dir = ASSETS_PATH;
        }
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if ($isimage) {
            if (! is_array(getimagesize($_FILES['fileToUpload']['tmp_name']))) {
                $uploadOk = 0;
                $result['result'] = false;
                $result['error'] = 'Uploaded file is not an image.';
                return $result;
            }
        }
        // Check if file already exists
        if (! $overwrite) {
            if (file_exists($target_file)) {
                $uploadOk = 0;
                $result['result'] = false;
                $result['error'] = 'Sorry, file already exists.';
                return $result;
            }
        }

        if (! empty($format)) {
            // Allow certain file formats
            if (! in_array($imageFileType, $format)) {
                $uploadOk = 0;
                $result['result'] = false;
                $result['error'] = 'Sorry, this format not allowed.';
                return $result;
            }
        }
        // Check file size
        if ($_FILES['fileToUpload']['size'] > $maxsize) {
            $uploadOk = 0;
            $result['result'] = false;
            $result['error'] = 'Sorry, your file is too large.';
            return $result;
        }
        if ($_FILES['fileToUpload']['size'] < $minsize) {
            $uploadOk = 0;
            $result['result'] = false;
            $result['error'] = 'Sorry, your file is too small.';
            return $result;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk === 1) {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $result['result'] = true;
                $result['filename'] = $_FILES['fileToUpload']['name'];
                return $result;
            }
            $result['result'] = false;
            $result['error'] = 'Sorry, there was an error to uploading your file.';
            return $result;
        }
        return false;
    }

    /**
     * @return array
     */
    public function deleteFile(string $file, string $folderName = ''): array
    {
        $result = [];
        if (! empty($folderName)) {
            $target_file = ASSETS_PATH . $folderName . '/' . $file;
        } else {
            $target_file = ASSETS_PATH . $file;
        }
        if (! unlink($target_file)) {
            $result['result'] = false;
            $result['error'] = "Error deleting {$file}";
            return $result;
        }
        if (! empty($folderName)) {
            if (count(scandir(ASSETS_PATH . $folderName)) === 2) {
                rmdir(ASSETS_PATH . $folderName);
            }
        }
        $result['result'] = true;
        $result['filename'] = $file;
        return $result;
    }
}
