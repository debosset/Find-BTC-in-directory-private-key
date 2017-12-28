<?php
// You will have to download it from sourceforge and include it in the same directory than this file
include_once('simple_html_dom.php');
// Change your email here
$youremail = 'youremail@gmail.com';

function bigNumber() {
    $output = 1;
    for($i=0; $i<20; $i++) {
        $output .= rand(0,9);
    }
    return $output;
}

function removeSpace($val){
 $val = str_replace(' ', '', $val);
 $val = preg_replace('/\s+/', '', $val);
 return $val;

}


$min = 1;
$max = 100000000000000000000000000000000000000000000000000000000;
   

while ($min < $max) {
    
   $pageNumber = bigNumber();
    
   $url = 'http://washen.me/'.$pageNumber; 
    
    $base = $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $base);
    curl_setopt($curl, CURLOPT_REFERER, $base);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str = curl_exec($curl);
    curl_close($curl);
    
    
    
    $html_base = new simple_html_dom();
    $html_base->load($str);


     foreach ($html_base->find('pre > span') as $row) {
         
        $privateKey =  $row->find('span', 0)->plaintext;
        $uncompressPublicKey =  $row->find('a', 1)->plaintext;
        $uncompressValue = $row->find('span', 1)->plaintext;
        $compressPublicKey =  $row->find('a', 2)->plaintext;
        $compressValue = $row->find('span', 2)->plaintext;
        
      
        $privateKey = removeSpace($privateKey);
        $uncompressPublicKey = removeSpace($uncompressPublicKey);
        $uncompressValue = removeSpace($uncompressValue);
        $compressPublicKey = removeSpace($compressPublicKey);
        $compressValue = removeSpace($compressValue);
         

         if($uncompressValue > 0 || $compressValue >0){
        
         echo 'Find coin :) :) :) :) :) :) - 
         ';
         echo 'Private Key : ' .$privateKey. ' - 
         ';
         echo 'Uncompress Public Key : ' .$uncompressPublicKey. ' - 
         ';
         echo 'Uncompress Value : ' .$uncompressValue. ' - 
         ';
         echo 'Compress Public Key : ' .$compressPublicKey. ' - 
         ';
         echo 'Compress Value : ' .$compressValue. ' - 
         ';
             
$message =  'Private Key : ' .$privateKey. ' - Uncompress Public Key : ' .$uncompressPublicKey.' - Uncompress Value : '.$uncompressValue.' - Compress Public Key : ' .$compressPublicKey. ' - Compress Value : ' .$compressValue;
             
          
          mail($youremail, 'Get BTC Founded!', $message);
           
         } else {

             echo '-';
             
         }

        
        
     }
    
    echo '
    Page number tested: ' .$pageNumber. '
    
    ';
    
    $min++;
    
      
    echo 'Loop : ' .$min. '
    
    ';
}
?>