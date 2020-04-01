<?php
//database settings
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "perledorange";
// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);
$conn = mysqli_connect($servername, $username, $password, $dbname);
$con = mysqli_connect($servername, $username, $password, $dbname);  
?>

<?php 

header('Access-Control-Allow-Headers : origin, x-requested-with, content-type');
header('Access-Control-Allow-Methods :PUT, GET, POST, DELETE, OPTIONS');
header('Content-Type: application/json');

$resultpage = mysqli_query($connect,"SELECT PageToFetch FROM paginator WHERE UserName = '$user_session_temp_name' order by Id desc limit 1");     
 $retpageval = mysqli_fetch_array($resultpage);
          
$rec_limit = 7; //number of rows to return          
$offset = 0;
$pageclicked =0;
		
$pageclicked = $retpageval[0];  

	 if(!empty($pageclicked)) {            
          $offset = $rec_limit * (int)$pageclicked;
         }else {           
       $offset = 0;
         } 
         
$result = mysqli_query($connect,"SELECT pd.Id, pd.Description Description, pd.Name, Size, 
    Colour, Gender, ProdCondition, ProdImage, pc.CountryOrig, pc.CountryDestin, pc.CityDestin, 
    ProdImagePath, Availfrom, Availuntil, Price, s.SellerEmail, s.SellerPhone, DeliveryPlace 
    FROM productdetails pd 
inner join seller s on pd.Id = s.prodID 
inner join prodcountries pc on pd.Id = pc.prodID
 where Availuntil >= DATE_SUB(now(), INTERVAL 1000 DAY) 
 AND pd.Id in (select oi.prodID from ownerintention oi where oi.Itemintendedfor = 'sell')  
LIMIT $offset, $rec_limit ");
     
$data = array();
while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;  
}

print json_encode($data);
//$connect->close();
 

