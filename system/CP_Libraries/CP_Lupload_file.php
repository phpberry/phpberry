<?php
if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
    class CP_Lupload_file {

       
        public function upload_file( $config = array() ) {
            
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
                
                $result=$filrHandle->upload_file( $config );  */
            $result = array();
    
            $file=$config['file'];
            $rename=$config['rename'];
            $isimage=$config['isimage'];            
            $overwrite=$config['overwrite'];
            $minsize=$config['minsize'];
            $maxsize=$config['maxsize'];
            $format = $config['format']; 
            $foldername = $config['foldername']; 
            $_FILES["fileToUpload"]["name"]=$file;
            
            $minsize=$minsize*1000; //kb
            $maxsize=$maxsize*1000; //kb
            if($rename){
                 $_FILES["fileToUpload"]["name"] = time().round(microtime(TRUE)) . '.' . strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
            }
            if(!empty($foldername)){
                if(!is_dir(ASSETS_PATH.$foldername)){
                   mkdir(ASSETS_PATH.$foldername, 0777, true);
                  }                
                $target_dir = ASSETS_PATH.$foldername.'/';
            }else{
                $target_dir = ASSETS_PATH;
            }
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if($isimage) {                                
                if(!(is_array(getimagesize($_FILES["fileToUpload"]["tmp_name"])))) {                    
                    $uploadOk = 0;
                    $result['result'] = false;
                    $result['error'] = "Uploaded file is not an image.";
                    return $result;                    
                }
            }
            // Check if file already exists
            if(!$overwrite) {
                if (file_exists($target_file)) {                    
                    $uploadOk = 0;
                    $result['result'] = false;
                    $result['error'] = "Sorry, file already exists.";
                    return $result;
                }
            }            
            
            if(!empty($format)){
                // Allow certain file formats
                if(!(in_array($imageFileType,$format))) {
                    $uploadOk = 0;
                    $result['result'] = false;
                    $result['error'] = "Sorry, this format not allowed.";
                    return $result;
                }
            }
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > $maxsize) {
                $uploadOk = 0;
                $result['result'] = false;
                $result['error'] = "Sorry, your file is too large.";
                return $result;
            }elseif ($_FILES["fileToUpload"]["size"] < $minsize) {
                $uploadOk = 0;
                $result['result'] = false;
                $result['error'] = "Sorry, your file is too small.";
                return $result;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 1) {                
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                   // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                    $result['result'] = true;
                    $result['filename'] = $_FILES["fileToUpload"]["name"];
                    return $result;
                } else {
                    $result['result'] = false;
                    $result['error'] = "Sorry, there was an error to uploading your file.";
                    return $result;
                }
            }            
        }

        public function delete_file( $file,$foldername = "" ) {
            $result = array();
            if(!empty($foldername)){                
                $target_file = ASSETS_PATH.$foldername.'/'.$file;
            }else{
                $target_file = ASSETS_PATH.$file;
            }            
            if (!unlink($target_file)) {  
                $result['result'] = false;
                $result['error'] = "Error deleting $file";
                return $result;             
            } else{
                 if(!empty($foldername)){
                    if (count(scandir((ASSETS_PATH.$foldername)))==2) {
                      rmdir(ASSETS_PATH.$foldername);
                    }                
                }
                $result['result'] = true;
                $result['filename'] = $file;
                return $result;
            }            
        }
    }