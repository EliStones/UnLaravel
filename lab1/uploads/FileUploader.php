<?php
    class FileUploader{
        private static $target_directory = "uploads/";
        private static $size_limit = 50000;
        private static $uploadOk = false;
        private $file_original_name;
        private $file_type;
        private $file_size;
        private $final_file_name;

        function __construct()
        {
            $this->file_original_name = basename($_FILES["fileToUpload"]["name"]);
            $this->file_type = basename($_FILES["fileToUpload"]["type"]);
            $this->file_size = basename($_FILES["fileToUpload"]["size"]);
            $this->final_file_name = basename($_FILES["fileToUpload"]["tmp_name"]);
        }

        public function setOriginalName($file_original_name)
        {
            $this->file_original_name = $file_original_name;
        }

        public function getOriginalName()
        {
            return $this->file_original_name;   
        }

        public function getFileType()
        {
            return $this->file_type; 
        }

        public function setFileType($file_type)
        {       
            $this->file_type = $file_type;
        }

        public function getFileSize()
        {
            return $this->file_size; 
        }

        public function setFileSize($file_size)
        {
            $this->file_size = $file_size;

            return $this->file_size;
        }

        public function setFinalFileName($final_file_name)
        {
            $this->final_file_name = $final_file_name;
        }

        public function getFinalFileName()
        {
            return $this->final_file_name; 
        }

        public function fileAlreadyExists()
        {
            //Comments used in debugging
            //echo $this->file_original_name."  ";
            //echo getcwd()."  ";
            if (file_exists($this::$target_directory.$this->file_original_name)) {
                return true;
            }else{
                //echo "File Already Exists";
                return false;
            }
        }

        public function saveFilePathTo()
        {
            //Returns file path
            return $final_file_name = $this::$target_directory. $this->file_original_name;
            
        }

        public function moveFile()
        {
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $this->final_file_name)){
                return true;
            };

            return false;

        }
        
        //Type validation is done
        public function fileTypeIsCorrect()
        {
            //Accepted filetypes - jpg, png, bmp
            if ($this->file_type == "jpg" || $this->file_type == "png" || $this->file_type == "jpeg"){
                return true;
            }
            else {
                return false;
            }
            

        }

        public function fileSizeIsCorrect()
        {
            $file_size = $this->getFileSize();
            if ($this->file_size <= $this::$size_limit) {
                return true;
            }

            return false;
        }

        public function fileWasSelected()
        {
            if($_FILES["fileToUpload"]["error"] == 4){
                return false;
            }
            return true;
        }

        public function uploadFile()
        {
            $this->fileAlreadyExists();
            if ($this->fileAlreadyExists()) {
                //echo "File already Exists";
                $_SESSION["upload-errors"] = "File already Exists";
            } 
            if (!$this->fileTypeIsCorrect()) {
                //echo "Only jpg, jpeg, png file types allowed";
                $_SESSION["upload-errors"] = "Only jpg, jpeg, png file types allowed";
            }
            if (!$this->fileSizeIsCorrect()) {
                //echo "File should be less than ".($this::$size_limit/1000)." Kb";
                $_SESSION["upload-errors"] = "File should be less than ".($this::$size_limit/1000)." Kb";
            }
            if(!$this->fileWasSelected()){
                //echo "No file was selected";
                $_SESSION["upload-errors"] = "No file was selected";
            }

            if ($this->fileWasSelected()) {
                if (!$this->fileAlreadyExists() && $this->fileTypeIsCorrect() && $this->fileSizeIsCorrect()) {
                    $this::$uploadOk = true; 
                    //echo "Working";
                }
            }
            
            
            if($this::$uploadOk == true){
                $this->final_file_name = $this->saveFilePathTo();
                if($this->moveFile()){
                    //echo "File Uploaded Successfully";
                };
                return true;
            }
            return false;
        }



    }
?>