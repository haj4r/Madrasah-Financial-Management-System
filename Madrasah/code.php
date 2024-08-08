<?php

session_start();
require 'dbConnection.php'; // Ensure this file correctly connects to your database



// Login handling
if (isset($_POST['submit_ajaxLogin'])) {
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);

    $query = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows) {
        $row = $result->fetch_assoc();

        $_SESSION['userlogged'] = 1;
        $_SESSION['login_id'] = $row['login_id']; // Store login_id in session
        $_SESSION['category'] = $row['category'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['status_id'] = $row['status_id'];

        $login_id = $row['login_id'];
        $category = $row['category'];
        $status = $row['status_id'];

        if ($status == 2) {
            $res = ['status' => 500, 'message' => 'Inactive'];
            echo json_encode($res);
        } else {
            // Fetch principal_id from principal table if the user is a Principal
            if ($category == 'Principal') {
                $pl_stmt = $mysqli->prepare("SELECT principal_id FROM principal WHERE login_id = ?");
                $pl_stmt->bind_param("i", $login_id);
                $pl_stmt->execute();
                $pl_result = $pl_stmt->get_result();
                if ($pl_result->num_rows > 0) {
                    $pl_row = $pl_result->fetch_assoc();
                    if (isset($pl_row['principal_id'])) {
                        $_SESSION['principal_id'] = $pl_row['principal_id'];
                    }
                }
                $pl_stmt->close();

            } 

            else if ($category == 'Clerk') {
                $pl_stmt = $mysqli->prepare("SELECT clerk_id FROM clerk WHERE login_id = ?");  // Fetch clerk_id from clerk table if the user is a Clerk
                $pl_stmt->bind_param("i", $login_id);
                $pl_stmt->execute();
                $pl_result = $pl_stmt->get_result();
                if ($pl_result->num_rows > 0) {
                    $pl_row = $pl_result->fetch_assoc();
                    if (isset($pl_row['clerk_id'])) {
                        $_SESSION['clerk_id'] = $pl_row['clerk_id'];
                    }
                }
                $pl_stmt->close();
            }

            else if ($category == 'Accountant') {
                $pl_stmt = $mysqli->prepare("SELECT acc_id FROM accountant WHERE login_id = ?");  // Fetch acc_id from acc table if the user is a Clerk
                $pl_stmt->bind_param("i", $login_id);
                $pl_stmt->execute();
                $pl_result = $pl_stmt->get_result();
                if ($pl_result->num_rows > 0) {
                    $pl_row = $pl_result->fetch_assoc();
                    if (isset($pl_row['acc_id'])) {
                        $_SESSION['acc_id'] = $pl_row['acc_id'];
                    }
                }
                $pl_stmt->close();
            }

            if ($category == 'Clerk') {
                $res = ['status' => 100, 'message' => 'Clerk'];
            } else if ($category == 'Principal') {
                $res = ['status' => 200, 'message' => 'Principal'];
            } else {
                $res = ['status' => 300, 'message' => 'Accountant'];
            }

            echo json_encode($res);
        }
    } else {
        $res = ['status' => 400, 'message' => 'Account does not exist.'];
        echo json_encode($res);
    }

    return;
}


// Add transaction handling
if (isset($_POST['submit_ajaxAddTransaction'])) {
    $sender_name = $_POST['sender_name'];
    $trans_medium = $_POST['trans_medium'];
    $type_id = $_POST['type_id'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];

    try {
        // Insert into transaction table
        $sql = "INSERT INTO transaction (sender_name, trans_medium, type_id, date, amount) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssiss', $sender_name, $trans_medium, $type_id, $date, $amount);
        if (!$stmt->execute()) {
            throw new Exception('Transaction insertion failed');
        }

        // Get last inserted ID
        $ledger_id = $mysqli->insert_id;

        // Insert into the appropriate table based on type_id
        switch ($type_id) {
            case 1:
                // Insert into zakat table
                $sql = "INSERT INTO zakat (ledger_id, sender_name, trans_medium, type_id, date, amount) VALUES (?, ?, ?, ?, ?, ?)";
                break;
            case 2:
                // Insert into donation table
                $sql = "INSERT INTO donation (ledger_id, sender_name, trans_medium, type_id, date, amount) VALUES (?, ?, ?, ?, ?, ?)";
                break;
            case 3:
                // Insert into fees table
                $sql = "INSERT INTO fees (ledger_id, sender_name, trans_medium, type_id, date, amount) VALUES (?, ?, ?, ?, ?, ?)";
                break;
            default:
                throw new Exception('Invalid type_id');
        }

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ississ', $ledger_id, $sender_name, $trans_medium, $type_id, $date, $amount);
        if (!$stmt->execute()) {
            throw new Exception('Insertion into related table failed');
        }

        // Commit transaction
        $mysqli->commit();
        $res = ['status' => 100, 'message' => 'Insertion Success!'];
    } catch (Exception $e) {
        // Rollback transaction
        $mysqli->rollback();
        $res = ['status' => 200, 'message' => 'Insertion Failed: ' . $e->getMessage()];
    }

    echo json_encode($res);

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
}



