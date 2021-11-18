<?php
require_once("config.php");
function signup($data, $con)
{
    $query = "select * from login where email='" . $data['email'] . "'";
    $response = mysqli_query($con, $query) or die("Error in executing the query");
    $num = mysqli_num_rows($response);
    if ($num == 1) {
        return 0;
    } else {
        $query1 = "insert into login(name,email,phoneno,password)values('" . $data['name'] . "','" . $data['email'] . "','" . $data['phone'] . "','" . $data['password'] . "')";
        mysqli_query($con, $query1) or die("Error in executing the query1");
        $query = "select * from login where email='" . $data['email'] . "'";
        $result = mysqli_query($con, $query);
        $data = mysqli_fetch_array($result);
        return $data;
    }
}

function login($info, $con)
{
    $query2 = "select * from login where email='" . $info['email'] . "' and password='" . $info['password'] . "'";
    $response2 = mysqli_query($con, $query2) or die("Error in executing the query2");
    $data = mysqli_fetch_array($response2);
    return $data;
}
function form($data, $con)
{
    echo $query3 = "update resume set 
     image='".$data['img']."',
     first_name='" . $data['first_name'] . "',
     last_name='" . $data['last_name'] . "',
     gender='" . $data['gender'] . "',
     dob='" . $data['dob'] . "',
     mobile='" . $data['mobile'] . "',
     email='" . $data['email'] . "',
     address='" . $data['address'] . "',
     nationality='" . $data['nationality'] . "',
     High_school='" . $data['high_school'] . "',
     Intermediate='" . $data['intermediate'] . "',
     Graduation='" . $data['graduation'] . "',
     post_graduation='" . $data['post_graduation'] . "',
     phd='".$data['phd']."',
     objective='" . $data['objective'] . "',
     strength='" . $data['strength'] . "',
     hobbies='" . $data['hobbies'] . "',
     skills='" . $data['skills'] . "',
     extra_curicullar='" . $data['activities'] . "',
     achievements='" . $data['achievements'] . "',
     project_title='" . $data['project_title'] . "',
     project_description='" . $data['project_description'] . "',
     e_id='" . $data['e_id'] . "',
     company_name='" . $data['company'] . "',
     designation='" . $data['designation'] . "',
     experience='" . $data['experience'] . "',
     joining_date='" . $data['join_date'] . "',
     leaving_date='" . $data['leave_date'] . "',
     status=1 
     where id='".$data['id']."'"; 
    mysqli_query($con, $query3) or die("Error in executing the query3");
    return 1;
}
if (isset($_GET['resume'])){
    $id=$_GET['resume'];
    echo $query4="delete from resume where user_id = $id";
    $response4=mysqli_query($con,$query4) or die("Error in deleting the query4");
    header("location: admin/index.php");
}