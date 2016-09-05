<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct()
  {
	  
	  parent::__construct();
	  	  
	  // Load models
	  $this->load->model('GreyPix_Model', 'gpdb');
	  
	}  
    
	public function index($albumID=null)
	{
  	
  	if ($albumID) {
    	// if an album ID is supplied - go to that album
    	
  	}
  	
	  $this->load->view('pages/albums', $this->build_template());
  	
	}
	
	/** Private Functions **/
  
  /**
   *
   * Build Template
   *
   * @param array $payload
   *
  **/
  private function build_template($payload=null)
  {
    // Navigation Includes
    $this->data["navigation"] = $this->load->view('global/navigation', '', true);
    
    $template_array = (object)array(
      'header' => $this->load->view('global/header', $this->data, true),
      'footer' => $this->load->view('global/footer', $this->data, true)
    );

    return $template_array;
  }
	
}