// Handle Add Clerk User
if (isset($_POST['submit_ajaxAddClerkUser'])) {
    // Collect and sanitize form data
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']); 
    $clerk_name = mysqli_real_escape_string($mysqli, $_POST['clerk_name']);
    $clerk_phonenum = mysqli_real_escape_string($mysqli, $_POST['clerk_phonenum']);
    $clerk_email = mysqli_real_escape_string($mysqli, $_POST['clerk_email']);

    $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);
    $principal_id = mysqli_real_escape_string($mysqli, $_SESSION['principal_id']);

    $category = 'Clerk';
    $status = 1;

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM login WHERE username = ?";
    $checkUserStmt = $mysqli->prepare($checkUserQuery);
    $checkUserStmt->bind_param('s', $username);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows > 0) {
        echo json_encode(['status' => 200, 'message' => 'User Already Exists']);
    } else {
        // Insert into login table
        $insertLoginQuery = "INSERT INTO login (username, password, category, status_id) VALUES (?, ?, ?, ?)";
        $insertLoginStmt = $mysqli->prepare($insertLoginQuery);
        $insertLoginStmt->bind_param('sssi', $username, $password, $category, $status);

        if ($insertLoginStmt->execute()) {
            $newLoginId = $insertLoginStmt->insert_id; // Get the ID of the newly inserted login record

            // Insert into clerk table
            $insertClerkQuery = "INSERT INTO clerk (clerk_name, clerk_phonenum, clerk_email, login_id, principal_id) VALUES (?, ?, ?, ?, ?)";
            $insertClerkStmt = $mysqli->prepare($insertClerkQuery);
            $insertClerkStmt->bind_param('sssii', $clerk_name, $clerk_phonenum, $clerk_email, $newLoginId, $principal_id);

            if ($insertClerkStmt->execute()) {
                echo json_encode(['status' => 100, 'message' => 'Clerk User Successfully Added']);
            } else {
                echo json_encode(['status' => 400, 'message' => 'Failed to add clerk user', 'error' => $insertClerkStmt->error]);
            }

            $insertClerkStmt->close();
        } else {
            echo json_encode(['status' => 401, 'message' => 'Failed to add login user', 'error' => $insertLoginStmt->error]);
        }

        $insertLoginStmt->close();
    }

    $checkUserStmt->close();
    $mysqli->close();

    return;
}


// Handle addition of a new user
if (isset($_POST['submit_ajaxAddUser'])) {
    // Collect and sanitize form data
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $acc_name = mysqli_real_escape_string($mysqli, $_POST['acc_name']);
    $acc_phonenum = mysqli_real_escape_string($mysqli, $_POST['acc_phonenum']);
    $acc_email = mysqli_real_escape_string($mysqli, $_POST['acc_email']);
    
    $login_id = mysqli_real_escape_string($mysqli, $_SESSION['login_id']);

    // Ensure clerk_id is set and valid
    if (!isset($_SESSION['clerk_id'])) {
        $res = ['status' => 300, 'message' => 'Clerk ID is not set.'];
        echo json_encode($res);
        return;
    }
    $clerk_id = mysqli_real_escape_string($mysqli, $_SESSION['clerk_id']);

    $category = 'Accountant';
    $status = 1;

    // Prepare and execute the SQL query to insert into `login` table
    $insertLoginQuery = "INSERT INTO `login` (username, `password`, category, status_id) VALUES (?, ?, ?, ?)";
    $insertLoginStmt = $mysqli->prepare($insertLoginQuery);

    if ($insertLoginStmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing login statement: ' . $mysqli->error];
    } else {
        // Bind parameters for login insert
        $insertLoginStmt->bind_param('sssi', $username, $password, $category, $status);

        // Execute the statement
        if ($insertLoginStmt->execute()) {
            // Get the ID of the newly inserted login record
            $newLoginId = $mysqli->insert_id;

            // Insert into accountant table
            $insertAccQuery = "INSERT INTO accountant (acc_name, acc_phonenum, acc_email, login_id, clerk_id) VALUES (?, ?, ?, ?, ?)";
            $insertAccStmt = $mysqli->prepare($insertAccQuery);

            if ($insertAccStmt === false) {
                $res = ['status' => 300, 'message' => 'Error in preparing accountant statement: ' . $mysqli->error];
            } else {
                // Bind parameters for accountant insert
                $insertAccStmt->bind_param('sssii', $acc_name, $acc_phonenum, $acc_email, $newLoginId, $clerk_id);

                // Execute the statement
                if ($insertAccStmt->execute()) {
                    $res = ['status' => 100, 'message' => 'Successfully added user'];
                } else {
                    $res = ['status' => 300, 'message' => 'Error in executing accountant insert: ' . $insertAccStmt->error];
                }

                // Close the accountant statement
                $insertAccStmt->close();
            }
        } else {
            $res = ['status' => 300, 'message' => 'Error in executing login insert: ' . $insertLoginStmt->error];
        }

        // Close the login statement
        $insertLoginStmt->close();
    }

    // Return the response
    echo json_encode($res);
    return;
}

