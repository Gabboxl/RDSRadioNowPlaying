<?php

function nowPlaying($returnvariable = null)
{
    //from https://github.com/Gabboxl/RDSRadio
    $url = 'https://icstream.rds.radio/status-json.xsl';  //vekkio http://stream1.rds.it:8000/status-json.xsl
    $jsonroba = file_get_contents($url);
    $jsonclear = json_decode($jsonroba, true);
    $metadata = explode('*', $jsonclear['icestats']['source'][15]['title']);

    if ($returnvariable == 'jsonclear') {
        return $jsonclear['icestats']['source'][15]['title'];
    }

    return $metadata;
}

function clearLine()
{
    echo "\033[2K\r";
}

$icsd = 5;
$miao = nowPlaying("jsonclear");
while(1){
  if($icsd == 0){
    echo "\033[5D";
    $miao = nowPlaying("jsonclear");
    echo($miao."    (aggiornamento...)"."\r");
    $icsd = 5;
    sleep(1);
  }else{
    clearLine();
    echo($miao."    ($icsd)"."\r");
    $icsd--;
    sleep(1);
  }
}
