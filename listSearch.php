<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link rel="stylesheet" href="listSearch.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      <div class="full-screen">
         <div class="header">
            <ul>
               <li>
                  <img src="logo.png" alt="">
               </li>
               <li><a href="">Log Out</a></li>
               <li><a href="">Home</a></li>
            </ul>
         </div>
         <div class="title">
            <h3>List of items found</h3>
         </div>
         <?php
            include("dbconnect.php");
            $sql = "select * from product where productType='".$_POST["search"]."'";
            $query = mysqli_query($dbconn, $sql) or die("Error: ".mysqli_error());
            $row = mysqli_num_rows($query);
            $sql2 = "select COUNT(*) from product GROUP BY productName";
            $query2 = mysqli_query($dbconn, $sql2) or die("Error: ".mysqli_error());
            $row2 = mysqli_num_rows($query2);
            if($row == 0){
               echo "No record found";
            }
            else{
               echo "<h3 id='keyword'>Keyword: ".$_POST["search"]."</h3>";
               echo "<table border = 1>";
               echo "<tr>";
               echo "<th>No</th>";
               echo "<th>Model</th>";
               echo "<th>Brand</th>";
               echo "<th>Num of Vendor(s)</th>";
               echo "</tr>";
               $model="initial";
               $idx = 1;
               while($row = mysqli_fetch_array($query)){
                  if($row["productName"]!=$model){
                     $row2 = mysqli_fetch_array($query2);
                     $numVendor = $row2["COUNT(*)"];
                     $model=$row["productName"];
                     echo "<tr>";
                     echo "<td>".$idx."</td>";
                     echo "<td><a href='tableCompare.php?productName=".$model."'>".$model."</a></td>";
                     echo "<td>".$row["brand"]."</td>";
                     echo "<td>".$numVendor."</td>";
                     echo "</tr>";
                     $idx++;
                  }
               }
               echo "</table>";
            }
         ?>
         <div class="filter"><button>Filter</button></div>
      </div>
   </body>
</html>