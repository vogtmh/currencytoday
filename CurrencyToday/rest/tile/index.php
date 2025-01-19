<?php

header ("Content-Type:text/xml");

include 'common.php';

$output = array();
$source = 'EUR';
$target = 'THB';

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  if (isset($_GET['source'])) {
    $source = htmlspecialchars($_GET['source'], ENT_QUOTES);
  }
  if (isset($_GET['target'])) {
    $target = htmlspecialchars($_GET['target'], ENT_QUOTES);
  }
}

$source_image = 'fan-white.png';
$target_image = 'fan-white-inactive.png';

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

      xmlwriter_start_element($xw, 'group');

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_attribute($xw, 'hint-weight');
            xmlwriter_text($xw, "1");
          xmlwriter_end_attribute($xw);
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $source);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${source_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_attribute($xw, 'hint-weight');
            xmlwriter_text($xw, "1");
          xmlwriter_end_attribute($xw);
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $target);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${target_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

      xmlwriter_end_element($xw); // group
      
    xmlwriter_end_element($xw); // TileMedium

    xmlwriter_start_element($xw, 'binding');
      xmlwriter_start_attribute($xw, 'template');
        xmlwriter_text($xw, 'TileWide');
      xmlwriter_end_attribute($xw);

      xmlwriter_start_element($xw, 'group');

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_attribute($xw, 'hint-weight');
              xmlwriter_text($xw, "1");
          xmlwriter_end_attribute($xw);
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $source);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${source_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
          xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_attribute($xw, 'hint-weight');
            xmlwriter_text($xw, "1");
          xmlwriter_end_attribute($xw);
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $target);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${target_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

      xmlwriter_end_element($xw); // group
      
    xmlwriter_end_element($xw); // TileWide

    xmlwriter_start_element($xw, 'binding');
      xmlwriter_start_attribute($xw, 'template');
        xmlwriter_text($xw, 'TileLarge');
      xmlwriter_end_attribute($xw);

      xmlwriter_start_element($xw, 'group');

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $source);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${source_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
          xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, $target);
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${target_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

      xmlwriter_end_element($xw); // group
      
    xmlwriter_end_element($xw); // TileLarge

  xmlwriter_end_element($xw); // visual
xmlwriter_end_element($xw); // tile

xmlwriter_end_document($xw);

echo xmlwriter_output_memory($xw);

?>
