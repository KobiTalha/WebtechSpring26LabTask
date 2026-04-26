<?php
$errors = [];
$successMessage = "";

$fullName = "";
$email = "";
$username = "";
$age = "";
$gender = "";
$course = "";
$terms = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["register"])) {
    $fullName = trim($_POST["full_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirmPassword = trim($_POST["confirm_password"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $terms = isset($_POST["terms"]) ? "accepted" : "";

    if ($fullName === "") {
        $errors["full_name"] = "Full Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $fullName)) {
        $errors["full_name"] = "Full Name can contain only letters and spaces.";
    }

    if ($email === "") {
        $errors["email"] = "Email Address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Enter a valid email address.";
    }

    if ($username === "") {
        $errors["username"] = "Username is required.";
    } elseif (strlen($username) < 5) {
        $errors["username"] = "Username must be at least 5 characters long.";
    }

    if ($password === "") {
        $errors["password"] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors["password"] = "Password must be at least 6 characters long.";
    }

    if ($confirmPassword === "") {
        $errors["confirm_password"] = "Confirm Password is required.";
    } elseif ($password !== $confirmPassword) {
        $errors["confirm_password"] = "Password and Confirm Password must match.";
    }

    if ($age === "") {
        $errors["age"] = "Age is required.";
    } elseif (!is_numeric($age) || (int)$age < 18) {
        $errors["age"] = "Age must be 18 or above.";
    }

    if ($gender === "") {
        $errors["gender"] = "Please select a gender.";
    }

    if ($course === "") {
        $errors["course"] = "Please select a course.";
    }

    if ($terms === "") {
        $errors["terms"] = "You must accept the Terms and Conditions.";
    }

    if (empty($errors)) {
        $successMessage = "Registration Successful!";
    }
}

function showValue($value)
{
    return htmlspecialchars($value);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border: 1px solid #cccccc;
        }

        h1, h2 {
            text-align: center;
            color: #000000;
        }

        .field {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #999999;
            box-sizing: border-box;
        }

        .radio-group,
        .checkbox-group {
            margin-top: 5px;
        }

        .radio-group label,
        .checkbox-group label {
            display: inline;
            margin-right: 10px;
            font-weight: normal;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: green;
            padding: 10px;
            border: 1px solid #cccccc;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .error-box {
            background-color: #f8d7da;
            color: red;
            padding: 10px;
            border: 1px solid #cccccc;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #999999;
            background-color: #e6e6e6;
            color: black;
            font-size: 16px;
            cursor: pointer;
        }

        .output {
            margin-top: 20px;
            background-color: #fafafa;
            border: 1px solid #cccccc;
            padding: 15px;
        }

        .output p {
            margin: 6px 0;
        }

        @media (max-width: 700px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration Form</h1>

        <?php if (!empty($successMessage)) { ?>
            <div class="success"><?php echo $successMessage; ?></div>
        <?php } ?>

        <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($errors)) { ?>
            <div class="error-box">
                Please fix the following errors and submit again.
            </div>
        <?php } ?>

        <form method="post" action="">
            <div class="field">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" value="<?php echo showValue($fullName); ?>">
                <?php if (isset($errors["full_name"])) { ?>
                    <div class="error"><?php echo $errors["full_name"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="<?php echo showValue($email); ?>">
                <?php if (isset($errors["email"])) { ?>
                    <div class="error"><?php echo $errors["email"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo showValue($username); ?>">
                <?php if (isset($errors["username"])) { ?>
                    <div class="error"><?php echo $errors["username"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <?php if (isset($errors["password"])) { ?>
                    <div class="error"><?php echo $errors["password"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <?php if (isset($errors["confirm_password"])) { ?>
                    <div class="error"><?php echo $errors["confirm_password"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="<?php echo showValue($age); ?>">
                <?php if (isset($errors["age"])) { ?>
                    <div class="error"><?php echo $errors["age"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label>Gender</label>
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="Male" <?php if ($gender === "Male") { echo "checked"; } ?>>
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" value="Female" <?php if ($gender === "Female") { echo "checked"; } ?>>
                    <label for="female">Female</label>
                </div>
                <?php if (isset($errors["gender"])) { ?>
                    <div class="error"><?php echo $errors["gender"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <label for="course">Course Selection</label>
                <select id="course" name="course">
                    <option value="">Select a course</option>
                    <option value="Web Technology" <?php if ($course === "Web Technology") { echo "selected"; } ?>>Web Technology</option>
                    <option value="Object Oriented Programming" <?php if ($course === "Object Oriented Programming") { echo "selected"; } ?>>Object Oriented Programming</option>
                    <option value="Database" <?php if ($course === "Database") { echo "selected"; } ?>>Database</option>
                    <option value="Computer Networks" <?php if ($course === "Computer Networks") { echo "selected"; } ?>>Computer Networks</option>
                </select>
                <?php if (isset($errors["course"])) { ?>
                    <div class="error"><?php echo $errors["course"]; ?></div>
                <?php } ?>
            </div>

            <div class="field">
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" value="1" <?php if ($terms === "accepted") { echo "checked"; } ?>>
                    <label for="terms">I accept the Terms and Conditions</label>
                </div>
                <?php if (isset($errors["terms"])) { ?>
                    <div class="error"><?php echo $errors["terms"]; ?></div>
                <?php } ?>
            </div>

            <button type="submit" name="register">Register</button>
        </form>

        <?php if (!empty($successMessage)) { ?>
            <div class="output">
                <h2>Submitted Details</h2>
                <p><strong>Full Name:</strong> <?php echo showValue($fullName); ?></p>
                <p><strong>Email Address:</strong> <?php echo showValue($email); ?></p>
                <p><strong>Username:</strong> <?php echo showValue($username); ?></p>
                <p><strong>Age:</strong> <?php echo showValue($age); ?></p>
                <p><strong>Gender:</strong> <?php echo showValue($gender); ?></p>
                <p><strong>Course Selection:</strong> <?php echo showValue($course); ?></p>
                <p><strong>Terms:</strong> Accepted</p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
