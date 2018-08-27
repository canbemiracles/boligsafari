<?php
$url = 'http://www.findbolig.nu/FBNImages/43c0c30a-2ca9-4edc-9510-66467f900313_498x332.jpg';

$file = pathinfo($url);


$img = './uploads/gallery/'.$file['basename'];
file_put_contents($img, file_get_contents($url));

echo "<img src=http://www.lejibyen.dk/uploads/gallery/".$file['basename'].">";

$html_pic = file_get_html("http://www.findbolig.nu/Findbolig-nu/Find%20bolig/Ledige%20boliger/Boligpraesentation/Billeder.aspx?aid=19442&s=2");


foreach ($html_pic->find("ul[id=PropertyThumbs] li img") as $img) {

    echo "<img src='http://www.findbolig.nu$img->id'>";
}


echo json_encode($ar);