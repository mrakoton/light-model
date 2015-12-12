<?php
namespace Mrakoton\Orm\Model;

use Mrakoton\Orm\Base\Model;

class User extends Model {
  /**
   * @Type:Int
   */
  private $id;

  /**
   * @Type:String
   */
  private $username;

  /**
   * @Type:String
   */
  private $firstname;

  /**
   * @Type:String
   */
  private $lastname;

  /**
   * @Type:DateTime
   */
  private $created_at;

  /**
   * @Type:Float
   */
  private $weight;

  /**
   * @Type:Int
   */
  private $height;

  /**
   * Get the value of Id
   *
   * @return mixed
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Set the value of Id
   *
   * @param mixed id
   *
   * @return self
   */
  public function setId($id)
  {
      $this->id = $id;

      return $this;
  }

  /**
   * Get the value of Username
   *
   * @return mixed
   */
  public function getUsername()
  {
      return $this->username;
  }

  /**
   * Set the value of Username
   *
   * @param mixed username
   *
   * @return self
   */
  public function setUsername($username)
  {
      $this->username = $username;

      return $this;
  }

  /**
   * Get the value of Firstname
   *
   * @return mixed
   */
  public function getFirstname()
  {
      return $this->firstname;
  }

  /**
   * Set the value of Firstname
   *
   * @param mixed firstname
   *
   * @return self
   */
  public function setFirstname($firstname)
  {
      $this->firstname = $firstname;

      return $this;
  }

  /**
   * Get the value of Lastname
   *
   * @return mixed
   */
  public function getLastname()
  {
      return $this->lastname;
  }

  /**
   * Set the value of Lastname
   *
   * @param mixed lastname
   *
   * @return self
   */
  public function setLastname($lastname)
  {
      $this->lastname = $lastname;

      return $this;
  }

  /**
   * Get the value of Created At
   *
   * @return mixed
   */
  public function getCreatedAt()
  {
      return $this->created_at;
  }

  /**
   * Set the value of Created At
   *
   * @param mixed created_at
   *
   * @return self
   */
  public function setCreatedAt($created_at)
  {
      $this->created_at = $created_at;

      return $this;
  }

    /**
     * Get the value of Weight
     *
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of Weight
     *
     * @param mixed weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of Height
     *
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of Height
     *
     * @param mixed height
     *
     * @return self
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

}
