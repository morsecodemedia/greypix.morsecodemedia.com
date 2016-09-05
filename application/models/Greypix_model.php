<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Greypix_model extends CI_Model {

  /**
   *
   * Insert or Update Record into Database
   *
   * @param array $payload
   * @param string $table
   * @param bool $updateRecord
   *
  **/
  public function insertIntoDB($payload=array(), $table, $updateRecord=false)
  {
    
    if (!is_array($payload)) {
      return false;  
    }
    
    if ($updateRecord) {
      // update record
      $this->db->replace($table, $payload);
    } else {
      // insert record
      $this->db->insert($table, $payload);
      echo $this->db->last_query();
      exit;
    }
    
    return true;
    
  }
  
  /**
   *
   * Get Randomized Resultset - Limited by Number
   * Set up for method chaining
   * 
   * @param int $howMany
   *
  **/ 
  public function getRandomPicturesLimitedBy($howMany)
  {
    $seed = RAND();
    $this->db->order_by($seed, 'RANDOM')
             ->limit($howMany);
    return $this;
  }
  
  /**
   *
   * Get album from Flickr-assigned Album ID
   *
   * @param int $albumID
   *
  **/
  public function getAlbumByID($albumID)
  {
    $album = $this->db->get_where("albums", array("id" => $albumID));
    return $album->result();
  }
  
  /**
   *
   * Get photo by Flickr-assigned Photo ID
   *
   * @param int $photoID
   *
  **/
  public function getPhotoByID($photoID)
  {
    $photo = $this->db->get_where("pictures", array("id" => $photoID));
    return $photo->result();
  }
  
}