<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="./style.css">
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
  <title>Employee Management System</title>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>Employee Directory</h1>
      <a href="./create.php" class="btn btn-primary btn-add">Add Employee</a>
    </div>

    <!-- Table starts here -->
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Role</th>
            <th>Joining Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          # Include connection
          require_once "./config.php";

          # Attempt select query execution
          $sql = "SELECT * FROM employees";

          if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
              $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
              $count = 1;
              foreach ($rows as $row) { ?>
                <tr>
                  <td><?= $count++; ?></td>
                  <td><?= $row["first_name"]; ?></td>
                  <td><?= $row["last_name"]; ?></td>
                  <td><?= $row["email"]; ?></td>
                  <td><?= $row["age"]; ?></td>
                  <td><?= $row["gender"]; ?></td>
                  <td><?= $row["designation"]; ?></td>
                  <td><?= $row["joining_date"]; ?></td>
                  <td class="actions">
                    <a href="./update.php?id=<?= $row["id"]; ?>" class="btn btn-primary btn-sm btn-edit"></a>
                    <a href="./delete.php?id=<?= $row["id"]; ?>" class="btn btn-danger btn-sm btn-delete"></a>
                  </td>
                </tr>
              <?php
              }
              # Free result set
              mysqli_free_result($result);
            } else { ?>
              <tr>
                <td class="text-center text-danger" colspan="9">No employees found in the database</td>
              </tr>
          <?php
            }
          }
          # Close connection
          mysqli_close($link);
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>