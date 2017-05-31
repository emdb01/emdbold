<?php 
class TextToSpeech {
    public $mp3data;
    function __construct($text="") {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://api.voicerss.org/?key=3fa478f343744344981a5eb43b32557f&src=$text&hl=en-us");
        }
    }
 
    function setText($text) {
        $text = trim($text);
        if(!empty($text)) {
            $text = urlencode($text);
            $this->mp3data = file_get_contents("http://api.voicerss.org/?key=3fa478f343744344981a5eb43b32557f&src=$text&hl=en-us");
            return $mp3data;
        } else { return false; }
    }
 
    function saveToFile($filename) {
        $filename = trim($filename);
        if(!empty($filename)) {
            return file_put_contents($filename,$this->mp3data);
        } else { return false; }
    }
 
}
?>