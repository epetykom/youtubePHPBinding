<?php
include('service.php');
$start_time = microtime_float();
/*$data = file_get_contents_curl("http://gdata.youtube.com/feeds/api/playlists/PL9A19B529403381E8");
            $xml = simplexml_load_string($data);*/
$xml = youtube::fetchXMLfromVideoUrl("https://www.youtube.com/watch?v=_pv2fZJvPnI&feature=g-u-u");
$video = new youtubeVideo($xml);

print_r($xml);
//echo count($playlist->getVideos());
?>

<pre>
<?php
echo $video->getThumbnailLink(youtube::BIG);
echo '<br />';
$end_time = microtime_float();
echo '<br />Tid: ', $end_time - $start_time, '<br />';
?>
</pre>