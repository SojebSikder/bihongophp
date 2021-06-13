<?php
namespace System\Core;
/**
 * Perser Class
 */
class Perser
{
    /**
     * Left Delimeter
     */
    public $l_delim = '{';
    /**
     * right delimiter
     */
    public $r_delim = '}';
    
    // Tags array
    public $tags = [];

    // Template file
    public $template;

    
    public function __construct($templateFile)
    {
        $this->template = $this->getFile($templateFile);

        // If the template file is not accessible
        if(!$this->template) {
            return "Error! Can't load the template file $templateFile";
        }

    } 



    // Render the build template
    public function render()
    {
        $this->replaceTags();

        $this->replaceHTMLTags();
        $this->replaceIncludeTags();

        echo $this->template;
    }

    // Set the {tag} with value
    public function set($tag, $value)
    {
        $this->tags[$tag] = $value;
    }

    public function setReg(){
        $pattern = "<test>(.*)</test>";

        preg_replace($pattern, '$1', null);
    }

    // Get the template file
    public function getFile($file)
    {
        if(file_exists($file))
        {
            /*$file = file_get_contents($file);
            return $file;*/

            if (!ini_get('short_open_tag'))
            {
                $code = eval('?>'.preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($file))));
                echo $code;
            }
            else
            {
                include($file);
            }

            
            $buffer = ob_get_contents();
            @ob_end_clean();
            return $buffer;

        }
        else
        {
            return false;
        }
    }

    // Replaces all {tags} with corresponding values from $tags array
    private function replaceTags()
    {
        foreach ($this->tags as $tag => $value) {
            $this->template = str_replace($this->l_delim.$tag.$this->r_delim, $value, $this->template);
        }

        return true;
    }

    //for html
    private function replaceHTMLTags()
    {
        foreach ($this->tags as $tag => $value) {
            $this->template = str_replace('#'.$tag, $value, $this->template);
        }

        return true;
    }



     private function replaceIncludeTags()
     {
         foreach ($this->tags as $tag => $value) {
             $this->template = str_replace('@include('.$tag.')', $value, $this->template);
         }
 
         return true;
     }
}