// Edit transaction handling
if (isset($_POST['submit_ajaxEditTransaction'])) {
    $edit_id = mysqli_real_escape_string($mysqli, $_POST['edit_id']);
    $edit_sender_name = mysqli_real_escape_string($mysqli, $_POST['edit_sender_name']);
    $edit_trans_medium = mysqli_real_escape_string($mysqli, $_POST['edit_trans_medium']);
    $edit_type_id = mysqli_real_escape_string($mysqli, $_POST['edit_type_name']);
    $edit_date = mysqli_real_escape_string($mysqli, $_POST['edit_date']);
    $edit_amount = mysqli_real_escape_string($mysqli, $_POST['edit_amount']);

    $query = "UPDATE transaction SET sender_name = ?, trans_medium = ?, type_id = ?, date = ?, amount = ?  WHERE trans_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssisss", $edit_sender_name, $edit_trans_medium, $edit_type_id, $edit_date, $edit_amount, $edit_id);

    if ($stmt->execute()) {
        $res = ['status' => 100, 'message' => 'Update Success!'];
    } else {
        $res = ['status' => 200, 'message' => 'Update Failed!', 'error' => $stmt->error];

    }        
    echo json_encode($res);
    return;
}

// Handle updating clerk profile
if (isset($_POST['submit_ajaxUpdateProfile'])) {
    require 'dbConnection.php'; // Ensure this file correctly connects to your database

    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $phonenum = mysqli_real_escape_string($mysqli, $_POST['phonenum']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);

    // Check if data exists for the clerk
    $check_query = "SELECT * FROM `clerk` WHERE login_id = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("i", $login_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the existing record
        $query = "UPDATE `clerk` SET clerk_name = ?, clerk_phonenum = ?, clerk_email = ? WHERE login_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $name, $phonenum, $email, $login_id);
        $action = "Update";
    } else {
        // Insert new record
        $query = "INSERT INTO `clerk` (clerk_name, clerk_phonenum, clerk_email, login_id) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $name, $phonenum, $email, $login_id);
        $action = "Insert";
    }

    if ($stmt->execute()) {
        $res = ['status' => 100, 'message' => $action . ' Success!'];
    } else {
        $res = ['status' => 200, 'message' => $action . ' Failed!', 'error' => $stmt->error];
    }

    $stmt->close();
    $check_stmt->close();
    $mysqli->close();

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}

// Handle updating accountant profile
if (isset($_POST['submit_ajaxInsertProfile'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['acc_login_id']);
    $name = mysqli_real_escape_string($mysqli, $_POST['acc_name']);
    $phonenum = mysqli_real_escape_string($mysqli, $_POST['acc_phonenum']);
    $email = mysqli_real_escape_string($mysqli, $_POST['acc_email']);
    $address = mysqli_real_escape_string($mysqli, $_POST['acc_address']);

    // Check if the data exists in the accountant table
    $check_query = "SELECT * FROM `accountant` WHERE login_id = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("i", $login_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the existing record
        $query = "UPDATE `accountant` SET acc_name = ?, acc_phonenum = ?, acc_email = ?, acc_address = ? WHERE login_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssi", $name, $phonenum, $email, $address, $login_id);
        $action = "Update";
    } else {
        // Insert new record
        $query = "INSERT INTO `accountant` (acc_name, acc_phonenum, acc_email, acc_address, login_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssi", $name, $phonenum, $email, $address, $login_id);
        $action = "Insert";
    }

    if ($stmt->execute()) {
        $res = ['status' => 100, 'message' => $action . ' Success!'];
    } else {
        $res = ['status' => 200, 'message' => $action . ' Failed!', 'error' => $stmt->error];
    }

    $stmt->close();
    $check_stmt->close();

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}

