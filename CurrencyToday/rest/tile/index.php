<?php

header ("Content-Type:text/xml");

include 'common.php';

$output = array();

$devicelist = array('living_room', 'max', 'oat');

foreach ($devicelist as $device) {
    $output['devices']["$device"]['state'] = 'heat';
    $output['devices']["$device"]['current_temperature'] = 18;
    $output['devices']["$device"]['target_temperature'] = 21;
}

$living_room_state = $output['devices']["living_room"]['state'];
switch ($living_room_state) {
  case 'cool':
          $living_room_image = 'fan-white.png';
          break;
  case 'heat':
          $living_room_image = 'fan-white.png';
          break;
  default: 
          $living_room_image = 'fan-white-inactive.png';
          break;
}

$max_state = $output['devices']["max"]['state'];
switch ($max_state) {
  case 'cool':
          $max_image = 'fan-white.png';
          break;
  case 'heat':
          $max_image = 'fan-white.png';
          break;
  default:
          $max_image = 'fan-white-inactive.png';
          break;
}

$oat_state = $output['devices']["oat"]['state'];
switch ($oat_state) {
  case 'cool':
          $oat_image = 'fan-white.png';
          break;
  case 'heat':
          $oat_image = 'fan-white.png';
          break;
  default:
          $oat_image = 'fan-white-inactive.png';
          break;
}

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
            xmlwriter_text($xw, "Living");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${living_room_image}");
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
            xmlwriter_text($xw, "Max");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${max_image}");
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
            xmlwriter_text($xw, "Oat");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${oat_image}");
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
            xmlwriter_text($xw, "Living");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${living_room_image}");
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
            xmlwriter_text($xw, "Max");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${max_image}");
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
            xmlwriter_text($xw, "Oat");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${oat_image}");
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
            xmlwriter_text($xw, "Living");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${living_room_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
          xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, "Max");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${max_image}");
            xmlwriter_end_attribute($xw);
          xmlwriter_end_element($xw);
        xmlwriter_end_element($xw);

        xmlwriter_start_element($xw, 'subgroup');
          xmlwriter_start_element($xw, 'text');
            xmlwriter_start_attribute($xw, 'hint-align');
              xmlwriter_text($xw, "center");
            xmlwriter_end_attribute($xw);
            xmlwriter_text($xw, "Oat");
          xmlwriter_end_element($xw);
          xmlwriter_start_element($xw, 'image');
            xmlwriter_start_attribute($xw, 'src');
              xmlwriter_text($xw, "https://daikinboard.mavodev.de/images/${oat_image}");
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
