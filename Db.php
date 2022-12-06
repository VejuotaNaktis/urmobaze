<?php

class Db {
      public $conn;

      public function __construct() 
      {
      
      $servername= "localhost";
      $username ="root";
      $password ="";
      $db ="urmo_baze";
      $this->conn = new mysqli($servername,$username,$password,$db);
     }
}
