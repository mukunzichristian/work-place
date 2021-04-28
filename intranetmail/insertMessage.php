            <?php
// include_once('connection.php');


// session_start();
// $id=$_SESSION['credentialsId'];
//  if(isset($_POST["submit"]))  
//  {  
//   $gId=@$_REQUEST["id1"];
//       $message = mysqli_real_escape_string($con, $_POST["mess"]);
    


//       $temp = explode(".", $_FILES['image']['name']);
//       $extension = end($temp);
//       $newfilename = round(microtime(true)) . '.' . end($temp);
//     $te="sam";
//       move_uploaded_file($_FILES['image']['tmp_name'], "files/".$newfilename);

//         $sql=mysqli_query($con,"insert into groupchat(message,attachment,groupId,credentialsId,recDT)
//         values('".$message."', '".$newfilename."','".$gId."','".$id."',now())");
       
      

  
// }

$connect = new PDO("mysql:host=localhost;dbname=mailserver", "root", "");
$data = array(
 ':mess'  => $_POST["mess"],
 ':image'  => $_POST["image"],
 ':id'=> $_SESSION["credentialsId"],
 ':gId' =>@$_REQUEST["id1"]
); 

 $query=INSERT INTO groupchat(message,groupId,credentialsId,recDT)
       VALUES(:mess, :gId, :id, now())");
       $statement = $connect->prepare($query);
       if($statement->execute($data))
{
       $output = array(
 ':mess'  => $_POST["mess"],
 ':image'  => $_POST["image"],
 ':id'=> $_SESSION["credentialsId"],
 ':gId' =>@$_REQUEST["id1"]
 );
echo json_encode($output);
}
  ?>