// Handle updating principal profile
if (isset($_POST['submit_ajaxInsertPrincipal'])) {
    $principal_login_id = mysqli_real_escape_string($mysqli, $_POST['principal_login_id']);
    $principalName = mysqli_real_escape_string($mysqli, $_POST['principalName']);
    $principalPhonenum = mysqli_real_escape_string($mysqli, $_POST['principalPhonenum']);
    $principalEmail = mysqli_real_escape_string($mysqli, $_POST['principalEmail']);

    // Check if the data exists in the principal table
    $check_query = "SELECT * FROM `principal` WHERE login_id = ?";
    $check_stmt = $mysqli->prepare($check_query);
    $check_stmt->bind_param("i", $principal_login_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the existing record
        $query = "UPDATE `principal` SET principal_name = ?, principal_phonenum = ?, principal_email = ? WHERE login_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $principalName, $principalPhonenum, $principalEmail, $principal_login_id);
        $action = "Update";
    } else {
        // Insert new record
        $query = "INSERT INTO `principal` (principal_name, principal_phonenum, principal_email, login_id) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $principalName, $principalPhonenum, $principalEmail, $principal_login_id);
        $action = "Insert";
    }

    if ($stmt->execute()) {
        $res = ['status' => 100, 'message' => $action . ' Success!'];
    } else {
        $res = ['status' => 200, 'message' => $action . ' Failed!', 'error' => $stmt->error];
    }

    $stmt->close();
    $check_stmt->close();

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}

// Handle change clerk password
if (isset($_POST['submit_ajaxChangePassword'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);
    $newPassword = mysqli_real_escape_string($mysqli, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
    $currentPassword = isset($_POST['currentPassword']) ? mysqli_real_escape_string($mysqli, $_POST['currentPassword']) : null;

    // Check if current password is null
    if ($currentPassword === '') {
        $res = ['status' => 400, 'message' => 'Current password cannot be empty.'];
        echo json_encode($res);
        return;
    }

    // Ensure new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $res = ['status' => 400, 'message' => 'New password and confirm password do not match.'];
        echo json_encode($res);
        return;
    }

    // Validate current password
    $query = "SELECT * FROM `LOGIN` WHERE login_id = ? AND `password` = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => $mysqli->error];
    } else {
        $stmt->bind_param("is", $login_id, $currentPassword);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $res = ['status' => 500, 'message' => 'Current password is incorrect.'];
            echo json_encode($res);
            return;
        }
    }

    // Update password
    $query = "UPDATE `LOGIN` SET `password` = ? WHERE login_id = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing statement: ' . $mysqli->error];
    } else {
        $stmt->bind_param("si", $newPassword, $login_id);

        if ($stmt->execute()) {
            $res = ['status' => 200, 'message' => 'Password updated successfully.'];
        } else {
            $res = ['status' => 400, 'message' => $stmt->error];
        }

        $stmt->close();
    }

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}

// Handle change accountant password
if (isset($_POST['submit_ajaxAccountPassword'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['acc_login_id']);
    $newPassword = mysqli_real_escape_string($mysqli, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirm_password']);
    $currentPassword = isset($_POST['current_password']) ? mysqli_real_escape_string($mysqli, $_POST['current_password']) : null;

    // Check if current password is null
    if ($currentPassword === '') {
        $res = ['status' => 400, 'message' => 'Current password cannot be empty.'];
        echo json_encode($res);
        return;
    }

    // Ensure new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $res = ['status' => 400, 'message' => 'New password and confirm password do not match.'];
        echo json_encode($res);
        return;
    }

    // Validate current password
    $query = "SELECT * FROM `LOGIN` WHERE login_id = ? AND `password` = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing statement: ' . $mysqli->error];
    } else {
        $stmt->bind_param("is", $login_id, $currentPassword);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $res = ['status' => 500, 'message' => 'Current password is incorrect.'];
            echo json_encode($res);
            return;
        }
    }

    // Update password
    $query = "UPDATE `LOGIN` SET `password` = ? WHERE login_id = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing statement: ' . $mysqli->error];
    } else {
        $stmt->bind_param("si", $newPassword, $login_id);

        if ($stmt->execute()) {
            $res = ['status' => 200, 'message' => 'Password updated successfully.'];
        } else {
            $res = ['status' => 400, 'message' => 'Failed to update password.', 'error' => $stmt->error];
        }

        $stmt->close();
    }

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}

