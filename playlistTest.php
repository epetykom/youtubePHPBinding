<?php
include('service.php');

//PL9A19B529403381E8
//PLB22EB5A1CCB2153D
//PLPReUUSnyBCWWxphMU3OBizT6miqy65YP
$start_time = microtime_float();
$xml = youtube::fetchXMLfromPlaylistURL("https://www.youtube.com/playlist?list=PLPReUUSnyBCWWxphMU3OBizT6miqy65YP");
$playlist = new youtubePlaylist($xml);
$i = 1;
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
    echo 'last: ', $playlist->getLast()['@attributes']['rel'] === 'next';
echo '<br />';
    print_r(!empty($last));
echo '<br />';
echo $playlist->getStartIndex();
echo '<br />';
    echo '<pre>';
    print_r($playlist->getXML());
    echo '</pre>';
    echo '<br/>';


foreach($playlist->getVideos() as $video) {
    echo $i, '. ', $video->getTitle();
    echo'<br />';
    
    echo '<img src='.$video->getThumbnailLink(youtube::SMALLFIRST).' />';
    echo '<br />';
    $i++;
}
?>
</pre>