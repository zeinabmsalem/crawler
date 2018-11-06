<?php

 $counter = 1;

  $x = 0;

do {
    
        $url = "https://www.newhome.ch/de/kaufen/suchen/haus_wohnung/kanton_zuerich/liste.aspx?p=". $counter;

$agent= 'Mozilla/5.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

 fopen("cookies.txt", "w");

$header = array('GET / HTTP/1.1',
        'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8; charset=UTF-8',
        'Accept-Language:en-US,en;q=0.8',
        'Accept-Encoding:gzip, deflate, br',
        'Cache-Control:max-age=0',
        'Connection:keep-alive',
       // 'Set-Cookie: datadome=.bLZf5Fk4VZen~7Mf3Q4Bf_ojPO7x5Ox516EPGcmO0l',
        'Host:ad.yieldlab.net',
        'DNT:1',
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: newhome.ch",
                                                "Connection: keep-alive",
                                                "Upgrade-Insecure-Requests: 1",
                                                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36",
                                                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
                                                "Cookie:cookiedata",
                                                "DNT:1",
                                                "Accept-Encoding:gzip, deflate, sdch",
                                                "Accept-Language: en-US,en;q=0.8"));
curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_ENCODING ,"");
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    //curl_setopt($ch, CURLOPT_HEADER, $header);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
    curl_setopt($ch, CURLOPT_CAINFO, $_SERVER['DOCUMENT_ROOT'] .  "/../cacert-2017-09-20.pem");


    $result=curl_exec($ch);
   
    curl_close($ch);


$html = $result;


$dom = new DOMDocument();

//libxml_use_internal_errors(true);

@$dom->loadHTML($html);

//libxml_clear_errors();


$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//div[@class='col-xs-12 col-sm-4 image']");


echo "Links for page number ".  $counter. "<br/><br/>";

    for ($i=0; $i < $hrefs->length ; $i++) { 
        
        $href = $hrefs->item($i);

        $url = $href->getAttribute('onclick');

        echo "https://www.homegate.ch". $url. "<br/>";
    }

        echo "<br/>";
        $counter++;

        $x++;

} while ( $x < 2);



?>


                        