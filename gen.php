<?php
    include"conn.php";
    $db->query("use license");
    $c="SELECT max(lsr) FROM licenses";
    $a=$db->query($c);
    $y=mysqli_fetch_assoc($a)['max(lsr)'];
    @$lsr=$y+1;
    @$ltyc=$_POST['ltyc'];
    @$todate=$_POST['todate'];
    @$fromdate=$_POST['fromdate'];
    @$cid=$_POST['cid'];
    @$software=$_POST['software'];
    if($lsr && $ltyc && $software && $todate && $fromdate && $cid ){
    $c="INSERT INTO `licenses` (`lsr`, `ltyc`, `todate`, `fromdate`, `cid`, `software`,`lip`) VALUES ('".$lsr."', '".$ltyc."', '".$todate."', '".$fromdate."', '".$cid."', '".$software."','')";
    $a=$db->query($c);
    $path="license/".$ltyc."/".$cid."/".$software."/".date('Y-m-d h:i:s A)');
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $z=base64_decode("YXZpbmFzaGthcmhhbmE=");
    fopen($path."/index.php", "wb");
    fopen("license/".$ltyc."/".$cid."/index.php", "wb");
    fopen("license/".$ltyc."/index.php", "wb");
    fopen("license/index.php", "wb");
    $hta=fopen($path."/.htaccess", "wb");
    fwrite($hta,"AddType application/octect-stream .avinashkarhana");
    fclose($hta);
    $myfile = fopen($path."/license.".$z, "wb") or die("Unable to open file!");
    $txt=base64_encode($cid).$z.base64_encode($fromdate).$z.base64_encode($todate).$z.base64_encode($ltyc).$z.base64_encode($lsr).$z.base64_encode($software);
    fwrite($myfile, $txt);
    fclose($myfile);
    echo"<script>alert('Successfuly Generated a License !');
    setTimeout(function () {window.open('".$path."/license.".$z."','_blank');}, 1000);
    setTimeout(function () {alert('License Should be Downloading now!');}, 2000);
    </script>";
    }
    echo"<div><form action='' id='lgen' style='display:none;' method='POST'><b>License Generator</b><br><br><table><tr><td>Client </td><td><select class='inp' name='cid'><option value='' disabled selected>Select an option</option>";
    $a=$db->query("select cid,cname from clients");
    while($y=mysqli_fetch_assoc($a)){
        echo"<option value='".$y[cid]."'>".$y['cname']."-".$y['cid']."</option>";
    }
    echo"</select></td></tr><tr><td>Lisence Type </td><td><select class='inp' name='ltyc'><option value='' disabled selected>Select an option</option>";
    $a=$db->query("select ltyc,ltname from ltype");
    while($y=mysqli_fetch_assoc($a)){
        echo"<option value='".$y['ltyc']."'>".$y['ltname']."-".$y['ltyc']."</option>";
    }
    echo"</select></td></tr><tr><td>Domain/Software IP </td><td><input class='inp' type='text' name='software' /></td></tr><tr><td>From Date </td><td><input class='inp' type='date' name='fromdate' /><td></tr><tr><td>To Date </td><td><input class='inp' type='date' name='todate' /></td></tr><tr><td><input class='inpsub' type='submit' value='Generate'/></td></tr></table></form></div>";


?>