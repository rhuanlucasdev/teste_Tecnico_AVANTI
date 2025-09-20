<?php
session_start();
require_once "../config/db.php";

// Se já estiver logado, redireciona
if (isset($_SESSION['user_id'])) {
  header("Location: dashboard.php");
  exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $sql = "SELECT id, email, password FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $db_email, $db_pass);
    $stmt->fetch();

    if ($password === $db_pass) {
      $_SESSION['user_id'] = $id;
      $_SESSION['email'] = $db_email;
      header("Location: dashboard.php");
      exit();
    } else {
      $error = "Senha incorreta!";
    }
  } else {
    $error = "E-mail não encontrado!";
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Login - Sistema de Estoque</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <div class="login-container">
    <h2><i class="fa-solid fa-cube" style="margin-right: 5px;"></i>Inventory Management</h2>
    <form action="" method="post">
      <label for="email">E-mail:</label>
      <input type="email" name="email" placeholder="Insira seu email" required>

      <label for="password">Senha:</label>
      <input type="password" name="password" placeholder="Insira sua senha" required>

      <button type="submit" class="btn btn-primary login-btn"><i class="fa-solid fa-right-to-bracket" style="margin-right: 5px;"></i>Entrar</button>
    </form>
    <?php if ($error): ?>
      <p class="error-msg"><?php echo $error; ?></p>
    <?php endif; ?>
  </div>
</body>

</html>