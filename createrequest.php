<?php
    // http://localhost/uvi-user/app-api/createrequest?user_id=1&action=createrequest
    error_reporting(0);
    require_once "connection.php";
    
    if(isset($_GET['user_id'])  && !empty($_GET['user_id'])
    && isset($_GET['action'])  && !empty($_GET['action'])
    &&$_GET['action'] == 'createrequest'
    ){
        $query = $link->prepare("SELECT * FROM `card_request` WHERE `user_id` = ?");
        $query->bind_param("i", $_GET['user_id']);
        if ($query->execute()) {
            $res = $query->get_result();
            if (mysqli_num_rows($res) > 0) {
                $data = mysqli_fetch_array($res);
                $callback['msg'] = 'Request Already Created';
                $callback['status'] = $data['status'];
            }
            else{
                
                $status = 'Pending Approval';
                $query = $link->prepare("INSERT INTO `card_request` (`user_id`,`status`) VALUES (?,?)");
                $query->bind_param("is",$_GET['user_id'],$status);

                if ($query->execute()) {
                    $callback['msg'] = 'Request Created';
                    
                }
                else{
                    $callback['msg'] = 'Somthing Went Worng';
                }
            }
        }
        else{
            $callback['msg'] = 'Somthing Went Worng';
        }
    }
    echo json_encode($callback);
?>