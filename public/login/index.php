<?php
session_start();

$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $api_data = array(
        'login' => $username,
        'password' => $password
    );

    $api_url = 'URL_DA_API/login';
    $headers = array('Content-Type: application/json');

    $curl = curl_init($api_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($api_data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $api_response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);


    if ($http_status == 200) {

        $api_response_data = json_decode($api_response, true);


        $_SESSION['loggedin'] = true;
        $_SESSION['token'] = $api_response_data['token'];
        $_SESSION['user_data'] = $api_response_data['data'];


        header("Location: form.php");
        exit;
    } elseif ($http_status == 401) {

        $api_response_data = json_decode($api_response, true);
        $error_msg = "Credenciais inválidas";
    } else {

        $error_msg = "Ocorreu um erro favor tentar mais tarde";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="." method="post">
            <h2>Login</h2>
            <?php if (!empty($error_msg)) { ?>
                <div class="error-message"><?php echo $error_msg; ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
    </div>
</body>
</html>
