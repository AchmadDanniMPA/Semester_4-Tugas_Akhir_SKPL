<?php
session_start();
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        header('Location: ../Admin/login.php?error=3');
        exit();
    }

    $query = $koneksi->prepare("SELECT * FROM m_user WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../Admin/index.php');
        } else {
            header('Location: ../Admin/login.php?error=1');
        }
    } else {
        header('Location: ../Admin/login.php?error=2');
    }
} else {
    header('Location: ../Admin/login.php');
}
?>
