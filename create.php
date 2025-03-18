<?php
# Include connection
require_once "./config.php";

$fname_err = $lname_err = $email_err = $age_err = $gender_err = $designation_err = $date_err = "";
$fname = $lname = $email = $age = $gender = $designation = $date = "";

# Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    # First Name
    $fname = trim($_POST["fname"] ?? "");
    if (empty($fname)) {
        $fname_err = "This field is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $fname))) {
        $fname_err = "Invalid name format.";
    } else {
        $fname = ucfirst($fname);
    }

    # Last Name
    $lname = trim($_POST["lname"] ?? "");
    if (empty($lname)) {
        $lname_err = "This field is required.";
    } elseif (!ctype_alpha(str_replace(' ', '', $lname))) {
        $lname_err = "Invalid name format.";
    } else {
        $lname = ucfirst($lname);
    }

    # Email
    $email = trim($_POST["email"] ?? "");
    if (empty($email)) {
        $email_err = "This field is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    }

    # Age
    $age = trim($_POST["age"] ?? "");
    if (empty($age)) {
        $age_err = "This field is required.";
    } elseif (!ctype_digit($age)) {
        $age_err = "Please enter a valid age number.";
    }

    # Gender
    $gender = $_POST["gender"] ?? "";
    if (empty($gender)) {
        $gender_err = "This field is required.";
    }

    # Designation
    $designation = $_POST["designation"] ?? "";
    if (empty($designation)) {
        $designation_err = "This field is required.";
    }

    # Joining Date
    $date = $_POST["date"] ?? "";
    if (empty($date)) {
        $date_err = "This field is required.";
    }

    # Check input errors before inserting into database
    if (empty($fname_err) && empty($lname_err) && empty($email_err) && empty($age_err) && empty($gender_err) && empty($designation_err) && empty($date_err)) {
        # Prepare insert statement
        $sql = "INSERT INTO employees (first_name, last_name, email, age, gender, designation, joining_date) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssisss", $param_fname, $param_lname, $param_email, $param_age, $param_gender, $param_designation, $param_date);

            # Set parameters
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email = $email;
            $param_age = $age;
            $param_gender = $gender;
            $param_designation = $designation;
            $param_date = $date;

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('New employee added successfully.'); window.location.href='./';</script>";
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
  <title>Add Employee | Employee Management System</title>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Add New Employee</h1>
      <a href="./" class="btn btn-secondary">Back to Directory</a>
    </div>

    <div class="card animated">
      <!-- form starts here -->
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
        <div class="form-row">
          <div class="form-group">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" class="form-control" name="fname" id="fname" value="<?= $fname; ?>">
            <?php if (!empty($fname_err)) : ?>
              <span class="form-error"><?= $fname_err; ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lname" id="lname" value="<?= $lname; ?>">
            <?php if (!empty($lname_err)) : ?>
              <span class="form-error"><?= $lname_err; ?></span>
            <?php endif; ?>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group form-group-full">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $email; ?>">
            <?php if (!empty($email_err)) : ?>
              <span class="form-error"><?= $email_err; ?></span>
            <?php endif; ?>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="age" class="form-label">Age</label>
            <input type="text" class="form-control" name="age" id="age" value="<?= $age; ?>">
            <?php if (!empty($age_err)) : ?>
              <span class="form-error"><?= $age_err; ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-select" id="gender">
              <option selected disabled>Select Gender</option>
              <option value="Male" <?= (isset($gender) && $gender == "Male") ? "selected" : ""; ?>>Male</option>
              <option value="Female" <?= (isset($gender) && $gender == "Female") ? "selected" : ""; ?>>Female</option>
              <option value="Others" <?= (isset($gender) && $gender == "Others") ? "selected" : ""; ?>>Others</option>
            </select>
            <?php if (!empty($gender_err)) : ?>
              <span class="form-error"><?= $gender_err; ?></span>
            <?php endif; ?>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="designation" class="form-label">Designation</label>
            <select name="designation" class="form-select" id="designation">
              <option selected disabled>Select Designation</option>
              <option value="UI Designer" <?= (isset($designation) && $designation == "UI Designer") ? "selected" : ""; ?>>
                UI Designer
              </option>
              <option value="Frontend Developer" <?= (isset($designation) && $designation == "Frontend Developer") ? "selected" : ""; ?>>
                Frontend Developer
              </option>
              <option value="PHP Developer" <?= (isset($designation) && $designation == "PHP Developer") ? "selected" : ""; ?>>
                PHP Developer
              </option>
              <option value="Android Developer" <?= (isset($designation) && $designation == "Android Developer") ? "selected" : ""; ?>>
                Android Developer
              </option>
            </select>
            <?php if (!empty($designation_err)) : ?>
              <span class="form-error"><?= $designation_err; ?></span>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="date" class="form-label">Joining Date</label>
            <input type="date" class="form-control" name="date" id="date" value="<?= $date; ?>">
            <?php if (!empty($date_err)) : ?>
              <span class="form-error"><?= $date_err; ?></span>
            <?php endif; ?>
          </div>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
      <!-- form ends here -->
    </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>