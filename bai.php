<?php
require_once('simple_html_dom.php');
$wp_did_header = true;
require_once($_SERVER['DOCUMENT_ROOT'] . '/index.php');
$matches = preg_grep('/wp-blog-header.php/', get_included_files());
if (!empty($matches)) {
    $abspath = dirname(reset($matches)) . '/';
    define('ABSPATH', $abspath);
    require_once(ABSPATH . 'wp-load.php');
}
if(isset($_POST) && $_POST){
    $url = $_POST['url'] ?  $_POST['url'] : '';
    $classTitle =  $_POST['classtitle'] ?  $_POST['classtitle'] : '';
    $classContent =  $_POST['classdes'] ?  $_POST['classdes'] : '';
    function scrapingData($data,$classTitle,$classContent) {
        $html = new simple_html_dom();
        $html->load($data);
        $myData = array();
		/*thach pham : h1[class='single-post-title'] div[class='theiaStickySidebar']*/
        //    Tìm các thông tin cần thiết
        $myData['title'] = $html->find("h1", 0)->innertext;
        $myData['content'] = $html->find("div[class='post-detail']", 0)->innertext;
        return json_encode($myData);
    }
    function getDataFromUrl ($url, $timeout = 30) {
        $curl = curl_init();
        curl_setopt( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $curl, CURLOPT_URL, $url );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
        curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $curl, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        $content = curl_exec( $curl );
        return $content;
    }
    
    $dataHtml = getDataFromUrl($url);
    
    
    $data = scrapingData($dataHtml,$classTitle,$classContent);
   $deCodeData  =  json_decode($data);
   /*******************************************************
    ** POST VARIABLES
    *******************************************************/
   
   $postType = 'post'; // set to post or page
   $userID = 1; // set to user id
   $categoryID = '40'; // set to category id.
   $postStatus = 'draft';  // set to future, draft, or publish
   
   $leadTitle = $deCodeData->title;
   
   $leadContent = $deCodeData->content;
   
   /*******************************************************
    ** TIME VARIABLES / CALCULATIONS
    *******************************************************/
   // VARIABLES
   $timeStamp = $minuteCounter = 0;  // set all timers to 0;
   $iCounter = 1; // number use to multiply by minute increment;
   $minuteIncrement = 1; // increment which to increase each post time for future schedule
   $adjustClockMinutes = 0; // add 1 hour or 60 minutes - daylight savings
   
   // CALCULATIONS
   $minuteCounter = $iCounter * $minuteIncrement; // setting how far out in time to post if future.
   $minuteCounter = $minuteCounter + $adjustClockMinutes; // adjusting for server timezone
   
   $timeStamp = date('Y-m-d H:i:s', strtotime("+$minuteCounter min")); // format needed for WordPress
   
   /*******************************************************
    ** WordPress Array and Variables for posting
    *******************************************************/
   
   $new_post = array(
       'post_title' => $leadTitle,
       'post_content' => $leadContent,
       'post_status' => $postStatus,
       'post_date' => $timeStamp,
       'post_author' => $userID,
       'post_type' => $postType,
       'post_category' => array($categoryID)
   );
   
   /*******************************************************
    ** WordPress Post Function
    *******************************************************/
   
   $post_id = wp_insert_post($new_post);
   
   /*******************************************************
    ** SIMPLE ERROR CHECKING
    *******************************************************/
   
   $finaltext = '';
   
   if($post_id){
       
       $finaltext .= 'Yay, I made a new post.<br>';
       
   } else{
       
       $finaltext .= 'Something went wrong and I didn\'t insert a new post.<br>';
       
   }
   
   
}

?>


<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post">
Url:<br>
<input type="text" name="url" value="http://google.com/">
<br><br>
<input type="submit" value="Submit">
</form>
</body>
</html>