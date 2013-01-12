<?php
class youtubePlaylist
{        
    private $playlistID;
    private $updated;
    private $tags = array();
    private $title;
    private $subtitle;
    private $authorName;
    private $authorURI;
    private $videos;
    private $description;
    private $time;
    private $xml;
    private $startIndex;
    private $last;
    
    public function __construct($xml) {
        
        
        $this->time         = time();
        $this->startIndex   = 1;
        $idArray            = explode("/", $xml->id);
        $this->playlistID   = end($idArray);
        $this->xml          = $xml;
        $this->updated      = $xml->updated;
        $this->title        = $xml->title[0];
        $this->subtitle     = $xml->subtitle;
        $this->authorName   = $xml->author->name;
        $this->authorURI    = $xml->author->uri;
        $this->videos       = new ArrayObject();
        $this->description  = $xml->subtitle;
        
        foreach($xml->category AS $tag)
        {
            $tag            = (array)$tag;
            $this->tags[]   = $tag['@attributes']['term'];
        }
        $this->last = (array)$xml->link[4];
        
        $start = 1;
        $i = 0;
        do {
            $data = file_get_contents_curl("http://gdata.youtube.com/feeds/api/playlists/{$this->playlistID}?start-index={$start}&max-results=50");
            $xml = simplexml_load_string($data);
            foreach($xml->entry as $video)
            {
                $this->videos->append(new youtubeVideo($video));
                
            }                   
        $start+=50;    
        } while(empty($last) === false  && $this->last['@attributes']['rel'] === 'next');
    }
    public function getXML(){return $this->xml;}
    public function getTime(){return $this->time;}
    public function getPlaylistID(){return $this->playlistID;}
    public function getTitle(){return $this->title;}
    public function getSubTitle(){return $this->subtitle;}
    public function getAuthorName(){return $this->authorName;}
    public function getAuthorURI(){return $this->authorURI;}
    public function getUpdated(){return $this->updated;}
    public function getVideos(){return $this->videos;}
    public function getDescription(){return $this->description;}
    public function getLast(){return $this->last;}
}
?>