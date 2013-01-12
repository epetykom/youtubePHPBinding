<?php
include('service.php');

//PL9A19B529403381E8
//PLB22EB5A1CCB2153D

$start_time = microtime_float();
$xml = youtube::fetchXMLfromPlaylistURL("https://www.youtube.com/playlist?list=PL9A19B529403381E8");
$playlist = new youtubePlaylist($xml);
?>

<pre>

<?php
$end_time = microtime_float();
echo '<br />Tid: ', $end_time - $start_time, '<br />';
?>

<?php
echo $playlist->getVideos()->count();
echo '<br />';
print_r($playlist->getLast());
echo '<br />';
foreach($playlist->getVideos() as $video) {
    echo $video->getTitle();
    echo'<br />';
    
    echo '<img src='.$video->getThumbnailLink(youtube::SMALLFIRST).' />';
    echo '<br />';
}
?>
</pre>