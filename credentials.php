<?php
// http://localhost/uvi-user/app-api/credentials.php?email=numan@gmail.com&mbno=7980987898&pass=Numan@123&action=signin
// http://localhost/uvi-user/app-api/credentials.php?email=numan@gmail.com&pass=Numan@123&action=login
    
    error_reporting(0);
    require_once "connection.php";

    $mbnoregex = "/^[6-9]\d{9}$/";
    
    
    if(isset($_GET['email'])  && !empty($_GET['email'])
    && isset($_GET['mbno'])  && !empty($_GET['mbno'])
    && isset($_GET['pass'])  && !empty($_GET['pass'])
    && isset($_GET['action'])  && !empty($_GET['action'])
    &&$_GET['action'] == 'signin')
    {
        if(preg_match($mbnoregex, $_GET['mbno']) == 1){
            $query = $link->prepare("SELECT `email` FROM `uvi_card_user` WHERE `email` = ?");
            $query->bind_param("s", $_GET['email']);
            if ($query->execute()) {
                $res = $query->get_result();
                if (mysqli_num_rows($res) > 0) {
                    $callback['msg'] = 'Email_Exists';
                }
                else{
                    
                   
                    $query = $link->prepare("INSERT INTO `uvi_card_user` (`email`,`mobile_number`,`password`) VALUES (?,?,?)");
                    $query->bind_param("sss",$_GET['email'],$_GET['mbno'],md5($_GET['pass']));

                    if ($query->execute()) {
                        $callback['msg'] = 'Account Created';
                        $callback['user_id'] = $link->insert_id;
                    }
                    else{
                        $callback['msg'] = 'ERROR';
                    }
                }
            }
            else{
                $callback['msg'] = 'ERROR';
            }
        }
        else{
            $callback['msg'] = 'Invalid_Mobo';
        }
        

    }
    else if(isset($_GET['email'])  && !empty($_GET['email'])
    && isset($_GET['pass'])  && !empty($_GET['pass'])
    && isset($_GET['action'])  && !empty($_GET['action'])
    &&$_GET['action'] == 'login'
    ){
        $query = $link->prepare("SELECT * FROM `uvi_card_user` WHERE `email` = ?");
        $query->bind_param("s", $_GET['email']);
        if ($query->execute()) {
            $res = $query->get_result();
            if (mysqli_num_rows($res) > 0) {
                $data = mysqli_fetch_array($res);
                
                if($data['password'] == md5($_GET['pass'])){
                    $callback['msg'] = 'Valid';
                    $callback['user_id'] = $data[0];
                }
                else{
                    $callback['msg'] = 'Invalid';
                }
            }
            else{
                $callback['msg'] = 'No_Acc';
            }
        }
        else{
            $callback['msg'] = 'Invalid';
        }
    }
    echo json_encode($callback);
?>