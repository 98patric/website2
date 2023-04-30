<?php
// Set the Content-Disposition header to inline
header('Content-Disposition: inline');

// connect to the database
$dbhost = 'localhost';
$dbname = 'ratings';
$dbuser = 'pa.stephan@web.de';
$dbpass = 'H07f4ohl.';
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the connection was successful
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the rating and comment values from the form
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // insert the rating and comment into the database
    $sql = "INSERT INTO ratings (rating, comment) VALUES ('$rating', '$comment')";
    if ($conn->query($sql) === TRUE) {
        echo "Rating submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the form has been submitted
if (isset($_POST['rating']) && isset($_POST['comment'])) {
  // Insert the rating and comment data into the database
  $rating = $_POST['rating'];
  $comment = $_POST['comment'];
  $sql = "INSERT INTO ratings_table (rating, comment) VALUES ('$rating', '$comment')";
  mysqli_query($conn, $sql);
}

// Retrieve the rating and comment data from the database
$sql = "SELECT * FROM ratings_table";
$result = mysqli_query($conn, $sql);

// Display the rating form or rating data on the web page
if (!isset($_POST['rating']) || !isset($_POST['comment'])) {
  // Display the rating form
  ?>
  <form method="POST">
      <div class="rating">
          <input type="radio" id="star1" name="rating" value="1">
          <label for="star1" title="1 stars">☆</label>
          <input type="radio" id="star2" name="rating" value="2">
          <label for="star2" title="2 stars">☆</label>
          <input type="radio" id="star3" name="rating" value="3">
          <label for="star3" title="3 stars">☆</label>
          <input type="radio" id="star4" name="rating" value="4">
          <label for="star4" title="4 stars">☆</label>
          <input type="radio" id="star5" name="rating" value="5">
          <label for="star5" title="5 stars">☆</label>
      </div>
      <label for="comment">Comment:</label>
      <textarea id="comment" name="comment" rows="5"></textarea>
      <br>
      <button type="submit">Submit</button>
  </form>
  <?php
} else {
  // Display the rating data
  if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
          echo "Rating: " . $row["rating"] . "<br>";
          echo "Comment: " . $row["comment"] . "<br><br>";
      }
  } else {
      echo "No ratings found.";
  }
}

// Query the database for the data
$sql = "SELECT * FROM ratings";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display them
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Rating: " . $row["rating"] . "<br>";
        echo "Comment: " . $row["comment"] . "<br><br>";
    }
} else {
    echo "No ratings found.";
}


// close the database connection
$conn->close();
?>