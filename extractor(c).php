
<?php

  $counter = 1;

  $x = 0;
  

do {
	
 $pageurl = "https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=".$counter;

  //echo $pageurl;

  $html = file_get_contents($pageurl);


$dom = new DOMDocument();

libxml_use_internal_errors(true);

@$dom->loadHTML($html, LIBXML_NOWARNING);

//libxml_clear_errors();


$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a[@class='detail-page-link box-row--link']");


echo "Links for page number ".  $counter. "<br/><br/>";

	for ($i=0; $i < $hrefs->length ; $i++) { 
		
	    $href = $hrefs->item($i);

	    $url = $href->getAttribute('href');

	    echo "https://www.homegate.ch". $url. "<br/>";
	}

		echo "<br/>";
	$counter++;

	$x++;


} while ( $x < 2);



?>