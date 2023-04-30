<?php
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    //database connection
    $conn = new mysqli('localhost', 'root', 'H07f4ohl.', 'ratings');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else {
        $stmt = $conn->prepare("insert into registration(rating, comment)
        values(?, ?)");
        $stmt->$mysqli_stmt::blind_param("is", $rating, $comment);
        $stmt->execute();
        echo "feedback successfully submitted";
        $stmt->close();
        $conn->close();
    }
?>