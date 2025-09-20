<?php
session_start();
require_once "../config/db.php";

// Se não estiver logado, redireciona para login
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Logout
if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit();
}

// Buscar produtos no banco
$sql = "SELECT id, name, quantity, price FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Dashboard - Sistema de Estoque</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <!-- Cabeçalho -->
  <header class="header">
    <h2>Sistema de Estoque</h2>
    <a href="?logout=1" class="btn btn-logout"><i class="fa-solid fa-right-from-bracket" style="margin-right: 5px;"></i>Logout</a>
  </header>

  <main class="container">

    <!-- Mensagens de feedback -->
    <?php if (isset($_GET['status']) && isset($_GET['msg'])): ?>
      <div class="alert <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-error'; ?>">
        <?php echo htmlspecialchars($_GET['msg']); ?>
      </div>
    <?php endif; ?>

    <div class="container-title">
      <h3>Lista de Produtos</h3>

      <!-- Barra de pesquisa -->
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Buscar por nome...">
        <i class="fa-solid fa-magnifying-glass"></i>
      </div>

      <button class="btn btn-primary" onclick="openAddModal()"><i class="fa-solid fa-plus" style="margin-right: 5px;"></i>Adicionar Produto</button>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Quantidade</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['name']); ?></td>
              <td><?php echo htmlspecialchars($row['quantity']); ?></td>
              <td><?php echo "R$ " . number_format($row['price'], 2, ',', '.'); ?></td>
              <td>
                <a href="#" class="btn btn-secondary" onclick="openEditModal('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['quantity']; ?>', '<?php echo $row['price']; ?>')"> <i class="fa-solid fa-pen-to-square" style="margin-right: 5px;"></i>Editar</a>
                <a href="#" class="btn btn-danger" onclick="openDeleteModal('<?php echo $row['id']; ?>', '<?php echo $row['name']; ?>', '<?php echo $row['quantity']; ?>', '<?php echo $row['price']; ?>')"> <i class="fa-solid fa-trash" style="margin-right: 5px;"></i>
                  Excluir
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center">Nenhum produto cadastrado</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <!-- Modal Adicionar -->
  <div id="addModal" class="modal">
    <div class="modal-content">
      <h3>Adicionar Produto</h3>
      <form action="add.php" method="post">
        <label>Nome:</label>
        <input type="text" name="name" required>

        <label>Quantidade:</label>
        <input type="number" name="quantity" required min="0">

        <label>Preço:</label>
        <input type="number" step="0.01" name="price" required min="0">

        <div class="modal-btn">
          <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk" style="margin-right: 5px;"></i>Salvar Produto</button>
        </div>

      </form>
    </div>
  </div>

  <!-- Modal Editar -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <h3>Editar Produto</h3>
      <form id="editForm" action="edit.php" method="post">
        <input type="hidden" name="id" id="edit-id">

        <label>Nome:</label>
        <input type="text" name="name" id="edit-name" required>

        <label>Quantidade:</label>
        <input type="number" name="quantity" id="edit-quantity" required min="0">

        <label>Preço:</label>
        <input type="number" step="0.01" name="price" id="edit-price" required min="0">

        <div class="modal-btn">
          <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check" style="margin-right: 5px;"></i>Atualizar Produto</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Excluir -->
  <div id="deleteModal" class="modal">
    <div class="modal-content">
      <h3>Excluir Produto</h3>
      <p class="warning-text">Tem certeza que quer excluir este item?
        <strong> Essa ação não pode ser desfeita.</strong>
      </p>

      <div id="delete-details" style="margin: 10px 0; padding: 10px; background: #f9f9f9; border-radius: 6px; font-size: 14px;">
        <!-- Aqui os dados do produto serão inseridos via JS -->
      </div>

      <div class="span-warning">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <span>Ação permanente</span>
      </div>

      <form class="delete-modal" id="deleteForm" action="delete.php" method="post">
        <input type="hidden" name="id" id="delete-id">
        <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash" style="margin-right: 5px;"></i>Excluir Produto</button>
      </form>
    </div>
  </div>

  <script src="../assets/js/main.js"></script>
</body>

</html>