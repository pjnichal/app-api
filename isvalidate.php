<?php
// http://localhost/uvi-user/app-api/isvalidate.php?int=1&api_id=pA6G5WUD9X1O&nfc_id=123456&action=changeisvalidate

    error_reporting(0);
    require_once "connection.php";

    if(isset($_GET['int'])  && !empty($_GET['int'])
    && isset($_GET['api_id'])  && !empty($_GET['api_id'])
    && isset($_GET['nfc_id'])  && !empty($_GET['nfc_id'])
    && $_GET['action'] == 'changeisvalidate'){
      
        $json = array();
        $query = $link->prepare("UPDATE `validator` SET `is_validated` = ? WHERE `api_id`=? AND `nfc_id` = ?");
       
        $query->bind_param("sss",$_GET['int'],$_GET['api_id'],$_GET['nfc_id']);
        if ($query->execute()) {
            
            $callback['status'] = 'is_validated updated to '.$_GET['int'];

            
            echo json_encode($callback);
                
        }
        else{
            
            $callback['msg'] = 'ERROR';
            echo json_encode($callback);
        }
    }
    

?>