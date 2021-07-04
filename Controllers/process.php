<?php

    require_once('../config.php');
    require_once('../public/vendor/autoload.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../public/PHPMailer/Exception.php';
require '../public/PHPMailer/PHPMailer.php';
require '../public/PHPMailer/SMTP.php';

if(isset($_POST)){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $education = $_POST['education'];
    $education_level = $_POST['education_level'];
    $industry = $_POST['industry'];
    $work_experience = $_POST['work_experience'];

    $sqlsearch="select * from basic_profile where email=:email";
    $stmtcheck=$db->prepare($sqlsearch);
    $stmtcheck->execute([":email"=>$email]);
    $found  = $stmtcheck->fetchColumn();
    if ($found) {
        $sqlupdate = "UPDATE basic_profile SET firstname=:firstname, lastname=:lastname, phone_number=:phone_number,
                education=:education, education_level=:education_level, industry=:industry, work_experience=:work_experience WHERE email='$email';";
        $stmtupdate = $db->prepare($sqlupdate);
        $resultupdate = $stmtupdate->execute(array(":firstname"=>$firstname, ":lastname"=>$lastname,
                ":phone_number"=>$phone_number, ":education"=>$education, ":education_level"=>$education_level,
                ":industry"=>$industry, ":work_experience"=>$work_experience));
        if($resultupdate){
            echo 'Successfully Updated';
        }
    }else{
        $sqlinsert = "INSERT INTO basic_profile(firstname, lastname, email, phone_number, education, education_level, industry, work_experience) VALUES (?,?,?,?,?,?,?,?)";
        $stmtinsert = $db->prepare($sqlinsert);
        $result = $stmtinsert->execute([$firstname, $lastname, $email, $phone_number, $education, $education_level, $industry, $work_experience]);
        if($result){
            echo 'Successfully Submitted';
        }
    }

    $mpdf = new \Mpdf\Mpdf();
    if($education=='others' || $education_level=='others' || $industry=='n/a' || $work_experience=='1_yr'||$work_experience=='2_yrs'||$work_experience=='3_yrs'){
        $mpdf->WriteHTML("Dear ".$firstname." ".$lastname."<br><br>Your application was processed. According to your qualifications and skills you are <b>Not Selected this time</b> for the current opportunity at our organization.<br><br>Cheers<br>Managing Director");
    }else{
        $mpdf->WriteHTML("Dear ".$firstname." ".$lastname."<br><br>Your application was processed. According to your qualifications and skills you are <b>Selected to next round</b> for the current opportunity at our organization.<br><br>Cheers<br>Managing Director");
    }
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;

    $sqlGetId="select id from basic_profile where email='$email';";
    $stmtId = $db->prepare($sqlGetId);
    $stmtId->execute([$email]);
    $id = $stmtId->fetchColumn();
    $dir = 'C:\xampp\htdocs\Radus28\Applicant\'s PDF/';
    $filename = $id.'_'.$firstname.'_'.$lastname.'_.pdf';
    $mpdf->Output($dir.$filename);

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ramthusha96@gmail.com';
    $mail->Password = 'thushabala1996@';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('ramthusha96@gmail.com', 'On-line Registration Form');
    $mail->isHTML(true);

    $mail->addAddress('developer@nulosoft.com.au');
    $mail->Subject = 'On-line Registration Form of Applicant\'s with Details';
    $bodyContent = "FirstName: ".$firstname."<br>"."LastName: ".$lastname."<br>"."Email: ".$email."<br>"."Phone Number: ".$phone_number."<br>"."Education: ".$education."<br>"."Education Level: ".$education_level."<br>"."Industry: ".$industry."<br>"."Work Experience: ".$work_experience;
    $mail->Body = $bodyContent;
    $mail->send();

    $mail->ClearAllRecipients();

    $mail->addAddress($email);
    $mail->Subject = 'On-line Registration Form of your\'s with Details and in PDF format';
    $mail->Body = " ";
    $mail->AddAttachment($dir.$filename);
    $mail->send();

}
