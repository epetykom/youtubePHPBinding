<?php
class youtubeVideo{
    private $xmlData;
    private $authData;
    private $linkData;
    private $gLinkData;
    
    private $xml;
    private $title;
    private $videoId;
    private $description;
    private $tags = array();
    private $authorName;
    private $authorLink; 
    private $updated;
    private $time;
    private $order;
    
    private $content;
    
    public function __construct($xml) {
        
        $this->authData = (array)$xml->author;
        $this->linkData = (array)$xml->link[0];
        $this->gLinkData = (array)$xml->link[3];
        
        $this->time         = time();
        $this->xml          = $xml;
        $this->title        = $xml->title;
        $this->updated      = $xml->updated;
        $this->authorLink   = $xml->author->uri;
        $this->authorName   = $xml->author->name;
        $this->description  = $xml->content;
        $this->order        = 1;
        $this->videoId =    youtube::fetchVideoID((string)$this->linkData['@attributes']['href']);
        foreach($xml->category AS $tag)
        {
            $tag            = (array)$tag;
            $this->tags[]   = $tag['@attributes']['term'];
        }
        
        $this->order++;
    }
    
    public function getXML(){return $this->xml;}
    public function getTitle(){return $this->title;}
    public function getAuthorLink() {return $this->authorLink;}
    public function getVideoID() {return $this->videoId;}
    public function getUpdated() {return $this->updated;}
    public function getAuthorName() {return $this->authorName;}
    public function getDescription() {return $this->description;}
    public function getTags() {return $this->tags;}
    public function getTime() {return $this->time;}
    public function getOrder() {return $this->order;}
    
    public function getAuthData(){return $this->authData;}
    public function getLinkData(){return $this->linkData;}
    public function getGLinkData(){return $this->gLinkData;}
    public function getThumbnailLink($size){return "http://img.youtube.com/vi/$this->videoId/$size.jpg"; }
}
?>