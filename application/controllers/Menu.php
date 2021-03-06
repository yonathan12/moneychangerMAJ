<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu','Menu','required');

        if ($this->form_validation->run()== FALSE) {
            # code...
            $data['title'] = 'Menu Management';
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('menu/index',$data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $menu = $this->input->post('menu');
            $this->db->insert('user_menu',['menu' => $menu]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
                    New Menu Added!
                  </div>');
                    redirect('menu');   
        }             
    }

    public function deleteMenu($Id)
    {
        $this->db->where('Id',$Id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        Menu Deleted!
        </div>');
        redirect('menu');   
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->model('Menu_model');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->Menu_model->getSubMenu();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('menu_id','Menu','required');
        $this->form_validation->set_rules('url','URL','required');
        $this->form_validation->set_rules('icon','Icon','required');

        if ($this->form_validation->run()== FALSE) {
            # code...
            $data['title'] = 'SubMenu Management';
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('menu/submenu',$data);
            $this->load->view('templates/footer');
        } else {
            # code...
            $this->Menu_model->addSubmenu();
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            New Sub Menu Added!
            </div>');
            redirect('menu/submenu');  
        }       
            
    }

    public function editSubmenu($Id)
    {
        $data['user'] = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->db->get_where('user_sub_menu',['Id' => $Id])->row_array();
        
        $this->load->model('Menu_model');
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('menu_id','Menu','required');
        $this->form_validation->set_rules('url','URL','required');
        $this->form_validation->set_rules('icon','Icon','required');
        
        if ($this->form_validation->run()== FALSE) {
            # code...
            $data['title'] = 'SubMenu Management';
            $this->load->view('templates/header',$data);
            $this->load->view('templates/sidebar',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('menu/editSubmenu',$data);
            $this->load->view('templates/footer');
        } else {
            # code...
            
            $this->Menu_model->editSub();
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Sub Menu Edited!
            </div>');
            redirect('menu/submenu');  
        }       
    }

    public function deleteSubmenu($Id)
    {
        $this->db->where('Id',$Id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        Sub Menu Edited!
        </div>');
        redirect('menu/submenu');  
    }
}