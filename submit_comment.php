<?php
// Memasukkan file koneksi
require_once 'config.php';

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';
    
    // Validasi data
    if (empty($post_id) || empty($name) || empty($email) || empty($comment)) {
        die("Error: Semua field harus diisi.");
    }
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Format email tidak valid.");
    }
    
    // Menyiapkan statement SQL dengan prepared statement untuk keamanan
    $stmt = $conn->prepare("INSERT INTO comments (post_id, name, email, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $post_id, $name, $email, $comment);
    
    // Menjalankan query
    if ($stmt->execute()) {
        // Redirect kembali ke halaman artikel dengan pesan sukses
        header("Location: article.php?id=$post_id&success=1");
        exit();
    } else {
        // Jika terjadi error
        echo "Error: " . $stmt->error;
    }
    
    // Menutup statement
    $stmt->close();
} else {
    // Jika bukan method POST, redirect ke halaman utama
    header("Location: index.php");
    exit();
}
?>
