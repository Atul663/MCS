<?php
include('config.php');

if (isset($_POST["Signup"])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    $result = "SELECT count(*) FROM citizen WHERE email=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "<script>alert('Registration number or email id already registered.');</script>";
    } else {
        $query = "INSERT INTO citizen (email, name, password) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('sss', $email, $name, $password);
        $stmt->execute();

        $role = "citizen"; 
        $query = "INSERT INTO userRole (email, role) VALUES (?, ?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('ss', $email, $role);
        $stmt->execute();
?>
        <script>
            alert('Student Successfully registered');
            window.location = '/MCS/login.php';
        </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html>

<body>
    <form method="POST">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="name" placeholder="Name">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="Signup" value="Sign up">
    </form>
</body>

</html>