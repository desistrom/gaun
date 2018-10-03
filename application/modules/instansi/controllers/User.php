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
		$this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'list_user_layout',$this->data);
	}

	public function ajax_list($id)
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $aktif = '';
        $button = '';
        $aktif = '';
            $no++;
            if ($news->status==1) {
                $aktif = '<span class="text-success"><b>Accepted</b></span>';                
            }else{
                if($news->status == 0){
                    $aktif = '<span class="text-defafult"><b>Pending</b></span>';
                }else{
                    $aktif = '<span class="text-danger"><b>Ignored</b></span>';
                }
                $button = '<button class="btn btn-info btn-sm btn-acc" id="'.$news->id_artikel.'" data-toggle="tooltip" title="accept"><i class="fa fa-check"></i> Accepted</button> <button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i> Ignored</button>';
            }
            $button .= ' <button class="btn btn-success btn-sm btn-detail" id="'.$news->id_artikel.'"><i class="fa fa-eye"></i> Detail</button>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            // $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered($id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}


