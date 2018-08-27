<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Memento account Controller
 *
 * This class handles user account related functionality
 *
 * @package		Account
 * @subpackage	Account
 * @author		dbcinfotech
 * @link		http://dbcinfotech.net
 */

error_reporting(E_ALL);

class Crawl_core extends CI_Controller {


    var $active_theme = '';

    public function __construct()

    {

        parent::__construct();

        $this->load->database();
        $this->load->library('simple_html_dom');

        $this->active_theme = get_active_theme();

    }

    function index()
    {
        $this->getdata();
    }


    public function getdata()
    {
        $this->load->model('crawl/crawl_model');
        $this->load->model('admin/realestate_model');

        $city = array("Aalborg","København","Odense","Aarhus");
        //$data = array();

        $city_length = sizeof($city);

        for($i=0;$i<$city_length;$i++) {

            for($j=1;$j<=3;$j++)
            {
                $data = array();


                $html = file_get_html("http://www.findbolig.nu/ledigeboliger/liste.aspx?where=" . $city[$i] . "&showrented=1&showyouth=1&showlimitedperiod=1&showunlimitedperiod=1&showOpenDay=0&focus=ctl00_placeholdersidebar_0_txt_where&page=".$j);
                foreach ($html->find("table[class=gridTable] tr") as $tr) {
                    $meta_search_text = "";

                    $data['reference_id'] = $tr->aid;

                    $ref_url = "http://www.findbolig.nu/Findbolig-nu/Find%20bolig/Ledige%20boliger/Boligpraesentation/Boligen.aspx?aid=".$tr->aid."&s=2";

                    $html_details = file_get_html("http://www.findbolig.nu/Findbolig-nu/Find%20bolig/Ledige%20boliger/Boligpraesentation/Boligen.aspx?aid=".$tr->aid."&s=2");
                    $flag = 1;
                    foreach ($html_details->find("table[id=detailsTable] tr") as $details) {

                        //echo $tr;
                        if($flag==1) {
                            //$data['type'] = strip_tags($details->find('span', 0)->innertext);
                            $data['type'] = "DBC_TYPE_APARTMENT";
                            $string = strip_tags($details->find('span', 1)->innertext);
                            $data['total_price'] = str_replace(".","",$string);
                            $meta_search_text .= " ".$data['total_price'];

                        }
                        else if($flag==3)
                        {
                            $data['home_size'] = strip_tags($details->find('span', 0)->innertext);
                            $meta_search_text		.= ' home size '.$data['home_size'];
                        }
                        else if($flag==4)
                        {
                            $data['bedroom'] = strip_tags($details->find('span', 0)->innertext);
                            //$meta_search_text		.= ' bedroom '.$data['bedroom'];
                        }
                        $flag++;
                    }

                    $meta = array();

                    //echo $html;

                    foreach($html_details->find("div[class=middleContentPad] span p") as $desc)
                    {
                        $meta['description'] = strip_tags($desc);
                        $meta['description'] .= "    "."<a href='$ref_url' target='_blank' >".strip_tags("Ansøg på lejemålet")."</a>";
                        //$meta_search_text .=  " ".strip_tags($desc);
                    }


                    $html_pic = file_get_html("http://www.findbolig.nu/Findbolig-nu/Find%20bolig/Ledige%20boliger/Boligpraesentation/Billeder.aspx?aid=".$tr->aid."&s=2");

                    $img_check_array = array();
                    $img_flag = 0;

                    foreach ($html_pic->find("ul[id=PropertyThumbs] li img") as $img) {

                        $img_url = "http://www.findbolig.nu$img->id";

                        $img_filename = pathinfo($img_url);

                        $img = './uploads/gallery/'.$img_filename['basename'];
                        file_put_contents($img, file_get_contents($img_url));

                        if($img_flag==0)
                        {
                            $data['featured_img'] = $img_filename['basename'];


                            $config['image_library'] = 'gd2';

                            $config['source_image'] = './uploads/gallery/'.$img_filename['basename'];

                            $config['new_image'] 	= './uploads/thumbs/'.$img_filename['basename'];

                            $config['maintain_ratio'] = TRUE;

                            $config['overwrite'] = TRUE;

                            $config['width'] = 256;

                            $config['height'] = 256;

                            $config['master_dim'] = 'width';

                            $this->load->library('image_lib');

                            $this->image_lib->clear();
                            $this->image_lib->initialize($config);

                            $this->image_lib->resize();

                        }

                        $img_check_array[$img_flag] = $img_filename['basename'];
                        $img_flag++;
                    }

                    $data['gallery'] = json_encode($img_check_array);

                    $zip = "";
                    $city = "";
                    $ad = "";
                    $rent_ref = "";
                    $ac = "";

                    $ref = $tr->find('td a[class=advertLink]',1);
                    $address = preg_split('/<br.*?\/?>/i', $ref);

                    if(!empty($address[0]) && isset($address[0]))
                    {
                        $ad = $address[0];
                    }

                    if(!empty($address[1]) && isset($address[1])) {
                        //echo $arrHtml[1];
                        $str = $address[1];
                        $zip = substr($str,0,4);
                        $city = substr($str,5);
                    }

                    $r_ref = $tr->find('td',4);
                    $rent = preg_split('/<br.*?\/?>/i', $r_ref);
                    if(!empty($rent[0]) && isset($rent[0])) {
                        //echo $arrHtml[1];
                        $ac = $rent[0];
                    }
                    if(!empty($rent[1]) && isset($rent[1])) {
                        //echo $arrHtml[1];
                        $rent_ref = $rent[1];
                    }

                    $this->load->helper('date');

                    $format = 'DATE_RFC822';

                    $time = time();

                    $datestring = "%Y-%m-%d";


                    $data['create_time'] 	= $time;
                    $data['publish_time'] 	= mdate($datestring, $time);


                    $meta_search_text .= 'apartment'.' ';

                    $data['address'] = strip_tags($ad);
                    $meta_search_text		.= ' '.strip_tags($ad);

                    $data['zip_code'] = strip_tags($zip);
                    $meta_search_text		.= ' '.strip_tags($zip);

                    //$data['city'] = strip_tags($city);
                    $data['status'] = 1;
                    //$data['please'] = strip_tags($tr->find('td',2));
                    //$data['kvm'] = strip_tags($tr->find('td',3));
                    //$data['total_price'] = strip_tags($ac);
                    $data['price_per_unit'] = $rent_ref;
                    $data['price_unit'] = "sqmeter";
                    //$data['available_from'] = strip_tags($tr->find('td',5));
                    $data['unique_id'] = uniqid();
                    $data['purpose'] = "DBC_PURPOSE_RENT";

                    $data['estate_condition'] = "DBC_CONDITION_AVAILABLE";
                    $meta_search_text		.= ' '.$data['estate_condition'];

                    $data['home_size_unit'] = "sqmeter";
                    $data['crawled'] = 1;
                    $data['rent_price_unit'] = "DBC_PER_MONTH";
                    $data['created_by'] = 1;

                    $city_id 				= $this->realestate_model->get_location_id_by_name(strip_tags($city),'city','73');

                    $data['city'] 			= $city_id;
                    $meta_search_text      .=  strip_tags($city);

                    $data['search_meta'] = $meta_search_text;

                    $meta['title'] = strip_tags($ad);

                    $this->load->model('admin/system_model');

                    $query = $this->system_model->get_all_langs();
                    $active_languages = $query->result();

                    if ($data['address'] != NULL) {
                        $this->crawl_model->insert_estate($data,$meta,$active_languages);
                    }

                }
            }
        }

        //$this->crawl_model->insert_crawl_data($data);

        $data['content'] 	= load_view('crawl_view','',TRUE);
        load_template($data,$this->active_theme);

    }

