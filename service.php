<?php
    include("classes/playlist.class.php");
    include("classes/video.class.php");
    //include("classes/youtube.class.php");

    function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch,CURLOPT_TIMEOUT,60*60*60);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

class youtube {
    const SMALLFIRST = 1;
    const SMALLSECOND = 2;
    const SMALLTHIRD = 3;
    const BIG = 0;
    
    public static function fetchVideo($link){
            
    }
    
    public static function fetchVideoID($url){
        $videoID = (preg_match('%(?:youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) ? $match[1] : '';
        return $videoID;
    }
    
    public static function fetchPlaylistID($url){
        $url = parse_url($url);
        parse_str($url['query'],$q);
        $list = $q['list'];
        return $list;   
    }
    
    public static function fetchXMLfromPlaylistUrl($url){
        $playlistID = self::fetchPlaylistID($url);
        $xmlURL = "http://gdata.youtube.com/feeds/api/playlists/$playlistID";
        $data = file_get_contents_curl("http://gdata.youtube.com/feeds/api/playlists/$playlistID");
        $xml = simplexml_load_string($data);
        return $xml;
    }
    
    public static function fetchXMLfromVideoUrl($url){
        $videoID = self::fetchVideoID($url);
        var_dump($videoID);
        echo '<br />';
        $xmlURL = "http://gdata.youtube.com/feeds/api/videos/$videoID";
        $data = file_get_contents_curl("http://gdata.youtube.com/feeds/api/videos/$videoID");
        $xml = simplexml_load_string($data);
        return $xml;
    }
}
?>