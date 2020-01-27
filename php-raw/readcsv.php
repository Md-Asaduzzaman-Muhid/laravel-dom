<?php
include("simple_html_dom.php");

$html = file_get_html("https://cascadesciences.com/lab-baths/water-baths/");

 $category= array();

foreach($html->find(" #gusta-menu-item-1005687 > ul > li >a") as $pr) {
    echo "1.".$pr ->plaintext. "<br>";// "," .$pr ->href. "<br>";
     //$i = 0;
     $category['name']= $pr ->plaintext;
    // $i++;
}
foreach($html->find(" #gusta-menu-item-1005687 > ul > li> ul >li > a ") as $pr2) {
    echo "2.".$pr2 ->plaintext. "<br>";// "," .$pr2 ->href. "<br>";
    $category['name']= $pr2 ->plaintext;
    $html2= file_get_html($pr2 ->href);
    foreach($html2->find(" .product-category a") as $pr3) {
        echo "3.".$pr3->find("h5", 0) ->plaintext. "<br>";//. "," .$pr3 ->href.  "<br>";
        $category['name']= $pr3->find("h5", 0)->plaintext;
    }
}

print_r($category);


$fp = fopen('file.csv', 'w');
$i=0;
foreach ($category as $fields) {
    if($i==0){
        fputcsv($fp, 'child1');
    }
    fputcsv($fp, $fields);
    $i++;
}

fclose($fp);
//print_r($category);

// $fp = fopen('cascadesciences.csv', 'w');
    
// print_r($category);
// foreach ($category as $record)
//     {
//         $record_arr = array();
//         foreach ($record as $value)
//         {
//             $record_arr[] = $value;
//         }
//         if($i == 0)
//         {
//           fputcsv($fp, array_keys((array)$record));
//         }
//         fputcsv($fp, array_values($record_arr));
        
//         $i++;
//     }

// fclose($fp);



?>