    public function img_test()
    {
        $data['content'] 	= load_view('img_test_view','',TRUE);
        load_template($data,$this->active_theme);
    }

    public function leje()
    {
        $this->load->model('admin/realestate_model');
        $this->load->model('crawl/crawl_model');


        $meta = "";


        $html = file_get_html("http://www.leje-portalen.dk/boligliste.asp?paging=alle");

        foreach ($html->find("div[class=annonceContainer]") as $c) {

            $len = count($c->find('div a[class="rentLink"]')) - 1;

            for ($i = 0; $i < $len; $i++) {

                $meta_search_text = " ";

                $meta_data = array();

                $data = array();

                $url = "http://leje-portalen.dk" . htmlentities($c->find('div a[class="rentLink"]',$i)->href);

                //$url = "http://leje-portalen.dk/lejemaal/Liebhaver-lejlighed-Jomfrustien-100-m2-terrasse.-Haderslev/9806";

                $pos      = strripos($url,"/");

                if($pos != false)
                {
                    $url_id_pos = $pos+1;
                }

                $data['reference_id'] = (int)substr($url,$url_id_pos)+500000;

                $html_data = file_get_html($url);
                foreach ($html_data->find("td[class=rentAd] table tbody td") as $t) {

                    $data['type'] = "DBC_TYPE_APARTMENT";

                    if (isset($found) && $found == 1) {
                        //echo $meta;
                        if ($meta != "") {
                            if ($meta == "Adresse:") {
                                $value = "Address";
                                $data['address'] = strip_tags($t->innertext);
                                $meta_data['title'] = $data['address'];
                                $meta_search_text .= $data['address'];
                            } else if ($meta == "Postnr./by:") {
                                $value = "Zip";
                            } else if (strpos($meta, "elser")) {
                                $value = "Rooms";
                                $data['bedroom']  = strip_tags($t->innertext);
                            } else if ($meta == "Leje pr. md.:") {
                                $value = "Rent";
                                $price = str_replace(".","",$t->innertext);

                                $data['price_per_unit'] = $price;
                                $data['total_price'] = $price;
                                $data['rent_price'] = $price;

                                $meta_search_text .= " ".$price;
                            } else {
                                $value = "Area";
                                $data['home_size'] = strip_tags($t->innertext);
                            }
                        }

                        if($meta == "Postnr./by:")
                        {
                            $ar = explode("&nbsp;",$t->innertext);
                            $zip = substr($ar[0],9);
                            $city = htmlentities(strip_tags($ar[1]));
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

                foreach($html_data->find('div[class=replaceurl]') as $d)
                {
                    $meta_data['description'] =  htmlentities(strip_tags($d->innertext));
                }

                $img_check_array = array();
                $img_flag = 0;

                foreach($html_data->find('img[class=thumbImages]') as $img)
                {

                        $img_url = "http://leje-portalen.dk".$img->src;

                        $img_filename = pathinfo($img_url);

                        $img = './uploads/gallery/'.$img_filename['basename'];
                        file_put_contents($img, file_get_contents($img_url));

                        if($img_flag==0)
                        {
                            $data['featured_img'] = $img_filename['basename'];


                            $config['image_library'] = 'gd2';

                            $config['source_image'] = './uploads/gallery/'.$img_filename['basename'];

                            $config['new_image'] 	= './uploads/thumbs/'.$img_filename['basename'];

                            $config['maintain_ratio'] = TRUE;

                            $config['overwrite'] = TRUE;

                            $config['width'] = 256;

                            $config['height'] = 256;

                            $config['master_dim'] = 'width';

                            $this->load->library('image_lib');

                            $this->image_lib->clear();
                            $this->image_lib->initialize($config);

                            $this->image_lib->resize();

                        }

                        $img_check_array[$img_flag] = $img_filename['basename'];
                        $img_flag++;
                }

                $data['gallery'] = json_encode($img_check_array);

                $this->load->helper('date');

                $format = 'DATE_RFC822';

                $time = time();

                $datestring = "%Y-%m-%d";


                $data['create_time'] 	= $time;
                $data['publish_time'] 	= mdate($datestring, $time);


                //$data['city'] = strip_tags($city);
                $data['status'] = 1;
                //$data['please'] = strip_tags($tr->find('td',2));
                //$data['kvm'] = strip_tags($tr->find('td',3));
                //$data['total_price'] = strip_tags($ac);

                $data['price_unit'] = "sqmeter";
                //$data['available_from'] = strip_tags($tr->find('td',5));
                $data['unique_id'] = uniqid();
                $data['purpose'] = "DBC_PURPOSE_RENT";

                $data['estate_condition'] = "DBC_CONDITION_AVAILABLE";
                $meta_search_text		.= ' '.$data['estate_condition'];

                $data['home_size_unit'] = "sqmeter";
                $data['crawled'] = 1;
                $data['rent_price_unit'] = "DBC_PER_MONTH";
                $data['created_by'] = 1;

                $zip_ref = str_replace(' ', '', $zip);
                $data['zip_code'] = $zip_ref;
                $meta_search_text .= " ".$zip_ref;

                $city_id 				= $this->realestate_model->get_location_id_by_name($city,'city','73');

                $data['city'] 			= $city_id;
                $meta_search_text      .=  strip_tags($city);

                $data['search_meta'] = $meta_search_text;


                $this->load->model('admin/system_model');

                $query = $this->system_model->get_all_langs();
                $active_languages = $query->result();

                if ($data['address'] != NULL) {
                    $this->crawl_model->insert_estate($data,$meta_data,$active_languages);
                }
            }
        }

        $data['content'] 	= load_view('crawl_view','',TRUE);
        load_template($data,$this->active_theme);
    }

}