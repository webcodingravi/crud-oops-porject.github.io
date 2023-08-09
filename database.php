<?php

class Database{
  /*//////////////////////////////////////*/
/********Database connection function***** */
  /*//////////////////////////////////////*/

    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "info";
    

    private $mysqli = "";
    private $result = array();
    private $conn = false;


    public function __construct() {
           if(!$this->conn) {
             $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
             $this->conn = true;
             if($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
             }
           }else{
            return true;
           }
     
    }
     /*//////////////////////////////////////*/
      /***************insert function***** */
       /*//////////////////////////////////////*/

    public function insert($table, $params=array()) {
     if($this->tableExists($table)) {

      $table_column = implode(',', array_keys($params));
      $table_value = implode("','", $params);
      $sql = "INSERT INTO $table ($table_column) VALUES ('$table_value')";

      if($this->mysqli->query($sql)) {
           array_push($this->result, $this->mysqli->insert_id);
           return true;
      }else {
        array_push($this->result, $this->mysqli->error);
        return false;
      }
     }else {
           return false;
     }
    }

      /*//////////////////////////////////////*/
      /***************End insert function***** */
       /*//////////////////////////////////////*/

       /************************************** */

     /*//////////////////////////////////////*/
      /***************update function***** */
       /*//////////////////////////////////////*/

    public function update($table, $parms=array(), $where = null) {
        if($this->tableExists($table)) {
          $args = array();
           foreach($parms as $key => $value) {
            $args[] = "$key = '$value'";
           }

          $sql = "UPDATE $table SET " . implode(',', $args);
          if($where != null) {
            $sql .= " WHERE $where";
          }
          if($this->mysqli->query($sql)) {
            array_push($this->result, $this->mysqli->affected_rows);
          }else{
            array_push($this->result, $this->mysqli->error);
            return false;
          }
        }
        else{
          return false;
        }
    }

     /*//////////////////////////////////////*/
      /***************End update function***** */
       /*//////////////////////////////////////*/



     /*//////////////////////////////////////*/
      /***************Delete function***** */
       /*//////////////////////////////////////*/

    public function delete($table, $where = null) {
       if($this->tableExists($table)) {
         $sql = "DELETE FROM $table";

         if($where != null) {
            $sql .= " WHERE $where";
         }
         if($this->mysqli->query($sql)) {
          array_push($this->result, $this->mysqli->affected_rows);
         }else {
          array_push($this->result, $this->mysqli->error);
          return false;
         }

       }else{
        return false;
       }
    }

      /*//////////////////////////////////////*/
      /***************End Delete function***** */
       /*//////////////////////////////////////*/


     /*//////////////////////////////////////*/
      /***************Select function***** */
       /*//////////////////////////////////////*/

    public function select($table, $rows="*", $join = null, $where = null, $order = null, $limit = null) {
      if($this->tableExists($table)) {
         $sql = "SELECT $rows FROM $table";
         if($join != null) {
          $sql .= " JOIN $join";
         }
         if($where != null) {
          $sql .= " WHERE $where";
         }

         if($order != null) {
          $sql .= " ORDER BY $order";
         }

         if($limit != null) {
          if(isset($_GET['page'])) {
              $page = $_GET['page'];
          }else {
            $page = 1;
          }
          $start = ($page - 1) * $limit;
          $sql .= " LIMIT $start, $limit";
         }

         $query = $this->mysqli->query($sql);
         if($query) {
           $this->result  = $query->fetch_all(MYSQLI_ASSOC);
           return true;
         }else{
           array_push($this->result, $this->mysqli->error);
           return false;
         }

      }else {
        return false;
      }
    }

      /*//////////////////////////////////////*/
      /*************End Select function***** */
       /*//////////////////////////////////////*/




      /*//////////////////////////////////////*/
      /***************pagination function***** */
       /*//////////////////////////////////////*/

    public function pagination($table, $join = null, $where = null, $limit = null) {
      if($this->tableExists($table)) {
        if($limit != null) {
          $sql = "SELECT COUNT(*) FROM $table";
          if($join != null) {
            $sql .= " JOIN $join";
          }
          if($where != null) {
            $sql .= " WHERE $where";
          }
          $query = $this->mysqli->query($sql);

          $total_record = $query->fetch_array();
          $total_record = $total_record[0];
          $total_page = ceil($total_record / $limit);

          $url = basename($_SERVER['PHP_SELF']);
          if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }else {
          $page = 1;
        }

          $output = "<div class='container'>
            <ul class='pagination justify-content-center'>";
          if($page > 1) {
            $output .= "<li class='page-item'><a class='page-link' href='$url?page=".($page - 1)."'>Prev</a></li>";
          }
            if($total_record > $limit) {
              for($i = 1; $i <= $total_page; $i++) {
                if($i == $page) {
                  $cls = "class = 'active'";
                }else {
                  $cls = "";
                }
                $output .= "<class='page-item'><a class='page-link' $cls href='$url?page=$i'>$i</a></li>";
              }
            }
            if($total_page > $page) {
              $output .= "<li class='page-item'><a class='page-link' href='$url?page=".($page + 1)."'>Next</a></li>";
            }

          $output .= "</div>
          
           </ul>";

    

          echo $output;
        }else {
          return false;
        }
      }else{
        return false;
      }

    }

    public function sql($sql) {
        $query = $this->mysqli->query($sql);
        if($query) {
          $this->result  = $query->fetch_all(MYSQLI_ASSOC);
          return true;
        }else{
          array_push($this->result, $this->mysqli->error);
          return false;
        }
    }
       /*//////////////////////////////////////*/
      /***********End pagination function***** */
       /*//////////////////////////////////////*/


     /*//////////////////////////////////////*/
      /***************table exists function***** */
       /*//////////////////////////////////////*/

    private function tableExists($table) {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if($tableInDb) {
          if($tableInDb->num_rows == 1) {
            return true;
          }else {
               array_push($this->result, $table. "Does not exist in this database.");
              return false;
          }

          
        }
    }

        /*//////////////////////////////////////*/
      /***************get Result function***** */
       /*//////////////////////////////////////*/

    public function getResult() {
      $val = $this->result;
      $this->result = array();
      return $val;
    } 

    /*//////////////////////////////////////*/
      /***************destruct function***** */
       /*//////////////////////////////////////*/

    public function __destruct() {
         if($this->conn) {
           if($this->mysqli->close()) {
            $this->conn = false;
            return true;
           }
         }else {
            return false;
         }
    }
}











?>