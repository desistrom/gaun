<?php 

/**
* 
*/
class User extends MX_Controller
{

	var $idUser;
    var $data = array();
	function __construct(){

	}

	public function index(){
        // print_r($this->session->userdata('data_user'));
		$this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'List User';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'list_user_layout',$this->data);
	}

    public function add(){
        $user = $this->session->userdata('data_user');
        if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required|is_unique[tb_journal_user.username]');
            $this->form_validation->set_rules('password','Password', 'required|is_unique[tb_journal_user.email]');
            $this->form_validation->set_rules('email','Email', 'required');
            $this->form_validation->set_rules('repassword','Re - Password', 'required|matches[password]');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $input = $this->input->post();
                $data['username'] = $input['username'];
                $data['email'] = $input['email'];
                $data['password'] = sha1($input['password']);
                $data['id_instansi'] = $user['id_instansi'];
                if ($this->db->insert('tb_journal_user',$data)) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('instansi/user');
                    // $this->session->set_flashdata('notif','Insert Berhasil');
                    $this->load->helper('email_send_helper');
                    $data['email_from'] = 'support@IDREN';
                    $data['name_from'] = 'Admin Support';
                    $data['email_to'] = $data['email'];
                    $data['subject'] = 'Pendaftaran Berhasil';
                    $data['content'] = 'Halo <br>h3>berikut data login anda:</h3><br><li>Username : '.$data['username'].'</li><li>Password : '.$input['password'].'</li><b>login dashboard bisa di akses di link berikut : </b>'.site_url('journal/admin').'<br><center>terimakasih</center>';
                    if (email_send($data) == true) {
                        $user_data = 'success';
                        $this->session->set_flashdata("header","Registrasi Berhasil");
                        $this->session->set_flashdata("notif","Create admin Journal Berhasil");
                    }
                }
            }
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['repassword'] = form_error('repassword');
            echo  json_encode($ret);
            exit();
        }
        $this->data['breadcumb'] = 'Add User';
        $this->data['view'] = 'add';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'list_user_layout',$this->data);
    }

    public function edit($id=null){
        $user = $this->session->userdata('data_user');
        $uj = $this->db->get_where('tb_journal_user',array('id_journal_user'=>$id))->row_array();
        if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
                $input = $this->input->post();
            if($input['username'] != $uj['username']){
                $this->form_validation->set_rules('username','username', 'required|is_unique[tb_journal_user.username]');
            }else{
                $this->form_validation->set_rules('username','username', 'required');              
            }
            $this->form_validation->set_rules('password','Password', '');
            $this->form_validation->set_rules('repassword','Re - Password', 'matches[password]');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data['username'] = $input['username'];
                if ($input['password'] != '') {
                    $data['password'] = $input['password'];
                }
                if ($this->db->update('tb_journal_user',$data,array('id_journal_user'=>$id))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('instansi/user');
                    $this->session->set_flashdata('notif','Update Berhasil');
                }
            }
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['repassword'] = form_error('repassword');
            echo  json_encode($ret);
            exit();
        }
        $this->data['breadcumb'] = 'Add User';
        $this->data['view'] = 'edit';
        $this->data['user'] = $uj;
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'list_user_layout',$this->data);
    }

	public function ajax_list()
    {
        $this->load->model('user_model');
        $list = $this->user_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
        $button = '';
        $aktif = '';
            $no++;
            if ($news->status==1) {
                $aktif = '<span class="text-success"><b>Enabled</b></span>';
                $btn = '<button class="btn btn-danger btn-sm btn-sts" id="'.$news->id_journal_user.'" data-toggle="tooltip" title="Disable"><i class="fa fa-eye-slash"></i> Disable</button>';
            }else{
                $aktif = '<span class="text-danger"><b>Disabled</b></span>';
                $btn = '<button class="btn btn-danger btn-sm btn-sts" id="'.$news->id_journal_user.'" data-toggle="tooltip" title="Enabled"><i class="fa fa-eye"></i> Enable</button>';
            }
            // $button .= ' <a href="'.site_url('instansi/user/edit/'.$news->id_journal_user).'" class="btn btn-success btn-sm btn-detail" id="'.$news->id_journal_user.'"><i class="fa fa-pencil"></i> Edit</button>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_journal_user.'">'.word_limiter($news->username,10).'</div>';
            $row[] = $aktif;
            $row[] = $btn.' '.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->user_model->count_all(),
                        "recordsFiltered" => $this->user_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}


