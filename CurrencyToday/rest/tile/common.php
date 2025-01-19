<?php

// Function to simplify API calls
function callAPI($method, $url, $data){
    global $HA_TOKEN;
    $curl = curl_init();
 
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
 
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'Authorization: Bearer '.$HA_TOKEN,
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
}

function getStatus($url){
   $get_json = callAPI('GET', $url, false);
   $get_data = json_decode($get_json, true);
   #$get_state = $get_data['state'];
   return $get_data;
}

function getState($url){
  $get_json = callAPI('GET', $url, false);
  $get_data = json_decode($get_json, true);
  $get_state = $get_data['state'];
  return $get_state;
}

?>
