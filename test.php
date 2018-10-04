<?php


$sUrl1 = "https://thachpham.com/post-sitemap.xml";
$sUrl2 = "https://nhungdongcodevui.com/sitemap.xml";

$aXmlLinks = array($sUrl1, $sUrl2);
$aOtherLinks = array();
$wp_did_header = true;
require_once('simple_html_dom.php');
//print_r($_SERVER['PWD']); die();

require_once($_SERVER['PWD'] . '/index.php');
$matches = preg_grep('/wp-blog-header.php/', get_included_files());
if (!empty($matches)) {
    $abspath = dirname(reset($matches)) . '/';
    define('ABSPATH', $abspath);
    require_once(ABSPATH . 'wp-load.php');
}
while (!empty($aXmlLinks)) {
    foreach ($aXmlLinks as $i => $sTmpUrl) {
        unset($aXmlLinks[$i]);
        $aTmp = getlinkfromxmlsitemap($sTmpUrl);
        array_push($aOtherLinks, $aTmp);
    }
}
//print_r()

foreach ($aOtherLinks as $key => $url) {
  //  print_r($url); die();
    foreach ($url as $item) {
        $url = str_replace('<loc>', " ", $item);
        $url1 = str_replace('</loc>', " ", $url);
       
        $dataHtml = getDataFromUrl($url1);
          print_r($dataHtml); die();
        $data = scrapingData($dataHtml, $classTitle, $classContent);
        $deCodeData = json_decode($data);
       // print_r($$deCodeData); die();
        /*         * *****************************************************
         * * POST VARIABLES
         * ***************************************************** */

        $postType = 'post'; // set to post or page
        $userID = 1; // set to user id
        $categoryID = '40'; // set to category id.
        $postStatus = 'draft';  // set to future, draft, or publish

        $leadTitle = $deCodeData->title;

        $leadContent = $deCodeData->content;

        /*         * *****************************************************
         * * TIME VARIABLES / CALCULATIONS
         * ***************************************************** */
        // VARIABLES
        $timeStamp = $minuteCounter = 0;  // set all timers to 0;
        $iCounter = 1; // number use to multiply by minute increment;
        $minuteIncrement = 1; // increment which to increase each post time for future schedule
        $adjustClockMinutes = 0; // add 1 hour or 60 minutes - daylight savings
        // CALCULATIONS
        $minuteCounter = $iCounter * $minuteIncrement; // setting how far out in time to post if future.
        $minuteCounter = $minuteCounter + $adjustClockMinutes; // adjusting for server timezone

        $timeStamp = date('Y-m-d H:i:s', strtotime("+$minuteCounter min")); // format needed for WordPress

        /*         * *****************************************************
         * * WordPress Array and Variables for posting
         * ***************************************************** */

        $new_post = array(
            'post_title' => $leadTitle,
            'post_content' => $leadContent,
            'post_status' => $postStatus,
            'post_date' => $timeStamp,
            'post_author' => $userID,
            'post_type' => $postType,
            'post_category' => array($categoryID)
        );

        /*         * *****************************************************
         * * WordPress Post Function
         * ***************************************************** */

        $post_id = wp_insert_post($new_post);
        //print_r($data); die();
    }
//  /  print_r($url); 
}

function getDataFromUrl($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, '400');
    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($curl);
    //print_r($url); die();
    return $content;
}

function scrapingData($data) {
    $html = new simple_html_dom();
    $html->load($data);
    $myData = array();
    /* thach pham : h1[class='single-post-title'] div[class='theiaStickySidebar'] */
    //    Tìm các thông tin cần thiết
    $myData['title'] = $html->find("h1", 0)->innertext;
    $myData['content'] = $html->find("div[class='entry-content']", 0)->innertext;
    return json_encode($myData);
}

function getlinkfromxmlsitemap($sUrl) {
    // echo "Get link from: $sUrl<br>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0");
    curl_setopt($ch, CURLOPT_URL, $sUrl);
    $data = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    $links = array();
    $count = preg_match_all('@<loc>(.+?)<\/loc>@', $data, $matches);
    for ($i = 0; $i < $count; ++$i) {
        $links[] = $matches[0][$i];
    }
    return $links;
}

?>