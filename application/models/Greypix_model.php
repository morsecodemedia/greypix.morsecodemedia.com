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
    }
    
    return true;
    
  }
  
  /**
   *
   * Get All Pictures in Database
   *
  **/
  public function getAllPictures()
  {

    $pictures = $this->db->get("pictures");

    return $pictures->result();
    
  }
  
  /**
   * 
   * Get All Picutrue with Details
   *
  **/
  public function getAllPicturesWithDetails()
  {
    
    $this->db->select("*");
    $this->db->from("pictures");
    $this->db->join("pictures_sizes_lookup", "pictures.id = pictures_sizes_lookup.picture_id", "LEFT");
    $this->db->join("picture_sizes", "picture_sizes.id = pictures_sizes_lookup.size_id", "LEFT");
    $pictures = $this->db->get();
    
    return $pictures->result();
    
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
    $this->db->select("*");
    $this->db->from("pictures");
    $this->db->order_by($seed, 'RANDOM');
    $this->db->limit($howMany);
    $pictures = $this->db->get();
    
    return $pictures->result();
    
  }
  
  /**
   *
   * Get all sizes of picture by ID
   *
   * @param int $pictureID
   *
  **/
  public function getSizesByPictureID($pictureID)
  {
    
    $this->db->select("*");
    $this->db->from("pictures");
    $this->db->join("pictures_sizes_lookup", "pictures.id = pictures_sizes_lookup.picture_id", "LEFT");
    $this->db->join("picture_sizes", "picture_sizes.id = pictures_sizes_lookup.size_id", "LEFT");
    $this->db->where("pictures.id", $pictureID);
    $pictures = $this->db->get();
    
    return $pictures->result();
    
  }
  
  /**
   *
   * Get specific size of a picture by id
   *
   * @param string $label
   * @param int $pictureID
   *
  **/
  public function getSpecificSizeOfPictureID($label=string, $pictureID)
  {
    $this->db->select("*");
    $this->db->from("pictures");
    $this->db->join("pictures_sizes_lookup", "pictures.id = pictures_sizes_lookup.picture_id", "LEFT");
    $this->db->join("picture_sizes", "picture_sizes.id = pictures_sizes_lookup.size_id", "LEFT");
    $this->db->where("pictures.id", $pictureID);
    $this->db->where("picture_sizes.label", $label);
    $pictures = $this->db->get();
    
    return $pictures->result();
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