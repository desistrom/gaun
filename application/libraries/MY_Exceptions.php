<?php
class MY_Exceptions extends CI_Exceptions{
    function MY_Exceptions(){
        parent::CI_Exceptions();
    }

    function show_404($page=''){    

        redirect(site_url('web/page/not_found'));
    }
}