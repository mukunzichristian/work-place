<?php  
 function fetch_data()  
 {  
      $output = '';
      $groupId=$_GET["id2"];  
      $conn = mysqli_connect("localhost", "root", "", "mailserver");  
      $sql = "SELECT * from registration r,student s,groupcourse g,course c where r.studentId=s.studentId AND g.groupId='$groupId' and g.groupId=r.groupId and g.courseId=c.courseId";  
      $result = mysqli_query($conn, $sql);
      $a=1;  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr> 
                          <td>'.$a++.'</td>
                          <td>'.$row["name"].'</td>  
                          <td>'.$row["regno"].'</td>  
                           
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 if(isset($_POST["generate_pdf"]))  
 {  
      require_once('tcpdf/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("STUDENTS INFORMATION");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= ' 
      <img src="logo/aucalogo.png" height="70px"> 
      <h4 align="center">STUDENTS INFORMATION</h4><br /><hr> 
      <table>
      <tr>
              <th>No</th>
              <th>StudentName</th>
              <th>StudentRegNo</th>
              
           </tr>';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
 }  
 ?>
<?php include('header.php');?>
<?php include('leftsider.php');?>
<div class="content-wrapper">
  <?php if($title=="Lecture"){?>
<div class='row'>
 <div class='col-md-3' style='margin-left: 0px;'>
   
 </div>
 <div class='col-md-6' style='background-color: white'>
  <h1 class='btn btn-primary btn-block margin-bottom' style='border-radius: 10px;'>Group Information</h1>
          <div class='col-md-12' align='right'>
            <form method='post'>
              <input type='submit' name='generate_pdf' class='btn btn-success' value='Generate PDF' />
              </form>
              <br><a href="userAvailability.php?id2=<?php echo $_GET["id2"];?>"><button class="btn btn-primary " style="background-color:MediumSeaGreen;color: white">Availability</button></a>
          </div>
          <br>
          <table class='table table-hover table-striped'>
            <tr>
              <th>No</th>
              <th>StudentName</th>
              <th>StudentRegNo</th>
              
          
         </tr>
      <?php echo fetch_data();?>
</table>

  </div>
  <div class='col-md-3' style='margin-left: 0px;'>
    
  </div>
</div>
<?php 
}
else{
  echo "<div class='row'>";
 echo "<div class='col-md-3' style='margin-left: 0px;'>";
   echo "</div>";
  echo "<div class='col-md-6' style='background-color: white'>";
   echo "<h1 class='btn btn-primary btn-block margin-bottom' style='border-radius: 10px;'>Group Information</h1>";
include_once('connection.php');
$groupId=@$_REQUEST["id2"];
$id=$_SESSION["credentialsId"];
     $query="SELECT * from course c,groupcourse g, lecture l, registration r where c.courseId=g.courseId AND l.lectureId=g.lectureId
AND r.groupId=g.groupId AND r.studentId=(SELECT regId FROM credentials WHERE credentialsId='$id') AND g.groupId='$groupId'";
         $result=mysqli_query($con,$query);
         echo "<table class='table table-hover table-striped'>"; 
         echo "<tbody>";
         while($row=mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>LectureName</td>";
             echo "<td>".$row['name']."</td>";
             echo "</tr>";
            echo "<tr>";
            echo "<td>CourseName</td>";
             echo "<td>".$row['courseName']."</td>";
             echo "</tr>";
            echo "<tr>";
            echo "<td>CourseCode</td>";
             echo "<td>".$row['courseCode']."</td>";
             echo "</tr>";
              echo "<tr>";
            echo "<td>CourseCredit</td>";
             echo "<td>".$row['credit']."</td>";
             echo "</tr>";
             echo "<tr>";
            echo "<td>GroupName</td>";
             echo "<td>".$row['groupName']."</td>";
             echo "</tr>";
             echo "<tr>";
            echo "<td>Room</td>";
             echo "<td>".$row['room']."</td>";
             echo "</tr>";
              echo "<tr>";
            echo "<td>Day</td>";
             echo "<td>".$row['day']."</td>";
             echo "</tr>";
              echo "<tr>";
            echo "<td>StartHour</td>";
             echo "<td>".$row['startHour']."</td>";
             echo "</tr>";

         }
         echo "</tbody>";    
              echo "</table>";
              echo "</div>";
  echo "<div class='col-md-3' style='margin-left: 0px;'>";
  echo "</div>";
   echo "</div>";
}
?>
</div>
<?php include('footer.php');?>