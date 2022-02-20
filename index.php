<?php
        // define variables and set to empty values
        $name = $email = $gender = $comment = $website = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $website = test_input($_POST["website"]);
            $comment = test_input($_POST["comment"]);
            $gender = test_input($_POST["gender"]);
        }

        function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
        }
?>

<!DOCTYPE html>
<html>

<head>
    <title>PHP! First</title>
</head>

<body>
<?php
    echo "name ".$name;
    echo "<br>";
    echo "email ".$email;
    echo "<br>";
    echo "website ".$website;
    echo "<br>";
    echo "comment ".$comment;
    echo "<br>";
    echo "gender ".$gender;
    echo "<br>";

?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    
    <!-- <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"> -->
        Name: <input type="text" name="name">
        <span class="error">* </span>
        <br>
        E-mail: <input type="text" name="email">
        <span class="error">* </span>
        <br>
        Website: <input type="text" name="website">
        <br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        <br>
        Gender:
        <br>
        <input type="radio" name="gender" value="female">Female

        <input type="radio" name="gender" value="male">Male

        <input type="radio" name="gender" value="other">Other
        <span class="error">* </span>
        <br>
        <input type="submit">
    </form>

</body>

</html>