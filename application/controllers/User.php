<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['title'] = 'My Profile';
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('user/index',$data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name','Full Name', 'required|trim');
        
        if ($this->form_validation->run()==false) {
            # code...
        $data['title'] = 'Edit Profile';
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('user/edit',$data);
        $this->load->view('templates/footer');
        } else {
            # code...
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek ada gambar yang akan diupload

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                # code...
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['upload_path']          = './assets/img/profile/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    # code...
                    $oldImage = $data['user']['image'];
                    if ($oldImage != 'default.jpg') {
                        # code...
                        unlink('FCPATH'.'./assets/img/profile/'.$oldImage);
                    }
                    $newImage = $this->upload->data('file_name');
                    $this->db->set('image', $newImage);
                }else{
                    #code...
                    echo $this->upload->display_errors();
                }
            } 
            
            $this->db->set('name', $name);
            $this->db->where('email',$email);
            $this->db->update('user');
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Your Profile has been updated!
          </div>');
            redirect('user');
        }
    }
}
?>