<?php
    $z=base64_decode("YXZpbmFzaGthcmhhbmE=");
    $h = fopen("license.".$z, "r");
    $e=False;
    if ($h) {
        while (($l = fgets($h)) !== false) {
            try{
                explode($z,$l)[1];
                $c=base64_decode(explode($z,$l)[0]);
                $f=base64_decode(explode($z,$l)[1]);
                $t=base64_decode(explode($z,$l)[2]);
                $m=base64_decode(explode($z,$l)[3]);
                $n=base64_decode(explode($z,$l)[4]);
                $g=base64_decode(explode($z,$l)[5]);
                $ci=$c;
            }
            catch (Exception $e){
                $e=True;
            }

        }
        fclose($h);
    } 
    if ($e) {
        echo "No valid Lisence Found. Contact the Administrator !";
        exit();
    } 
    $x=false;
    include"conn.php";
    $db->query("use license");
    $myip=$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'];
    $c="SELECT * FROM licenses where cid='".$c."' and fromdate='".$f."' and todate='".$t."' and ltyc='".$m."' and lsr='".$n."' and software='".$g."'";
    $a=$db->query($c);
    $y=mysqli_fetch_assoc($a);
    if ($y['lip']==""){
        $db->query("update licenses set lip='".$myip."' where lsr='".$n."'");
    }
    else{
        if($y['lip']!=$myip){exit();}
    }
	$x=true;
    $tod=date('Y-m-d');
    if($y['todate']>=$tod && $tod>=$y['fromdate']){
        $x=true;
    }
    else{$x=false;}
    if(!$x){
        echo"License Not Valid! Contact Administrator.";
        exit();
    }
    $lincluded=true;
    echo"Lisence Verified!";
?>