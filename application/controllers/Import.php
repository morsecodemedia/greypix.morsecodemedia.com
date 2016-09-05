<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {

	public function __construct()
  {
	  
	  parent::__construct();
	  
	  // Set a different basic authentication for this controller only
/*
	  if (!isset($_SERVER['PHP_AUTH_USER']) || 
	      $_SERVER['PHP_AUTH_USER'] != $this->config->item('admin_username') || 
	      $_SERVER['PHP_AUTH_PW'] != $this->config->item('admin_password')) {
          header('WWW-Authenticate: Basic realm="GreyPix"');
          header('HTTP/1.0 401 Unauthorized');
          die('Access Denied');
    }
*/
	  
	  // DateTime object
	  $this->dateObj = new DateTime();
	  
	  // Load library
	  $this->load->library('flickr');
	  
	  // Load models
	  $this->load->model('Greypix_model', 'gpdb');
	  
  }
	
	public function index()
	{
	  // TO DO:
  	// create page that has 3 buttons
  	// 1 button to update the albums
  	// 1 button to update the photos
  	// 1 button to update both
  	$this->import_albums(true);
	}
	
	public function authenticate_app()
	{
  	
  	unset($_SESSION['phpFlickr_auth_token']);
    
    $default_redirect = "/import/import-albums/";
     
  	if ( isset($_SESSION['phpFlickr_auth_redirect']) && !empty($_SESSION['phpFlickr_auth_redirect']) ) {
  		$redirect = $_SESSION['phpFlickr_auth_redirect'];
  		unset($_SESSION['phpFlickr_auth_redirect']);
  	}
  	
    if (empty($_GET['frob'])) {
      $this->flickr->f->auth($permissions, true);
    } else {
      $this->flickr->f->auth_getToken($_GET['frob']);
    }
    
    if (empty($redirect)) {
  		header("Location: " . $default_redirect);
    } else {
	  	header("Location: " . $redirect);
    }
  	
	}
	
	private function getAllAlbums()
	{
    
    $albums = $this->flickr->f->photosets_getList($this->config->item('flickr_user_id'));
    return $albums;
    
	}
	
	public function import_albums()
	{
    
    $frob           = $this->flickr->f->auth();
    $token          = $this->flickr->f->auth_checkToken();  
    $albums         = $this->getAllAlbums();
    $newAlbums      = 0;
    $updatedAlbums  = 0;
    $deletedAlbums  = 0;
    $msg            = "";
    
    if ($albums) {
      
      foreach ($albums['photoset'] as $album) {
        
        $payload = array("id"           => $album['id'],
                         "title"        => $album['title'],
                         "description"  => $album['description'],
                         "primary"      => $album['primary'],
                         "photos"       => $album['photos'],
                         "date_create"  => $this->dateObj->setTimestamp($album['date_create'])->format('Y-m-d H:i:s'),
                         "date_update"  => $this->dateObj->setTimestamp($album['date_update'])->format('Y-m-d H:i:s')
                        );
        
        // check if album exists in database
        $albumExists = $this->gpdb->getAlbumByID($album['id']);
        
        // if no records come back
        if (!$albumExists) {
          // insert album into database
          $this->gpdb->insertIntoDB($payload, "albums");  
          $newAlbums++;
        } else {
          // check if up-to-date
          if ($this->dateObj->setTimestamp($album['date_update'])->format('Y-m-d H:i:s') > $albumExists[0]->date_update) {
            // update record
            $this->gpdb->insertIntoDB($payload, "albums", $album['id']);
            $updatedAlbums++;
          }
        }
        
        // get all photos in this album
        $photos = $this->getPhotosByAlbumID($album['id']);
        
        // if there are photos in the album
        if ($photos) {
          $pictureLog = $this->importPhotos($photos);
        }
 
      }
            
    }
    
    // output message
    $msg .= "<p>$newAlbums albums added.</p>";
    $msg .= "<p>$updatedAlbums albums updated.</p>";
    $msg .= "<p>$deletedAlbums albums deleted.</p>";
    $msg .= (isset($pictureLog)) ? $pictureLog : "";
    
    return $msg;
    
	}
	
	private function removeAlbums($albums)
	{
    // TO DO
    // Removal of albums in database that no longer are in Flickr (via API)	
	}
	
	private function getPhotosByAlbumID($albumID)
	{
    
    if (!$albumID) {
      return false;
    }
    
    $photos = $this->flickr->f->photosets_getPhotos($albumID);
    
    return $photos;
    
	}
  
  private function getPhotoDetailsByID($photoID)
  {
    
    if (!$photoID) {
      return false;
    }
    
    $photoDetails = $this->flickr->f->photos_getInfo($photoID);
    
    $payload = array("id"           => $photoDetails['photo']['id'],
                     "title"        => $photoDetails['photo']['title'],
                     "description"  => $photoDetails['photo']['description'],
                     "dateuploaded" => $this->dateObj->setTimestamp($photoDetails['photo']['dateuploaded'])->format('Y-m-d H:i:s'),
                     "lastupdate"   => $this->dateObj->setTimestamp($photoDetails['photo']['dates']['lastupdate'])->format('Y-m-d H:i:s')
                    );

    return $payload;
    
  }
  
  private function getPhotoSizesByID($photoID)
  {
    
    if (!$photoID) {
      return false;
    }
    
    $photoSizes = $this->flickr->f->photos_getSizes($photoID);
    
    return $photoSizes;
    
  }
  
  private function importPhotos($photos)
  {
    
    if (!$photos) {
      return false;
    }
    
    $msg = "";
    $newPhotos = 0;
    $deletedPhotos = 0;
    
    // loop through the photos
    foreach ($photos['photoset']['photo'] as $photo) {
      // get photo details
      $photoDetailsPayload = $this->getPhotoDetailsByID($photo['id']);;
      
      // check if the photo exist
      $photoExists = $this->gpdb->getPhotoByID($photo['id']);

      if (!$photoExists) {
        // insert photo into database
        $this->gpdb->insertIntoDB($photoDetailsPayload, "pictures");
        $newPhotos++;
        
        $photoSizePayload = $this->getPhotoSizesByID($photo['id']);
        // loop through sizes
        foreach ($photoSizePayload as $size) {
          // insert sizes into database
          $this->gpdb->insertIntoDB($size, "picture_sizes");
          $sizeID = $this->db->insert_id();
            
          // create lookup record between photo and size
          $lookupPayload = array("picture_id" => $photo['id'],
                                 "size_id"    => $sizeID
                                );
                          
          $this->gpdb->insertIntoDB($lookupPayload, "pictures_sizes_lookup");
        }
      }
      
    }
    
    // output message
    $msg .= "<p>$newPhotos pictures added.</p>";
    $msg .= "<p>$deletedPhotos pictures deleted.</p>";
    
    return $msg;
    
  }
  
  private function removePictures($pictures)
	{
    // TO DO
    // Removal of pictures in database that no longer are in Flickr (via API)	
    // the picture 
    // the picture sizes
    // the picutre-sizes lookup
	}

}
