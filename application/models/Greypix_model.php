<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Greypix_model extends CI_Model {

  // ! CRUD Methods

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
  
  // ! Album Methods

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
   * Get All Albums in Database
   *
  **/
  public function getAllAlbums()
  {
    
    $albums = $this->db->get("albums");
    
    return $albums->result();
    
  }

  /**
   *
   * Get All Albums in Database - Desc order
   *
  **/
  public function getAllAlbumsDesc()
  {
    $this->db->select("*");
    $this->db->from("albums");
    $this->db->order_by("albums.date_create", "DESC");
    $albums = $this->db->get();
    
    return $albums->result();
    
  }
  
  // ! Picture Methods
  
  /**
   *
   * Get All Pictures by Album ID
   *
   * @param int $albumID
   *
  **/
  public function getAllPicturesByAlbumID($albumID)
  {
    
    $pictures = $this->db->get_where("albums_pictures_lookup", array("album_id" => $albumID));
    
    return $pictures->result();
    
  }
  
  /**
   *
   * Get picture by Flickr-assigned Photo ID
   *
   * @param int $photoID
   *
  **/
  public function getPictureByID($photoID)
  {
  
    $photo = $this->db->get_where("pictures", array("id" => $photoID));
    
    return $photo->result();
    
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
    $this->db->join("picture_sizes", "picture_sizes.picture_id = pictures.id", "LEFT");
    $pictures = $this->db->get();
    
    return $pictures->result();
    
  }
  
  /**
   *
   * isPictureInAlbum
   *
   * Check to see if there is an association between a picture and an album
   *
   * @param array $payload
   *
  **/
  public function isPictureInAlbum($payload=array())
  {
    $picture = $this->db->get_where("albums_pictures_lookup", $payload);
    
    return $picture->result();
    
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
    $this->db->distinct();
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
    $this->db->join("picture_sizes", "picture_sizes.picture_id = pictures.id", "LEFT");
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
    $this->db->join("picture_sizes", "picture_sizes.picture_id = pictures.id", "LEFT");
    $this->db->where("pictures.id", $pictureID);
    $this->db->where("picture_sizes.label", $label);
    $pictures = $this->db->get();
    
    return $pictures->result();
  }
  
}