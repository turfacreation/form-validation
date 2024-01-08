<?php

// function for not hacking
function clean($data)
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}

// function clean($data-11)
//{
// $kata = trim($data-11);
// $tata = htmlspecialchars($kata);
// $fata = stripslashes($tata);
// return $fata;
//}

//function end here

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = clean($_POST['name'] ?? null);
    $email = clean($_POST['email'] ?? null);
    $conemail = clean($_POST['conemail'] ?? null);
    $gender = clean($_POST['gender'] ?? null);
    $skills = $_POST['skills'] ?? null;
    $division = clean($_POST['division']) ?? null;
    $password = clean($_POST['password'] ?? null);
    $conpassword = clean($_POST['conpassword'] ?? null);
    $textarea = clean($_POST['textarea'] ?? null);





    // validation for Name Tag
    if (empty($name)) {
        $errName = "Name is requried ";
    } elseif (!preg_match("/^[A-Za-z. ]*$/", $name)) {
        $errName = "Only Letter and Spaces are allowed";
    } else {
        $crrName = $name;
    }


    // Validation for Email Tag
    if (empty($email)) {
        $errEmail = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) //  elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
    {
        $errEmail = "Invalid email format";
    } else {
        $crrEmail = $email;
    }

    // Validation for Confirm Email Tag
    if (empty($conemail)) {
        $errConEmail = "Confirm Email is required";
    } elseif ($email != $conemail) {
        $errConEmail = "Email Does not  Match";
    } else {
        $crrConEmail = "Wow !!! Email Match";
    }


    // validation for gender field

    if (empty($gender)) {
        $errGender = "Please select gender";
    }

    //validation for checkbox field
    if (empty($skills)) {
        $errSkills = "Please select your skills";
    } else {
        $crrSkills = $skills;
    }

    //validation for Division tag

    if (empty($division)) {
        $errDivision = "Please select your Division";
    } else {
        $crrDivision = $division;
    }

    //validation for password tag
    if (empty($password)) {
        $errPassword = "Password is required";
    } elseif (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{5,}$/", $password)) {
        $errPassword = "Password must be 5 Characters long & Contain at least </br> one UPPERCASE letter </br> one lowercase letter </br>one digit and </br>one Special Character";
    } else {
        $errPassword = $password;
    }

    // validation for confirm password field
    if (empty($conpassword)) {
        $errConPassword = "Confirm password is required";
    } elseif ($password != $conpassword) {
        $errConPassword = "Passwords do not match";
    } else {
        $crrConPassword = "Wow! Password Match";
    }


    // validation for textarea tag
    if (empty($textarea)) {
        $errTextarea = "Write something about Your self";
    } elseif (strlen($textarea) < 15) {
        $errTextarea = "Please filup atleast 15 character";
    } else {
        $crrTextarea = $textarea;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row min-vh-100 d-flex">
            <div class="mb-3 mt-3 fs-2  text-center text-primary ">PHP Form Validation</div>
            <div class="col-md-8 m-auto border rounded shadow p-4">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3 form-floating shadow-sm ">
                        <!--- Your name start here--->
                        <input type="text" name="name" value="<?= $name ?? null; ?>" id="" placeholder="Enter Your Name" class="form-control <?= isset($errName) ? 'is-invalid' : null; ?><?= isset($crrName) ? 'is-valid' : null; ?>">
                        <label for="" class="label">Your Name</label>
                        <div class="invalid-feedback">
                            <?= $errName ?? null; ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrName ?? null; ?>
                        </div>
                    </div>
                    <!--- Your name end here--->


                    <!--email tag start here-->
                    <div class="mb-3 form-floating shadow-sm ">
                        <input type="text" name="email" value="<?= $email ?? null; ?>" placeholder="Enter your email here" id="" class="form-control <?= isset($errEmail) ? 'is-invalid' : null; ?> <?= isset($crrEmail) ? 'is-valid' : null; ?>">
                        <label for="" class="label"> Your Email </label>
                        <div class="invalid-feedback">
                            <?= $errEmail ?? null; ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrEmail ?? null; ?>
                        </div>
                    </div>
                    <!--email tag end here-->
                    <!-- Confirm Email input tag -->
                    <div class="mb-3 form-floating shadow-sm ">
                        <input type="text" name="conemail" value="<?= $email ?? null; ?>" placeholder="Confirm Your Email" id="" class="form-control <?= isset($errConEmail) ? 'is-invalid' : null; ?> <?= isset($crrConEmail) ? 'is-valid' : null; ?>">
                        <label for="" class="label"> Confirm Your Email </label>
                        <div class="invalid-feedback">
                            <?= $errConEmail ?? null; ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrConEmail ?? null; ?>
                        </div>
                    </div>
                    <!--Confirm email tag end here-->
                    <!-- password tag start from here -->
                    <div class="form-floating mb-3 shadow-sm ">
                        <input type="password" name="password" id="" placeholder="Password" class="form-control <?= isset($errPassword) ? "is-invalid" : (isset($crrPassword) ? 'is-valid' : null) ?>">
                        <label for="">Password</label>
                        <div class="invalid-feedback">
                            <?= $errPassword ?>
                        </div>
                        <div class="valid-feedback">
                            <?= password_hash($crrPassword, PASSWORD_BCRYPT) ?>
                            <?= md5($crrPassword) ?>
                        </div>
                    </div>
                    <!-- confirm password -->
                    <div class="form-floating mb-3 shadow-sm ">
                        <input type="password" name="conpassword" id="" placeholder="Confirm Password" class="form-control <?= isset($errConPassword) ? "is-invalid" : (isset($crrConPassword) ? 'is-valid' : null) ?>">
                        <label for="">Confirm Password</label>
                        <div class="invalid-feedback">
                            <?= $errConPassword ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrConPassword ?>
                            <!-- <?= md5($crrConPassword) ?> -->
                        </div>
                    </div>
                    <!-- password tag end from here -->
                    <!-- Radio button tag start from here -->
                    <div class="mb-3 border rounded shadow-sm py-1">
                        <div class="form-check">
                            <label for="" class="text-primary">Your Gender:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-check-label">Please Select :</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Male" id="male" class="form-check-input " <?= isset($gender) && $gender == "Male" ? "checked" : null; ?>>
                            <label for="male" class="form-check-label">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Female" id="female" class="form-check-input" <?= isset($gender) && $gender == "Female" ? "checked" : null; ?>>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Custom" id="custom" class="form-check-input" <?= isset($gender) && $gender == "Custom" ? "checked" : null; ?>>
                            <label for="female" class="form-check-label">Custom</label>
                        </div>
                        <div class="form-check form-check-inline text-danger">
                            <?= $errGender ?? null; ?>
                        </div>
                    </div>
                    <!-- Radio button tag end from here -->
                    <!-- check box tag start form here -->
                    <div class="mb-3  border rounded shadow-sm py-1">
                        <div class="form-check">
                            <label for="" class="text-primary">Select Your Skills:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            Skills:
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" <?= isset($crrSkills) && in_array("HTML", $crrSkills)  ? "checked" : null; ?> name="skills[]" value="HTML" id="html">
                            <label for="html" class="form-check-label">HTML</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input " <?= isset($crrSkills) && in_array("CSS", $crrSkills) ? "checked" : null; ?> name="skills[]" value="CSS" id="css">
                            <label for="css" class="form-check-label">CSS</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" <?= isset($crrSkills) && in_array("JavaScript", $crrSkills) ? "checked" : null; ?> name="skills[]" value="JavaScript" id="Javascript">
                            <label for="Javascript" class="form-check-label">JavaScript</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" <?= isset($crrSkills) && in_array("React", $crrSkills) ? "checked" : null; ?> name="skills[]" value="React" id="React">
                            <label for="React" class="form-check-label">React</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" <?= isset($crrSkills) && in_array("PHP", $crrSkills) ? "checked" : null; ?> name="skills[]" value="PHP" id="php">
                            <label for="php" class="form-check-label">PHP</label>
                        </div>

                        <!--This is under comments and also working with div class="" if not using below code -->
                        <div class=" form-check  <?= isset($errSkills) ? 'text-danger' : (isset($skills) ? "text-success" : null); ?> ">
                            <?= $errSkills ?? null ?>
                            <?php
                            if (isset($skills)) {
                                foreach ($skills as $skill) {
                                    echo $skill . ",";
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Check box tag end form here -->


                    <!-- Select option start from here -->
                    <div class="form-floating shadow-sm ">
                        <select name="division" class="form-select" id="floatingSelect">
                            <option value="">--Select Division</option>
                            <option value="Dhaka" <?= isset($crrDivision) && $crrDivision == 'Dhaka' ? 'selected' : null; ?>>
                                Dhaka
                            </option>
                            <option value="Rajshahi" <?= isset($crrDivision) && $crrDivision == 'Rajshahi' ? 'selected' : null; ?>>Rajshahi
                            </option>
                            <option value="Khulna" <?= isset($crrDivision) && $crrDivision == 'Khulna' ? 'selected' : null; ?>>Khulna
                            </option>
                        </select>
                        <label for="floatingSelect">Select Division</label>
                    </div>
                    <div class="form-check form-check-inline <?= isset($errDivision) ? 'text-danger' : (isset($crrDivision) ? "text-success" : null); ?>">
                        <?= $errDivision ?? null; ?>
                        <?= $crrDivision ?? null; ?>
                    </div>
                    <!-- Select option end from here -->
                    <!-- file uplaod tag start form here -->

                    <div class="input-group  ">
                        <label class="input-group-text text-primary" for="inputGroupFile01">Upload</label>
                        <input type="file" name="file" class="form-control" id="inputGroupFile01">
                    </div>

                    <!-- This is for file upload validation code -->
                    <div class="form-check form-check-inline">
                        <?php
                        //This code for file upload
                        if (isset($_POST['submit'])) {
                            $fileName = $_FILES['file']['name'];
                            $fileTmpName = $_FILES['file']['tmp_name'];

                            // File Upload Validation
                            $allowed = ['jpg', 'png', 'gif'];
                            $fileExt = explode('.', $fileName);
                            $fileActualExt = strtolower(end($fileExt));

                            if (empty($fileName)) {
                                $errFile = "File Not Found";
                            } elseif (!in_array($fileActualExt, $allowed)) {
                                $errFile = "upoad a valid extension file name";
                            } else {
                                if (!is_dir('uploads')) {
                                    mkdir('uploads');
                                }
                                //create a new file name
                                $fielNewName = str_shuffle(date('HisAFdYDyl')) . uniqid('', true) . '.' . $fileActualExt;
                                //upload file to new location
                                $fileUpload = move_uploaded_file($fileTmpName, 'uploads/' . $fielNewName);

                                if ($fileUpload) {
                                    echo "<span style = 'color:green; font-size:20px;'>File Uploaded Successfully</span>";
                                } else {
                                    echo "File Upload Failed";
                                }
                            }
                        }
                        ?>
                    </div>
                    <!-- This is for error tag -->
                    <div class="form-check form-check-inline text-danger ">
                        <?= $errFile ?? null; ?>
                    </div>
                    <!-- file uplaod tag end form here -->
                    <!-- text area tag start here -->
                    <div class="form-control mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Write something about you</label>
                        <textarea name="textarea" class="form-control <?= isset($errTextarea) ? "is-invalid" : (isset($crrTextarea) ? 'is-valid' : null); ?>" id="exampleFormControlTextarea1" rows="3"></textarea>
                        <div class="invalid-feedback">
                            <?= $errTextarea ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrTextarea ?>
                        </div>
                    </div>
                    <!-- text area tag end  here -->
                    <div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-md mt-2">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="./asset/js/bootstrap.bundle.min.js"></script>
</body>

</html>