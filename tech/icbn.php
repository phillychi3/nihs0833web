<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ISBN 長度校驗碼檢查</title>
</head><body>
<form action="" method="POST">
    ISBN:
    <textarea name="text" cols="" rows="">
</textarea>
    <input name="submit" type="submit" value="傳送"/>
</form>
<?php
error_reporting(0);
if(isset($_POST["submit"])){
    $standard_A = "/^([0-9]+)$/"; 
    $c=($_POST["text"]);
    $d=(explode("\n",$c)); 
    for($i=1;$i<=$d[0];$i++){
        $d[$i]=str_replace(array(" ",'-', "\r"),"",$d[$i]);
        if(preg_match("/^([0-9]+)$/",$d[$i])){
            $s=0;
            for($j=0;$j<12;$j++){
                $s=$s+($d[$i][$j]*(1+$j%2+$j%2));
            }
                    $r=$s%10;$n=10-$r;                    
                    if($n!=$d[$i][$j]){
                        echo"X";echo"<br>";                            
                    }
                    else{
                        echo"O";echo"<br>";                            
                    }
        }
        else{
            echo"X";echo"<br>";            
        }
    }
}
?>
</body>
</html>