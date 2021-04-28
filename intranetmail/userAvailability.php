<?php 
function fetch_student()  
 { 
$output = '';
      $no=0;
      $groupId=$_GET["id2"];  
      $conn = mysqli_connect("localhost", "root", "", "mailserver");  
      $sql = "SELECT regno, name, courseName, groupName, s.dates, COUNT(s.credentialsId) as participation FROM studentparticipation s, studentparticipation_view sv 
WHERE s.groupId = sv.groupId AND sv.credentialsId = s.credentialsId AND s.groupId = '$groupId' 
GROUP BY s.dates, s.credentialsId ORDER BY date(dates) DESC";  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
      $no++;     
      $output .= '<tr>  
                          <td>'.$no.'</td> 
                          <td>'.$row["regno"].'</td>  
                          <td>'.$row["name"].'</td>
                          <td>'.$row["dates"].'</td>  
                     </tr>  
                          ';
                            
      }  
      return $output; 
 }
 if(isset($_POST["generateStudent_pdf"]))  
 {  
      require_once('tcpdf/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Students Availability");  
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
      <h4 align="center">Students Availability</h4><br /><hr> 
      <table>
      <tr>
              <th>No</th>
              <th>RegNo</th>
              <th>StudentName</th>
              <th>Date</th>
           </tr>';  
      $content .= fetch_student();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
 }  
 ?>
<?php
function fetch_user()  
 {  
      $output = '';
      $no=0;
      //$groupId=$_GET["id2"];  
      $conn = mysqli_connect("localhost", "root", "", "mailserver");  
      $sql = "SELECT dates, userTitle, COUNT(credentialsId) as Participation
FROM logeduser_view
GROUP BY userTitle, dates
ORDER BY date(dates) DESC";  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {  
      $no++;     
      $output .= '<tr>  
                          <td>'.$no.'</td> 
                          <td>'.$row["userTitle"].'</td>  
                          <td>'.$row["dates"].'</td>
                          <td>'.$row["Participation"].'</td> 
                     </tr>  
                          ';
                            
      }  
      return $output;  
 }
 if(isset($_POST["generateUser_pdf"]))  
 {  
      require_once('tcpdf/tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Users Availability");  
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
      <h4 align="center">Users Availability</h4><br /><hr> 
      <table>
      <tr>
              <th>No</th>
              <th>UserTitle</th>
              <th>Date</th>
              <th>Participation</th>
           </tr>';  
      $content .=fetch_user();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
 }  
?>
<?php include('header.php');?>
<?php include('leftsider.php');?>
<div class="content-wrapper">
  <?php if($title=="Admin"){?>
  <div class='row'>
 <div class='col-md-3' style='margin-left: 0px;'>
   </div>
  <div class='col-md-6' style='background-color: white'>
   <h1 class='btn btn-primary btn-block margin-bottom' style='border-radius: 10px;'>User Availability</h1>
    <form method='post'>
              <input type='submit' name='generateUser_pdf' class='btn btn-success' value='Generate PDF' />
              </form>
       <table class='table table-hover table-striped'>
<tr>
              <th>No</th>
              <th>UserTitle</th>
              <th>Date</th>
              <th>Participation</th>
              
         </tr>
           <?php echo fetch_user();?>   
     </table>     
   </div>   
  <div class='col-md-3' style='margin-left: 0px;'>
  </div>
  </div>
  <?php 
}else
{
?>

<div class='row'>
 <div class='col-md-3' style='margin-left: 0px;'>
   </div>
  <div class='col-md-6' style='background-color: white'>
   <h1 class='btn btn-primary btn-block margin-bottom' style='border-radius: 10px;'>Students Availability</h1>
   <?php
   $gid=$_GET["id2"];
$query=mysqli_query($con,"SELECT groupName,courseName
  FROM timetable where groupId='$gid'");
$row=mysqli_fetch_array($query);
echo"<center>";
echo"<h3>";
echo $row['courseName']." ".$row['groupName'];
echo "</h3>";
echo"</center>";
   ?>

   <!-- <form method="POST">
        
          <input type="text" name="search" class="search" placeholder="Search here..." style=" 
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
  width:80%;height:35px;"/>
          <input type="submit" value="Search" name="searchOption" style="border-radius: 5px; width:18%;height:35px; font-size: 16px; border: 2px solid #ccc;"/>
          </form><br> -->
          <form method='post'>
              <input type='submit' name='generateStudent_pdf' class='btn btn-success' value='Generate PDF' />
              </form>
       <table class='table table-hover table-striped'>

<tr>
              <th>No</th>
              <th>RegNo</th>
              <th>StudentName</th>
              <th>Date</th>
              
         </tr>
           <?php echo fetch_student();?>   
     </table>     
   </div>   
  <div class='col-md-3' style='margin-left: 0px;'>
  </div>
  </div>

<?php
}
?>
</div>
<?php include('footer.php');?>