<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Memento admin Controller
 *
 * This class handles user account related functionality
 *
 * @package		User
 * @subpackage	UserModelCore
 * @author		dbcinfotech
 * @link		http://dbcinfotech.net
 */


class Crawl_model_core extends CI_Model

{

    function __construct()

    {

        parent::__construct();

        $this->load->database();

    }

    function insert_crawl_data($data)
    {
        $this->db->insert('crawl',$data);
        return $this->db->insert_id();
    }



    public function addestate($type='DBC_TYPE_APARTMENT')
    {

        $dl = default_lang();

        $this->config->load('realcon');

        //$purpose 	= $this->input->post('purpose');
        $purpose = "DBC_PURPOSE_RENT";

        $type 		= $this->input->post('type');

        $meta_search_text = '';		//meta information for simple searching


        if($purpose=='DBC_PURPOSE_SALE' && $this->input->post('price_negotiable')!=1)

        {

            $meta_search_text .= 'sale'.' ';

        }

        elseif($purpose=='DBC_PURPOSE_RENT' && $this->input->post('price_negotiable')!=1)

        {

            $meta_search_text .= 'rent'.' ';

        }

        else if($this->input->post('price_negotiable')!=1)

        {


        }

        #price validation end



        if($type=='DBC_TYPE_APARTMENT')

        {


            $meta_search_text .= 'apartment'.' ';

        }

        else if($type=='DBC_TYPE_HOUSE')

        {

            $meta_search_text .= 'house'.' ';

        }

        else if($type=='DBC_TYPE_LAND')

        {


            $meta_search_text .= 'land'.' ';

        }

        else if($type=='DBC_TYPE_COMSPACE')

        {


            $meta_search_text .= 'comercial space'.' ';

        }

        else if($type=='DBC_TYPE_CONDO')

        {



            $meta_search_text .= 'condo'.' ';



        }

        else if($type=='DBC_TYPE_VILLA')

        {


            $meta_search_text .= 'villa'.' ';

        }

                 $data = array();

                $data['unique_id']	= uniqid();

                $data['type'] 		= $this->input->post('type');

                $data['purpose'] 	= $this->input->post('purpose');

                if($this->input->post('price_negotiable')==1) {
                    $data['total_price'] 		= 0;

                    $data['price_per_unit'] 	= 0;

                    $data['price_unit'] 		= 0;

                    $data['rent_price'] 		= 0;

                    $data['rent_price_unit'] 	= 0;
                }

                else if($purpose=='DBC_PURPOSE_SALE')

                {

                    $data['total_price'] 		= $this->input->post('total_price');

                    $data['price_per_unit'] 	= $this->input->post('price_per_unit');

                    $data['price_unit'] 		= $this->input->post('price_unit');

                }

                elseif($purpose=='DBC_PURPOSE_RENT')

                {

                    $data['total_price'] 		= $this->input->post('rent_price');

                    $data['rent_price'] 		= $this->input->post('rent_price');

                    $data['rent_price_unit'] 	= $this->input->post('rent_price_unit');

                }


                else

                {

                    $data['total_price'] 		= $this->input->post('total_price');

                    $data['price_per_unit'] 	= $this->input->post('price_per_unit');

                    $data['price_unit'] 		= $this->input->post('price_unit');

                    $data['rent_price'] 		= $this->input->post('rent_price');

                    $data['rent_price_unit'] 	= $this->input->post('rent_price_unit');

                }

                #price validation end



                if($type=='DBC_TYPE_APARTMENT')

                {

                    $data['home_size'] 		= $this->input->post('home_size');

                    $data['home_size_unit'] = $this->input->post('home_size_unit');

                    $data['bedroom'] 		= $this->input->post('bedroom');

                    $data['bath'] 			= $this->input->post('bath');

                    $data['year_built'] 	= $this->input->post('year_built');



                    $meta_search_text		.= ' bedroom bathroom'.$data['bedroom'].' '.$data['bath'].' '.$data['year_built'];

                }

                else if($type=='DBC_TYPE_HOUSE')

                {

                    $data['home_size'] 		= $this->input->post('home_size');

                    $data['home_size_unit'] = $this->input->post('home_size_unit');

                    $data['lot_size'] 		= $this->input->post('lot_size');

                    $data['lot_size_unit'] 	= $this->input->post('lot_size_unit');

                    $data['bedroom'] 		= $this->input->post('bedroom');

                    $data['bath'] 			= $this->input->post('bath');

                    $data['year_built'] 	= $this->input->post('year_built');



                    $meta_search_text		.= ' bedroom bathroom'.$data['bedroom'].' '.$data['bath'].' '.$data['year_built'];

                }

                else if($type=='DBC_TYPE_LAND')

                {

                    $data['lot_size'] 		= $this->input->post('lot_size');

                    $data['lot_size_unit'] 	= $this->input->post('lot_size_unit');

                }

                else if($type=='DBC_TYPE_COMSPACE')

                {

                    $data['home_size'] 		= $this->input->post('home_size');

                    $data['home_size_unit'] = $this->input->post('home_size_unit');

                    $data['year_built'] 	= $this->input->post('year_built');



                    $meta_search_text		.= ' '.$data['year_built'];

                }

                else if($type=='DBC_TYPE_CONDO')

                {

                    $data['home_size'] 		= $this->input->post('home_size');

                    $data['home_size_unit'] = $this->input->post('home_size_unit');

                    $data['bedroom'] 		= $this->input->post('bedroom');

                    $data['bath'] 			= $this->input->post('bath');

                    $data['year_built'] 	= $this->input->post('year_built');



                    $meta_search_text		.= ' bedroom bathroom'.$data['bedroom'].' '.$data['bath'].' '.$data['year_built'];

                }

                else if($type=='DBC_TYPE_VILLA')

                {

                    $data['home_size'] 		= $this->input->post('home_size');

                    $data['home_size_unit'] = $this->input->post('home_size_unit');

                    $data['lot_size'] 		= $this->input->post('lot_size');

                    $data['lot_size_unit'] 	= $this->input->post('lot_size_unit');

                    $data['bedroom'] 		= $this->input->post('bedroom');

                    $data['bath'] 			= $this->input->post('bath');

                    $data['year_built'] 	= $this->input->post('year_built');



                    $meta_search_text		.= ' bedroom bathroom'.$data['bedroom'].' '.$data['bath'].' '.$data['year_built'];

                }



                $data['estate_condition'] 		= $this->input->post('condition');

                $meta_search_text		.= ' '.$data['estate_condition'];



                $data['address'] 		= $this->input->post('address');

                $meta_search_text		.= ' '.$data['address'];



                $data['country'] 		= $this->input->post('country');

                $meta_search_text		.= ' '.get_location_name_by_id($data['country']);



                $state_id 				= $this->realestate_model->get_location_id_by_name($this->input->post('state'),'state',$data['country']);

                $data['state'] 			= $state_id;

                $meta_search_text		.= ' '.$this->input->post('state');



                $city_id 				= $this->realestate_model->get_location_id_by_name($this->input->post('city'),'city',$state_id);

                $data['city'] 			= $city_id;

                $meta_search_text		.= ' '.$this->input->post('city');



                $data['zip_code'] 		= $this->input->post('zip_code');

                $data['latitude'] 		= $this->input->post('latitude');

                $data['longitude'] 		= $this->input->post('longitude');

                $data['facilities'] 	= json_encode($this->input->post('facilities'));

                $data['featured_img'] 	= $this->input->post('featured_img');



                $this->load->helper('date');

                $format = 'DATE_RFC822';

                $time = time();

                $datestring = "%Y-%m-%d";


                $data['create_time'] 	= $time;
                $data['publish_time'] 	= mdate($datestring, $time);

                $data['created_by']		= ($this->input->post('created_by') != '') ? $this->input->post('created_by') :$this->session->userdata('user_id');



                $publish_directly 		= get_settings('realestate_settings','publish_directly','Yes');

                $data['status']			= ($publish_directly=='Yes')?1:2; // 2 = pending



                $id = $this->crawl_model_core->insert_estate($data);



                $default_title 			= $this->input->post('title'.$dl);

                $meta_search_text		.= ' '.$default_title;



                $default_description 	= $this->input->post('description'.$dl);

                $meta_search_text		.= ' '.$default_description;


                $meta_search_text		.= $this->input->post('tags');
                #collecting meta information for simple searching is complete

                #now update the post table with the information

                $data = array();

                $data['search_meta'] = $meta_search_text;

                $this->realestate_model->update_estate($data,$id);



                $this->load->model('admin/system_model');

                $query = $this->system_model->get_all_langs();

                $active_languages = $query->result();



                $data = array();

                $data['post_id'] 	= $id;

                $data['key']		= 'title';

                $data['status']	= 1;



                $value = array();

                foreach ($active_languages as $row) {



                    $title = $this->input->post('title'.$row->short_name);

                    $value[$row->short_name] = $title;

                }



                $data['value'] = json_encode($value);

                $this->realestate_model->insert_estate_meta($data);



                $data = array();

                $data['post_id'] 	= $id;

                $data['key']		= 'description';

                $data['status']	= 1;



                $value = array();

                foreach ($active_languages as $row) {



                    $description = $this->input->post('description'.$row->short_name);

                    $value[$row->short_name] = $description;

                }



                $data['value'] = json_encode($value);

                $this->realestate_model->insert_estate_meta($data);

                add_post_meta($id,'tags',$this->input->post('tags'));

                if($purpose=='DBC_PURPOSE_RENT')
                {
                    add_post_meta($id,'from_rent_date',$this->input->post('from_date'));
                    add_post_meta($id,'to_rent_date',$this->input->post('to_date'));
                }
                add_post_meta($id,'energy_efficiency',$this->input->post('energy_efficiency'));
                #increase users post count

                $user_id = $this->session->userdata('user_id');

                $post_count = get_user_meta($user_id,'post_count',0);

                $post_count++;

                add_user_meta($user_id,'post_count',$post_count);

                #adding distance information
                $distance_ids = $this->input->post('distance_id');
                $distance_titles = $this->input->post('distance_title');
                $distance_icons = $this->input->post('distance_icon');
                $distance_values = $this->input->post('distance_value');
                $distance_units = $this->input->post('distance_unit');
                $i = 0;
                $vals = array();
                foreach ($distance_ids as $key => $value) {
                    $dis_info = array();
                    $dis_info['id'] = $distance_ids[$key];
                    $dis_info['title'] = $distance_titles[$key];
                    $dis_info['icon'] = $distance_icons[$key];
                    $dis_info['value'] = $distance_values[$key];
                    $dis_info['units'] = $distance_units[$key];
                    $vals[$i++] = json_encode($dis_info);
                }
                add_post_meta($id,'distance_info',json_encode($vals));


                add_post_meta($id,'custom_values',json_encode($data));

                if($this->input->post('price_negotiable')==1) {
                    add_post_meta($id,'price_negotiable','1');
                }
                else {
                    add_post_meta($id,'price_negotiable','0');
                }

                if($publish_directly=='Yes')
                    $this->session->set_flashdata('msg', '<div class="alert alert-success">Property added</div>');
                else
                    $this->session->set_flashdata('msg', '<div class="alert alert-success">Property added and waiting for admin approval.</div>');

    }

    function insert_estate($data,$meta,$active_languages)
    {
        $this->db->insert('posts',$data);

        $id = $this->db->insert_id();


        $data = array();

        $data['post_id'] 	= $id;

        $data['key']		= 'description';

        $data['status']	= 1;

        $value = array();

        foreach ($active_languages as $row) {

            $description = $meta['description'];

            $value[$row->short_name] = $description;

        }

        $data['value'] = json_encode($value);


        $this->db->insert('post_meta',$data);


        $data = array();

        $data['post_id'] 	= $id;

        $data['key']		= 'title';

        $data['status']	= 1;

        $value = array();

        foreach ($active_languages as $row) {

            $description = $meta['title'];

            $value[$row->short_name] = $description;

        }

        $data['value'] = json_encode($value);

        $this->db->insert('post_meta',$data);

        return $this->db->insert_id();
    }




}
