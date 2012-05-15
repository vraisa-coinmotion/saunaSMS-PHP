<?php
//Author: IhqTzup

/**
 *
 * @param String $phonenumber
 * @param String $message 
 */
function sendSMS($phonenumber, $message){
    // create a new cURL resource
    $ch = curl_init();
    
    $username = ""; //oma-saunalahden käyttäjätunnus
    $password = "";   //oma-saunalahden salasana
    $sender = "";       //viestin lähettäjä
    
    // set header
    $header = "Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
    
    curl_setopt($ch, CURLOPT_URL, "https://oma.saunalahti.fi/settings/smsSend?username=".$username."&password=".$password);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt'); 
   
    // grab URL and pass it to the browser
    curl_exec($ch);

    // close cURL resource, and free up system resources
    curl_close($ch);     
    
    $url = "https://oma.saunalahti.fi/settings/smsSend";

    //set POST variables
    $fields_string = "";
    $fields = array(
                    'sender'=>$sender,
                    'recipients'=>$phonenumber,
                    'send'=>"Lähetä",
                    'size'=>"160",
                    'text'=>urlencode($message)
    );

    //url-ify the data for the POST
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string,'&');

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    curl_setopt($ch,CURLOPT_POST,count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

    //execute post
    $result = curl_exec($ch);

    //close connection
    curl_close($ch);
}
?>
