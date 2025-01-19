<?php

header ("Content-Type:text/xml");

include 'common.php';

$output = array();
$source = 'EUR';
$sourcerate = 1;
$target = 'THB';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['source'])) {
    $source = htmlspecialchars($_GET['source'], ENT_QUOTES);
  }
  if (isset($_GET['target'])) {
    $target = htmlspecialchars($_GET['target'], ENT_QUOTES);
  }
}

$url = "https://api.frankfurter.dev/v1/latest?base=${source}";
$get_json = callAPI('GET', $url, false);
$get_data = json_decode($get_json, true);
$targetrate = $get_data["rates"][$target];
$date = $get_data["date"];

$xw = xmlwriter_open_memory();
xmlwriter_set_indent($xw, 4);
$res = xmlwriter_set_indent_string($xw, ' ');

xmlwriter_start_document($xw, '1.0', 'UTF-8');

xmlwriter_start_element($xw, 'tile');
  xmlwriter_start_element($xw, 'visual');

    xmlwriter_start_element($xw, 'binding');
      xmlwriter_start_attribute($xw, 'template');
        xmlwriter_text($xw, 'TileMedium');
      xmlwriter_end_attribute($xw);

      xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${sourcerate} ${source}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${targetrate} ${target}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "caption");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${date}");
      xmlwriter_end_element($xw);
      
    xmlwriter_end_element($xw); // TileMedium

    xmlwriter_start_element($xw, 'binding');
      xmlwriter_start_attribute($xw, 'template');
        xmlwriter_text($xw, 'TileWide');
      xmlwriter_end_attribute($xw);

      xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${sourcerate} ${source}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${targetrate} ${target}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "caption");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${date}");
      xmlwriter_end_element($xw);
      
    xmlwriter_end_element($xw); // TileWide

    xmlwriter_start_element($xw, 'binding');
      xmlwriter_start_attribute($xw, 'template');
        xmlwriter_text($xw, 'TileLarge');
      xmlwriter_end_attribute($xw);

      xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${sourcerate} ${source}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "body");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${targetrate} ${target}");
      xmlwriter_end_element($xw);

	  xmlwriter_start_element($xw, 'text');
		xmlwriter_start_attribute($xw, 'hint-weight');
		  xmlwriter_text($xw, "caption");
        xmlwriter_end_attribute($xw);
		xmlwriter_start_attribute($xw, 'hint-wrap');
		  xmlwriter_text($xw, "true");
        xmlwriter_end_attribute($xw);
        xmlwriter_text($xw, "${date}");
      xmlwriter_end_element($xw);
      
    xmlwriter_end_element($xw); // TileLarge

  xmlwriter_end_element($xw); // visual
xmlwriter_end_element($xw); // tile

xmlwriter_end_document($xw);

echo xmlwriter_output_memory($xw);

?>
