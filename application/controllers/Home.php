<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
  {
	  
	  parent::__construct();
	  
	  // the an empty data array
	  $this->data = array();
	  	  
	  // Load models
	  $this->load->model('Greypix_model', 'gpdb');
	  
	  // Check if the site is under maintenance
	  if ( $this->config->item("maintenance_mode") ) {
	    header('HTTP/1.1 503 Service Temporarily Unavailable');
	    header('Status: 503 Server Temporarily Unavailable');
	    header('Retry-After: 3600');
  	  $this->load->view('errors/maintenance', $this->build_template());
	  }
	  
	}  

	public function index()
	{
	  
	  $randPix = $this->gpdb->getRandomPicturesLimitedBy(12);
    
    if ($randPix) {
      foreach ($randPix as $rp) {
        
        $lg1600 = $this->gpdb->getSpecificSizeOfPictureID("Large 1600", $rp->id);
        $orig = $this->gpdb->getSpecificSizeOfPictureID("Original", $rp->id);
        
        $rp->lg1600_size = ($lg1600) ? $lg1600[0]->data_uri : false;
        $rp->orig_size = ($orig) ? $orig[0]->data_uri : false;

      }  
    }
	  
	  $this->data['randPix'] = $randPix;
	  
		$this->load->view('pages/home', $this->build_template());
	}

	public function albums($albumID=null)
	{
  	
  	if ($albumID) { // if an album ID is supplied - go to that album's detail page

    	$album = $this->gpdb->getAlbumByID($albumID);
      $album[0]->photoset = $this->gpdb->getAllPicturesByAlbumID($albumID);
      
      if (!empty($album[0]->photoset) || $album[0]->photoset != NULL) {
        foreach ($album[0]->photoset as $photo) {
        
          $details = $this->gpdb->getPictureByID($photo->picture_id);
          $lg1600  = $this->gpdb->getSpecificSizeOfPictureID("Large 1600", $photo->picture_id);
          $orig    = $this->gpdb->getSpecificSizeOfPictureID("Original", $photo->picture_id);
          
          $photo->title       = (preg_match("/[a-z]/i", $details[0]->title)) ? $details[0]->title : false;
          $photo->description = (preg_match("/[a-z]/i", $details[0]->description)) ? $details[0]->description : false;
          $photo->lg1600_size = ($lg1600) ? $lg1600[0]->data_uri : false;
          $photo->orig_size   = ($orig) ? $orig[0]->data_uri : false;
          
        }
      }

    	$this->data['album'] = $album;
    	
  	  $this->load->view('pages/album-details', $this->build_template());
      
  	} else {

    	$albums = $this->gpdb->getAllAlbumsDesc();
  
    	if ($albums) {
      	foreach ($albums as $album) {
        	
        	$lg1600 = $this->gpdb->getSpecificSizeOfPictureID("Large 1600", $album->primary);
          $orig   = $this->gpdb->getSpecificSizeOfPictureID("Original", $album->primary);
          
          $album->lg1600_size = ($lg1600) ? $lg1600[0]->data_uri : false;
          $album->orig_size   = ($orig) ? $orig[0]->data_uri : false;
        	
      	}
    	}
    	
    	$this->data['albums'] = $albums;
    	
  	  $this->load->view('pages/albums', $this->build_template());
    	
  	}
  	
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
