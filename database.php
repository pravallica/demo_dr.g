<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Bootstrap for Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap for CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- Bootstrap for Jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap for Javascript-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="goswami.css">
    <title> Main Page </title>
</head>

<body>
<?php
include_once 'conn.php';

if(!$conn)
{
    echo "Connection Failed!".mysqli_error();
}
else{
    // echo "Connection Successful! <br />";
}





$sql= "SELECT * FROM phones WHERE ";

if (isset($_POST['brand'])) {
    $brands = $_POST['brand'];
    $sql = $sql."brand IN (";
    //select * from phones where brand in ('apple', 'samsung')
    foreach($brands as $key=>$brand)
    {
        $sql = $sql."'$brand'";
        if ($key !== count($brands) - 1) {
    
            $sql = $sql.", ";
        }
    }
    $sql = $sql.")";
    
}


if (isset($_POST['ram'])) {
    $rams = $_POST['ram'];
    $sql=$sql." OR ";
    $sql = $sql."ram IN (";
    //select * from phones where brand in ('apple', 'samsung') or ram in ('512mb')
    foreach($rams as $key=>$rams)
    {
        $sql = $sql."'$rams'";

        if ($key !== count($rams) - 1) {
            $sql = $sql.", ";
        }
    }
    $sql = $sql.")";
    // echo $sql;
}

if (isset($_POST['operating_system'])) {
    $sql=$sql." OR ";
    $os = $_POST['operating_system'];
    $sql = $sql."operating_system IN (";
    //select * from phones where brand in ('apple', 'samsung') or ram in ('512mb') or operating_system in ('android');
    foreach($os as $key=>$os)
    {
        $sql = $sql."'$os'";
        if ($key !== count($os) - 1) {
    
            $sql = $sql.", ";
        }
    }
    $sql = $sql.");";
    // echo $sql;
}




$result=mysqli_query($conn,$sql);
$resultCheck=mysqli_num_rows($result);
if($resultCheck > 0){
    ?>

    <table class="table table-bordered">
        <tbody>
        <?php
while($row=mysqli_fetch_assoc($result)){
    ?>

            <tr>
                <td> <?php echo "Brand:".$row['brand']."<br>"."Description:". $row['description']."<br>"."RAM:".$row['ram']."<br>"."Price:$".$row['price']."<br>"."Operating System:".$row['operating_system'];  ?> </td>
            </tr>
            
    <?php

}
?>
        </tbody>
    </table>

   

<?php
}
else{
    echo "No results found";
}
?>
</body>
</html>