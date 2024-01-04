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
    $name = clean($_POST['name']);
    $email = clean($_POST['email']);
    $gender = clean($_POST['gender'] ?? null);
    $skills = $_POST['skills'] ?? null;


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
            <div class="col-md-8 m-auto border rounded shadow p-4">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                    <div class="mb-3 form-floating">
                        <!--- Your name start here--->
                        <input type="text" name="name" value="<?= $name ?? null; ?>" id="" placeholder="Enter Your Name" class="form-control <?= isset($errName) ? 'is-invalid' : null; ?><?= isset($crrName) ? 'is-valid' : null; ?>">
                        <label for="" class="label">Enter Your Name</label>
                        <div class="invalid-feedback">
                            <?= $errName ?? null; ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrName ?? null; ?>
                        </div>
                    </div>
                    <!--- Your name end here--->
                    <!--email tag start here-->
                    <div class="mb-3 form-floating">
                        <input type="text" name="email" value="<?= $email ?? null; ?>" placeholder="Enter your email here" id="" class="form-control <?= isset($errEmail) ? 'is-invalid' : null; ?> <?= isset($crrEmail) ? 'is-valid' : null; ?>">
                        <label for="" class="label"> Enter Your Email Here</label>
                        <div class="invalid-feedback">
                            <?= $errEmail ?? null; ?>
                        </div>
                        <div class="valid-feedback">
                            <?= $crrEmail ?? null; ?>
                        </div>
                    </div>
                    <!--email tag end here-->
                    <!-- Radio button tag start from here -->
                    <div class="mb-3">
                        <div class="form-check">
                            <label for="" class="text-primary">Select Your Gender:</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label for="" class="form-check-label">Gender :</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Male" id="male" class="form-check-input " <?= isset($gender) && $gender == "Male" ? "checked" : null; ?>>
                            <label for="male" class="form-check-label">Male</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="gender" value="Female" id="female" class="form-check-input" <?= isset($gender) && $gender == "Female" ? "checked" : null; ?>>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check form-check-inline text-danger">
                            <?= $errGender ?? null; ?>
                        </div>
                    </div>
                    <!-- Radio button tag end from here -->
                    <!-- check box tag start form here -->
                    <div class="mb-3 ">
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
                            <input type="checkbox" class="form-check-input" <?= isset($crrSkills) && in_array("PHP", $crrSkills) ? "checked" : null; ?> name="skills[]" value="PHP" id="php">
                            <label for="php" class="form-check-label">PHP</label>
                        </div>
                        <!-- <?= isset($errSkills) ? 'text-danger ' : null; ?> This is under comments and also working with div class="" if not using below code -->
                        <div class="form-check form-check-inline text-danger ">
                            <?= $errSkills ?? null; ?>
                        </div>
                    </div>

                    <!-- Check box tag end form here -->
                    <!-- file uplaod tag start form here -->
                    <div class="form-check ">
                        <label for="" class="text-primary">Upload Your File :</label>
                    </div>
                    <div class="form-check form-check-inline mb-3 col-6 ">
                        <input type="file" name="file" id="formFile" class="form-control">

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
                                $errFile = "Please upoad a valid extension file name";
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

                    <div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-dark btn-md mt-2">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="./asset/js/bootstrap.bundle.min.js"></script>
</body>

</html>