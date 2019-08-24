<?php
    include"conn.php";
    $db->query("use license");
    @$mobile=$_GET['mobile'];
    @$name=$_GET['name'];
    @$cid=$_GET['cid'];
    @$email=$_GET['email'];
    if($email){$q="SELECT cname,cid from clients WHERE cemail like '%".$email."%'";}
    if($name){$q="SELECT cname,cid from clients WHERE cname like '%".$name."%'";}
    if($cid){$q="SELECT cname,cid from clients WHERE cid like '%".$cid."%'";}
    if($mobile){$q="SELECT cname,cid from clients WHERE cmobile like '%".$mobile."%'";}
    if(@$q){$x=$db->query($q);
    while($p=mysqli_fetch_assoc($x)){echo "<form action='viewc.php' method='POST'>Name of Client : ".$p['cname']." # Client ID : ".$p['cid']."<input type='hidden' name='viewclient' value=1 /><input type='hidden' name='cid' value='".$p['cid']."'><input type='submit' value='View Licences' /></form><hr>";}
}
?>