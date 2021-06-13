<?php
namespace System\Libraries;
/**
 * Upload Library
 */
class Upload{

    public $file_temp;
    public $file_size;
    public $file_name;

    public $upload_path = 'app/uploads/';
    public $allowed_types = 'gif|jpg|png';
    public $max_size = 100;
    public $max_width = 1024;
    public $max_height = 768;

    public function init($config)
    {
        $this->upload_path = $config['upload_path'];
        $this->allowed_types = $config['allowed_types'];
        $this->max_size = $config['max_size'];
        $this->max_width = $config['max_width'];
        $this->max_height = $config['max_height'];
    }

    public function do_upload($field = 'userfile')
    {

        if (isset($_FILES[$field]))
		{
			$_file = $_FILES[$field];
        }
        
        $this->file_temp = $_file['tmp_name'];
        $this->file_size = $_file['size'];
        $this->file_name = $_file['name'];


        if ( ! @copy($this->file_temp, $this->upload_path.$this->file_name))
		{
			if ( ! @move_uploaded_file($this->file_temp, $this->upload_path.$this->file_name))
			{
				return false;
            }else{
                return true;
            }
            
        }else{
            return true;
        }
        
        
    }
}




