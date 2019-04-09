<?php

class Drillers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('fogrudemomodel');
        $this->load('url_helper');
    }       // end of constructor function
    
    public function index()
    {
        $data['records'] = $this->fogrudemomodel->getDrillers(); // get all drillers records
        
    }
    
    
}   // end of Drillers class definition

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
