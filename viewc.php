<?php
    include"conn.php";
    $db->query("use license");
    @$cid=$_POST['cid'];
    @$viewclient=$_POST['viewclient'];
    if($viewclient==0){echo"<h1>All Licenses and respective Details</h1><br><br><br>";}
    if(@$_POST['setstatus']==1){
        $db->query("Update licenses set status=".$_POST['status']." where cid='".$_POST['cid']."' and lsr='".$_POST['lsr']."'");
    }
    if($cid && $viewclient==1){$q="SELECT * from licenses WHERE cid ='".$cid."' order by status desc";}
    if($viewclient==0){$q="SELECT * from licenses order by status and cid desc";}
    if(@$q){
        $x=$db->query($q);
    if($viewclient==1){
        if($cid){$qq="SELECT * from clients WHERE cid ='".$cid."'";}
        if(@$qq){$pp=mysqli_fetch_assoc($db->query($qq));
        echo"Name of Client : ".$pp['cname']."<br>Client ID : ".$pp['cid']."<br>Client Mobile : ".$pp['cmobile']."<br>Client Email : ".$pp['cemail']."<hr>Licenses issued to Client :<br>";}}
    echo"<table style='border:1px solid black'><tr>";
    if($viewclient==0){echo"<th>Client ID</th><th>Client Name</th>";}
    echo"<th>License Type</th><th>License Number</th><th>Valid From</th><th>Valid Till</th><th>Current Status</th><th>Operation</th></tr>";}
    while($p=mysqli_fetch_assoc($x)){
        $tod=date('Y-m-d');
        if($p['status']==1 && $p['todate']>=$tod && $p['fromdate']<=$tod){$col="Green";}else{$col="Red";$db->query("Update licenses set status=0 where cid='".$p['cid']."' and lsr='".$p['lsr']."'");}
    }
    $x=$db->query($q);
    while($p=mysqli_fetch_assoc($x)){
        $ltyc=mysqli_fetch_assoc($db->query("Select ltname from ltype where ltyc=".$p['ltyc'].""))['ltname'];
        if($p['status']){$status="Active";}else{$status="In-Active";}
        $tod=date('Y-m-d');
        if($p['status']==1 && $p['todate']>=$tod && $p['fromdate']<=$tod){$col="Green";}else{$col="Red";$db->query("Update licenses set status=0 where cid='".$p['cid']."' and lsr='".$p['lsr']."'");}
        echo "<tr style='color:white;' bgcolor='".$col."'>";
        if($viewclient==0){
            $qqq="SELECT cname from clients WHERE cid ='".$p['cid']."'";}
            if(@$qqq){$ppp=mysqli_fetch_assoc($db->query($qqq));
            echo"<td>".$p['cid']."</td><td>".$ppp['cname']."</td>";
        }
        echo"<td>".$ltyc."-".$p['ltyc']."</td><td>".$p['lsr']."</td><td>".$p['fromdate']."</td><td>".$p['todate']."</td><td>".$status."</td><td>";
        if($p['todate']>=$tod && $p['fromdate']<=$tod){
        echo"<form action='viewc.php' style='margin:2px;' method='POST'><input type='hidden' name='lsr' value='".$p['lsr']."'><input type='hidden' name='cid' value='".$p['cid']."'><input type='hidden' name='setstatus' value=1 ><select name='status'>";
        if($p['status']==1){echo"<option value=1 selected>Enable</option><option value=0 >Disable</option>";}
        else{echo"<option value=1>Enable</option><option value=0 selected>Disable</option>";}
        echo"</select>";
        if($viewclient==1){
            echo"<input type='hidden' name='viewclient' value=1 />";
        }
        echo"<input type='submit' value='Set' /></form>";
        }
        else{
            echo"License Validation Date Passed !";
        }
        echo"</td></tr>";
    }
        echo"</table><br><br>*Rows in Green are Active<br>*Rows in Red are In-Active<br><br><a href='dash.php'>Back to Dashboard</a>";
?>