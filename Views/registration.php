
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <link rel="stylesheet" href="../public/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <form action='registartion.php' method="POST" class="appointment-form" id="appointment_form">
                <h2>On-line Application Form</h2>
                <div class="form-group-1">
                    <input type="text" name="firstname" id="firstname" placeholder="First Name" />
                    <input type="text" name="lastname" id="lastname" placeholder="Last Name" required />
                    <input type="email" name="email" id="email" placeholder="Email" required/>
                    <input type="number" name="phone_number" id="phone_number" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"/>
                    <select name="education" id="education" required>
                        <option slected value="">Education</option>
                        <option value="software_engineering">Software engineering</option>
                        <option value="information_technology">Information Technology</option>
                        <option value="computer_science">Computer Science</option>
                        <option value="computer_applications">Computer Applications</option>
                        <option value="others">Others</option>
                    </select>
                    <select name="education_level" id="education_level" required>
                        <option slected value="">Education Level</option>
                        <option value="post_graduate">Post Graduate</option>
                        <option value="under_graduate">Under Graduate</option>
                        <option value="diploma">Diploma</option>
                        <option value="others">Others</option>
                    </select>
                    <select name="industry" id="industry" required>
                        <option slected value="">Industry</option>
                        <option value="software_engineering">Software Engineering</option>
                        <option value="qa_qutomation">QA Automation</option>
                        <option value="database_administration">Database Administration</option>
                        <option value="system_administration">System Administration</option>
                        <option value="n/a">N/A</option>
                    </select>
                    <select name="work_experience" id="work_experience" required>
                        <option slected value="">Work Experience</option>
                        <option value="1_yr">1 Yr</option>
                        <option value="2_yrs">2 Yrs</option>
                        <option value="3_yrs">3 Yrs</option>
                        <option value="4_yrs">4 Yrs</option>
                        <option value="5_yrs">5 Yrs</option>
                        <option value="6_yrs">6 Yrs</option>
                        <option value="more_than_6_yrs">More than 6 Yrs</option>
                    </select>
                </div>
                <div class="form-submit">
                    <input type="submit" name="submit" id="submit" class="submit" value="Submit" />
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="../public/vendor/jquery/jquery.min.js"></script>
    <script src="../public/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function(){
            var $appointmentForm = $('#appointment_form');
            if($appointmentForm.length){
                $appointmentForm.validate({
                    rules: {
                        lastname: {
                            required: true
                        },
                        email: {
                            required: true
                        },
                        education: {
                            required: true
                        },
                        education_level: {
                            required: true
                        },
                        industry: {
                            required: true
                        },
                        work_experience: {
                            required: true
                        }
                    },
                    messages: {
                        lastname: {
                            required: 'Last Name is Mandatory!'
                        },
                        email: {
                            required: 'Email is Mandatory!'
                        },
                        education: {
                            required: 'Education is Mandatory!'
                        },
                        education_level: {
                            required: 'Education Level is Mandatory!'
                        },
                        industry: {
                            required: 'Industry is Mandatory!'
                        },
                        work_experience: {
                            required: 'Work Experience is Mandatory!'
                        }
                    }
                })
            }
            $('#industry').change(function(){
                var selectedValue = $('#industry option:selected').text();
                if(selectedValue == 'N/A'){
                    $('#work_experience').hide();
                    $('#work_experience').removeAttr('required');
                }
            });
            $('#submit').click(function(e){
                var valid = this.form.checkValidity();
                if(valid){
                    var firstname = $('#firstname').val();
                    var lastname = $('#lastname').val();
                    var email = $('#email').val();
                    var phone_number = $('#phone_number').val();
                    var education = $('#education').val();
                    var education_level = $('#education_level').val();
                    var industry = $('#industry').val();
                    var work_experience = $('#work_experience').val();


                    e.preventDefault();
                    $.ajax({
                        type:'POST',
                        url:'../Controllers/process.php',
                        data:{firstname: firstname, lastname: lastname, email: email, phone_number: phone_number, 
                            education: education, education_level: education_level, industry: industry, 
                            work_experience: work_experience},
                        success: function(data){
                            Swal.fire({
                                'title':'Successful',
                                'text': data,
                                'type':'Success'
                            });
                            document.getElementById('appointment_form').reset();
                        },
                        error: function(data){
                            Swal.fire({
                                'title':'Errors',
                                'text':'Errors Founded',
                                'type':'error'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>