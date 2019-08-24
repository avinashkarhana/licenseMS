<?php
    include "conn.php";
    $db->query("use license");
    @$q=$_POST['cname'];
    @$m=$_POST['cmobile'];
    @$e=$_POST['cemail'];
    @$l=$_POST['fun'];
    @$i=$_POST['ltname'];
    if($q && $m && $e && $l=='1'){
    if($db->query("INSERT INTO `clients` (`cid`, `cname`, `cmobile`, `cemail`) VALUES (NULL, '".$q."', '".$m."', '".$e."')")){
        echo"Successfully Added client : ".$q;}}
    if($l=2 && $i)
      {if($db->query("INSERT INTO `ltype` (`ltyc`, `ltname`) VALUES (NULL, '".$i."')")){
        echo"Successfully Added License Type : ".$i;}}
?>
<html>
<head><title>License Management Dashboard</title>
<link rel="stylesheet" href="a.css">
<script>
function up(){
  var a= document.getElementById('searchbox');
  a.style.transform= 'translate(30%,-70%)';
  document.getElementById('minimize').style.display="inline";
}
function down(){
  var a= document.getElementById('searchbox');
  a.style.transform= 'translate(-4%,4%)';
  document.getElementById('minimize').style.display="none";
}
function cl(){
  var a= document.getElementById('searchbox');
  a.style.display="none";
}
</script>
</head>
<b><h1 align="center" >Admin Dashboard</h1></b><br><br><div style="position: absolute;
  left: 40%;
  transform: translate(-30%,0%);margin-bottom:60px;">
<button onclick="document.getElementById('addc').style.display='block';document.getElementById('lgen').style.display='none';document.getElementById('addltype').style.display='none';">Add New Client</button>
<button onclick="document.getElementById('addc').style.display='none';document.getElementById('lgen').style.display='none';document.getElementById('addltype').style.display='block';">Add New License Type</button>
<button onclick="document.getElementById('addc').style.display='none';document.getElementById('lgen').style.display='block';document.getElementById('addltype').style.display='none';">Generate License</button>
<button onclick="window.location.replace('viewc.php')">View All License</button></div>
<div style="height:20%;width:100%;"></div>
<?php include "gen.php"; ?>
<form action='' style="display:none;" id='addc' method='POST'>
<b>Add new Client</b><br><br>
<table>
<input type='hidden' name='fun' vlaue='1' />
<tr><td>Name</td><td><input class='inp' type='text' name='cname' /></td></tr>
<tr><td>Mobile</td><td><input class='inp' type='number' name='cmobile' /></td></tr>
<tr><td>Email</td><td><input class='inp' type='email' name='cemail' /></td></tr>
<tr><td><input class='inpsub' type='submit' value='Add Client' /></td></tr>
</table>
</form>
<form action='' style="display:none;" id='addltype' method='POST'>
<b>Add new License Type</b><br><br>
<table>
<input type='hidden' name='fun' vlaue='2' />
<tr><td>Name</td><td><input class='inp' type='text' name='ltname' /></td></tr>
<tr><td><input class='inpsub' type='submit' value='Add License Type' /></td></tr>
</table>
</form>
<script>
function search(tr){
var ct=document.getElementById('sc').value;
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    document.getElementById("data").innerHTML = this.responseText;
  }
};
xhttp.open("GET", "search.php?"+ct+"="+tr, true);
xhttp.send();}
</script><br><br><br><hr>
<div id="searchbox" style='display:block;'><b>Search Client</b>
<div onclick='up()' alt='Maximize' style="cursor:pointer;display:inline;position:absolute;right:80px;width:15px;height:15px;color:white;background:blue;padding-bottom:4px;padding-left:9px;border:1px solid balck;border-radius:50%;">^</div>
<div onclick='down()' alt='Minimize' id='minimize' style="cursor:pointer;display:none;position:absolute;right:50px;width:15px;height:15px;color:white;background:green;padding-bottom:4px;padding-left:9px;border:1px solid balck;border-radius:50%;">-</div>
<div onclick='cl()' alt='Close' style="cursor:pointer;display:inline;position:absolute;right:20px;width:15px;height:15px;color:white;background:red;padding-bottom:4px;padding-left:5px;padding-right:2px;border:1px solid balck;border-radius:50%;">X</div>
<br><br>On basis of : <select style="display:inline;" id='sc'><option value='name'>Name</option><option value='mobile'>Mobile</option><option value='email'>Email</option><option value='cid'>Client ID</option></select>
<input type='text' name='mobile' onkeyup="search(this.value)" /><br><br>
<div id='data' style='border:1px solid black;background:grey;overflow: scroll;'></div></div>
</body>
</html>