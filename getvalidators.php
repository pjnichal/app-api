<?php
// http://localhost/uvi-user/app-api/getvalidators.php?user_id=987456&action=getvalidators

    error_reporting(0);
    require_once "connection.php";

    if(isset($_GET['user_id'])  && !empty($_GET['user_id'])

    && isset($_GET['action'])  && !empty($_GET['action'])
    && $_GET['action'] == 'getvalidators'){
        $query1 = $link->prepare("SELECT `nfc_id`  FROM `uvi_card_user` WHERE `card_user_id` = ?");
        $query1->bind_param("s", $_GET['user_id']);
      if($query1->execute()){
        $res1 = $query1->get_result();
        if (mysqli_num_rows($res1) > 0) {
            $data1 = mysqli_fetch_array($res1);
        }
         $id = $data1[0];
      
        $json = array();
        $query = $link->prepare("SELECT `from_date`,`to_date`,`validating_parameter`,`is_ticket`  FROM `validator` WHERE `nfc_id` = ?");
        
        $query->bind_param("s",$data1[0]);
        if ($query->execute()) {
            
            $res = $query->get_result();
         
            // $row = mysqli_fetch_array($res);
            if(mysqli_num_rows($res) > 0){
               
                while($row = $res->fetch_assoc()){
                    array_push($json, $row);
                }   
                echo json_encode($json);
                
            }
            else{
               
                $callback['msg'] = 'ERROR';
                echo json_encode($callback);
            }
        }
        else{
            $callback['msg'] = 'ERROR';
            echo json_encode($callback);
        }
      }
      
    }

?>