<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
  {
	  
	  parent::__construct();
	  	  
	  // Load models
	  $this->load->model('Greypix_model', 'gpdb');
	  
	}  

	public function index()
	{
	  
	  $randPix = $this->gpdb->getRandomPicturesLimitedBy(12);
    
    if ($randPix) {
      foreach ($randPix as $rp) {
        
        $lg1600 = $this->gpdb->getSpecificSizeOfPictureID("Large 1600", $rp->id);
        $orig = $this->gpdb->getSpecificSizeOfPictureID("Original", $rp->id);
        
        $rp->lg1600_size = ($lg1600) ? $lg1600[0]->source : false;
        $rp->orig_size = ($orig) ? $orig[0]->source : false;

      }  
    }
	  
	  $this->data['randPix'];
	  
		$this->load->view('pages/home', $this->build_template());
	}

	public function albums($albumID=null)
	{
  	
  	if ($albumID) {
    	// if an album ID is supplied - go to that album
    	
  	}
  	
	  $this->load->view('pages/albums', $this->build_template());
  	
	}

  
  public function error_404()
  {
    
    header("HTTP/1.1 404 Not Found");
    $this->load->view('errors/404', $this->build_template());
    
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
