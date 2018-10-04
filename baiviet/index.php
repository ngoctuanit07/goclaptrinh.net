<?php
include('../simple_html_dom.php');
require_once 'wp-load.php';
if(isset($_POST) && $_POST){
    $url = $_POST['url'] ?  $_POST['url'] : '';
    $classTitle =  $_POST['classtitle'] ?  $_POST['classtitle'] : '';
    $classContent =  $_POST['classdes'] ?  $_POST['classdes'] : '';
    function scrapingData($data,$classTitle,$classContent) {
        $html = new simple_html_dom();
        $html->load($data);
        $myData = array();
        //    Tìm các thông tin cần thiết
        $myData['title'] = $html->find($classTitle, 0)->innertext;
        $myData['content'] = $html->find($classContent, 0)->innertext;
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
   print_r($deCodeData); die();
   // Set the timezone so times are calculated correctly
   date_default_timezone_set('Europe/London');
   // Create post
   $id = wp_insert_post(array(
       'post_title'    => $deCodeData->title,
       'post_content'  => $deCodeData->content,
       'post_author'   => '1',
       'post_type'     => 'post',
   ));
   if ($id) {
       // Set category - create if it doesn't exist yet
      echo 'done';
      // wp_set_post_terms($id, '45', 'category');
       // Add meta data, if required
   } else {
       echo "WARNING: Failed to insert post into WordPress\n";
   }
   
   
}

?>


<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post">
Title Class<br>
<input type="text" name="classtitle" value="Mickey">
<br>
Content Class:<br>
<input type="text" name="classdes" value="Mouse">
<br><br>
Url:<br>
<input type="text" name="url" value="http://google.com/">
<br><br>
<input type="submit" value="Submit">
</form>
</body>
</html>