// Handle change principal password
if (isset($_POST['submit_ajaxPricipalPassword'])) {
    $login_id = mysqli_real_escape_string($mysqli, $_POST['principal_login_id']);
    $newPassword = mysqli_real_escape_string($mysqli, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($mysqli, $_POST['confirmPassword']);
    $currentPassword = isset($_POST['currentPassword']) ? mysqli_real_escape_string($mysqli, $_POST['currentPassword']) : null;

    // Check if current password is null
    if ($currentPassword === '') {
        $res = ['status' => 400, 'message' => 'Current password cannot be empty.'];
        echo json_encode($res);
        return;
    }

    // Ensure new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $res = ['status' => 400, 'message' => 'New password and confirm password do not match.'];
        echo json_encode($res);
        return;
    }

    // Validate current password
    $query = "SELECT * FROM `LOGIN` WHERE login_id = ? AND `password` = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing statement: ' . $mysqli->error];
    } else {
        $stmt->bind_param("is", $login_id, $currentPassword);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $res = ['status' => 500, 'message' => 'Current password is incorrect.'];
            echo json_encode($res);
            return;
        }
    }

    // Update password
    $query = "UPDATE `LOGIN` SET `password` = ? WHERE login_id = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt === false) {
        $res = ['status' => 300, 'message' => 'Error in preparing statement: ' . $mysqli->error];
    } else {
        $stmt->bind_param("si", $newPassword, $login_id);

        if ($stmt->execute()) {
            $res = ['status' => 200, 'message' => 'Password updated successfully.'];
        } else {
            $res = ['status' => 400, 'message' => $stmt->error];
        }

        $stmt->close();
    }

    echo json_encode($res); // Output JSON response for AJAX handling
    return;
}




// Handle fetching data based on login_id -clerk
if (isset($_POST['login_id'])) {
    require 'dbConnection.php'; // Ensure this file correctly connects to your database

    // Sanitize the input
    $login_id = mysqli_real_escape_string($mysqli, $_POST['login_id']);

    // Prepare the SQL query
    $query = "SELECT * FROM clerk WHERE login_id = ?";
    $stmt = $mysqli->prepare($query);

    if ($stmt) {
        // Bind the parameters and execute the statement
        $stmt->bind_param("i", $login_id);
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result) {
            // Fetch data as associative array
            $data = $result->fetch_assoc();

            if ($data) {
                $response = [
                    'status' => 100,
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 200,
                    'message' => 'No data found for login_id: ' . $login_id,
                ];
            }
        } else {
            $response = [
                'status' => 400,
                'message' => 'Query execution failed: ' . $stmt->error,
            ];
        }

        // Close statement
        $stmt->close();
    } else {
        $response = [
            'status' => 400,
            'message' => 'Error in preparing statement: ' . $mysqli->error,
        ];
    }

    return;
}

// Handle fetching data based on login_id - accountant
if (isset($_POST['acc_login_id'])) {
    $acc_login_id = mysqli_real_escape_string($mysqli, $_POST['acc_login_id']);

    $query = "SELECT * FROM accountant WHERE login_id = '$acc_login_id'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $response = [
                'status' => 100,
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 200,
                'message' => 'No data found for acc_login_id: ' . $acc_login_id,
            ];
        }
    } else {
        $response = [
            'status' => 400,
            'message' => 'Query failed: ' . mysqli_error($mysqli),
        ];
    }

    echo json_encode($response);
    return;
}

// Handle fetching data based on login_id - principal
if (isset($_POST['principal_login_id'])) {
    $principal_login_id = mysqli_real_escape_string($mysqli, $_POST['principal_login_id']);

    $query = "SELECT * FROM principal WHERE login_id = '$principal_login_id'";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);

        if ($data) {
            $response = [
                'status' => 100,
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 200,
                'message' => 'No data found for principal_login_id: ' . $principal_login_id,
            ];
        }
    } else {
        $response = [
            'status' => 400,
            'message' => 'Query failed: ' . mysqli_error($mysqli),
        ];
    }

    echo json_encode($response);
    return;
}







?>