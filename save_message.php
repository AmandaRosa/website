<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['Name']);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['Message']);

    // SQLite connection
    $dsn = "sqlite:messages.db";

    try {
        $pdo = new PDO($dsn);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert data into the messages table
        $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the statement
        $stmt->execute();
        echo "Message has been saved";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
