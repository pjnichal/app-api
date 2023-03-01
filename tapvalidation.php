<?php
// http://localhost/uvi-user/app-api/tapvalidation.php?api_id=pA6G5WUD9X1O&nfc_id=123456&action=tapvalidation

    error_reporting(0);
    require_once "connection.php";

    if(isset($_GET['api_id'])  && !empty($_GET['api_id'])
    && isset($_GET['nfc_id'])  && !empty($_GET['nfc_id'])
    && isset($_GET['action'])  && !empty($_GET['action'])
    && $_GET['action'] == 'tapvalidation'){
      
        $json = array();
        $query = $link->prepare("SELECT *  FROM `validator` WHERE `api_id`=? AND `nfc_id` = ?");
       
        $query->bind_param("ss",$_GET['api_id'],$_GET['nfc_id']);
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
    

?>