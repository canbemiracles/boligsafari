<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Memento users Controller
 *
 * This class handles users management related functionality
 *
 * @package		Admin
 * @subpackage	users
 * @author		dbcinfotech
 * @link		http://dbcinfotech.net
 */

class Messages_core extends CI_Controller {

    var $per_page = 3;

    public function __construct()
    {
        error_reporting(E_ALL);
//        die('sdfsf');
        parent::__construct();
        is_installed(); #defined in auth helper
        checksavedlogin(); #defined in auth helper

        if(!is_admin())
        {
            if(count($_POST)<=0)
                $this->session->set_userdata('req_url',current_url());
            redirect(site_url('admin/auth'));
        }

        $this->per_page = get_per_page_value();#defined in auth helper
//        $this->per_page = 2;
        $this->load->model('users_model');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    public function index()
    {
        $this->all();
    }

    #load all services view with paging
    public function all($start='0')
    {
        $value['messages']  	= $this->get_all_messages_by_users($start, $this->per_page);
        //$value['messages'] =  $this->get_message_threads($start, $this->per_page);
//        var_dump($value['messages']->result_array());
        $total 				= $this->count_all_messages_by_users();
        $value['pages']		= configPagination('admin/messages/all',$total,5,$this->per_page);
        $this->load->model('user/user_model');
        $value['user_model']	= $this->user_model;

        $data['title'] = 'Messages';

        $data['content'] = $this->load->view('admin/messages/allmessages_view',$value,TRUE);
        $this->load->view('admin/template/template_view',$data);
    }


    public function get_all_messages_by_users($start, $per_page)
    {
        $sql = 'SELECT * FROM (SELECT * FROM dbc_messages WHERE user_id IS NOT NULL ORDER BY created DESC LIMIT '.$start.', '.$per_page.') AS tmp_table GROUP BY user_id,url ;';
//        var_dump($sql);
        $query = $this->db->query($sql);
//        var_dump($query->result_array());
        return $query;
    }

    public function get_message_threads($start, $per_page)
    {
        $this->db->select('*');
        $this->db->from('messages');
        $this->db->where('to_id', 1);
        $this->db->order_by('created', 'ASC');
        $this->db->distinct('from_id');
        $query = $this->db->get();

        //$sql = 'SELECT * FROM dbc_messages WHERE user_id IS NOT NULL DESC LIMIT '.$start.', '.$per_page.';';

        //$query = $this->db->query($sql);

        return $query;
    }


    public function count_all_messages_by_users()
    {
        $query = $this->db->query('SELECT * FROM (SELECT * FROM dbc_messages  WHERE user_id IS NOT NULL  ORDER BY created DESC) AS tmp_table GROUP BY user_id ;');
        return $query->num_rows();

    }

    public function answer($id,$url)
    {
        if (count($_POST)) {

            $this->form_validation->set_rules('message', 'Message', 'required');

            if ($this->form_validation->run() == FALSE) {

            } else {
                $message = $this->input->post('message');
                $title 	= $this->input->post('title');
                // insert new message
                $data = array('user_id' => (int)$id, 'from_id' => 1, 'to_id' => (int)$id,'message' => $message, 'url' => $title, 'created' => date('Y-m-d H:i:s',time()));
                $this->db->insert('messages', $data);
                redirect(site_url('admin/messages'));
            }
        }

//        $this->db->where('from_id',(int)$id);
//        $this->db->or_where('to_id',(int)$id);
        $this->db->where('user_id',(int)$id);
        $this->db->order_by('created','ASC');
        $query = $this->db->get('messages');
        $this->load->model('user/user_model');
        $value['user_model']	= $this->user_model;
        $value['messages']	= $query;
        $value['url'] = urldecode($url);

        $data['title'] = 'Messages';
        $data['content'] = $this->load->view('admin/messages/answer_view',$value,TRUE);
        $this->load->view('admin/template/template_view',$data);
    }

    public function update_menu()
    {
        if(constant("ENVIRONMENT")=='demo')
        {
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Data updated.[NOT AVAILABLE ON DEMO]</div>');
        }
        else
        {
            add_option('top_menu',$this->input->post('top_menu'));
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Menu updated</div>');
        }
        redirect(site_url('admin/page/menu'));
    }

    public function detail($id)
    {
        $value['profile'] = $this->users_model->get_user_by_id($id);
        $data['title'] = 'User Profile';
        $data['content'] = $this->load->view('users/detail_view',$value,TRUE);
        $this->load->view('admin/template/template_view',$data);
    }


}

/* End of file users.php */
/* Location: ./application/modules/admin/controllers/admin.php */