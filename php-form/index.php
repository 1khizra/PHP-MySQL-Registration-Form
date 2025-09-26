<html>
    <body>
        <?php

      echo '<p style="text-align: left; margin-top: 20px; margin-bottom: 20px;"style="text-align: left; margin-top: 20px;">Welcome to the stage where we are getting connect to the database</p>';
       
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="mydb";
        $conn= mysqli_connect($servername, $username ,$password);

        if (!$conn) {
            die("sorry we failed to connect:". mysqli_connect_error());
        }
        else{
                echo'<p style="text-align: left;"><br>Connection was successful</p>';
        }
        // .....create database.......

        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $conn->query($sql);

        //  ...Connect to the database....
        $conn = new mysqli($servername, $username, $password, $dbname);

        // ......Create table if not exists.....

       $table = "CREATE TABLE IF NOT EXISTS users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       gender VARCHAR(10) NOT NULL,
       phone VARCHAR(20) NOT NULL
       )";
$conn->query($table);
$message="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
$name=$_POST['name'];
$email=$_POST['email'];
$gender=$_POST['gender'];
$phone=$_POST['phone'];

 $stmt = $conn->prepare("INSERT INTO users (name, email, gender, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $gender, $phone); // s = string

    if ($stmt->execute()) {
        $message = "<p style='color:green;'>Data inserted successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
        <!--  HTML Form with CSS -->
<!DOCTYPE html>
<html>
<head>
    <title>Styled PHP Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:lightgrey;
            height: 100vh;
        }
        .container{
            display:flex;
            justify-content:center;
            height: 75vh;
            padding-bottom: 40px;

        }
        .form-container {
            
            background: #ffffffff;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            width: 350px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 8px 0 5px;
        }
        input[type="text"], input[type="email"], input[type="radio"] {
            margin: 5px 0 15px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid grey;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .gender-options {
            margin-bottom: 15px;
        }
        input[type="submit"] {
            width: 100%;
            background:green;
            border: none;
            color: white;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: green;
        }
        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="form-container">
        <h2>Registration Form</h2>
        <?php echo $message; ?>
        <form method="post" action="">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Gender:</label>
            <div class="gender-options">
                <input type="radio" name="gender" value="Male" required> Male
                <input type="radio" name="gender" value="Female" required> Female
            </div>

            <label>Phone:</label>
            <input type="text" name="phone" required>

            <input type="submit" value="Submit">
        </form>
    </div>
    </div>
</body>
</html>
    </body>
</html>