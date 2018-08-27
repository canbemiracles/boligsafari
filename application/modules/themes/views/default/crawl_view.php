<?php

/*
    $html = file_get_html("http://www.leje-portalen.dk/boligliste.asp?paging=alle");

    foreach ($html->find("div[class=annonceContainer]") as $c) {

        $len = count($c->find('div a[class="rentLink"]')) - 1;
        $tmp = 1;

                for ($i = 0; $i < $len; $i++) {

                    $url = "http://leje-portalen.dk" . htmlentities($c->find('div a[class="rentLink"]',$i)->href);

                    //$url = "http://leje-portalen.dk/lejemaal/Liebhaver-lejlighed-Jomfrustien-100-m2-terrasse.-Haderslev/9806";

                    $pos = strripos($url, "/");

                    if ($pos != false) {
                        $url_id_pos = $pos + 1;
                    }

                    echo substr($url, $url_id_pos);

                    $address_loop = 0;
                    $address_str = "";

                    $html_data = file_get_html($url);

                    foreach ($html_data->find("td[class=rentAd] table tbody td") as $t) {

                        if ($address_loop == 1) {
                            if ($t->innertext == " ") {
                                $address_loop = 2;
                            } else {
                                $address_loop = 0;
                            }
                        }

                        if ($address_loop == 2) {
                            $address_str .= $t->innertext;
                            $address_loop = 0;
                        }


                        if (isset($found) && $found == 1) {
                            //echo $meta;
                            if ($meta != "") {
                                if ($meta == "Adresse:") {
                                    $value = "Address";
                                    $address_str = $t->innertext;
                                    $address_loop = 1;
                                } else if ($meta == "Postnr./by:") {
                                    $value = "Zip";
                                } else if (strpos($meta, "elser")) {
                                    $value = "Rooms";
                                } else if ($meta == "Leje pr. md.:") {
                                    $value = "Rent";
                                } else {
                                    $value = "Area";
                                }
                            }

                            if ($meta == "Postnr./by:") {
                                $ar = explode("&nbsp;", $t->innertext);

                                echo $ar[0];

                                echo $ar[1];

                            }


                            if ($meta == "Leje pr. md.:") {
                                //echo str_replace(".","",$t->innertext);
                            } else {
                                //echo strip_tags($t->innertext) . "<br>";
                            }

                        }

                        if (strip_tags($t->innertext) == "Adresse:" || strip_tags($t->innertext) == "Postnr./by:" ||
                            strpos($t->innertext, "<sup>2</sup>") || strpos($t->innertext, "elser") ||
                            strip_tags($t->innertext) == "Leje pr. md.:"
                        ) {
                            $found = 1;
                            $meta = htmlentities($t->innertext);
                            continue;
                        } else {
                            $found = 0;
                            $meta = "";
                        }

                    }


                    foreach ($html_data->find('div[class=replaceurl]') as $d) {
                        //echo htmlentities(strip_tags($d->innertext));
                    }


                    foreach ($html_data->find('img[class=thumbImages]') as $img) {
                        //echo "http://leje-portalen.dk".$img->src;
                    }


                }

    }

*/

?>


<h3>Crawl Success</h3>