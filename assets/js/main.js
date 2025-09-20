// Abrir/fechar modal de adicionar
function openAddModal() {
  document.getElementById("addModal").style.display = "block";
}
function closeAddModal() {
  document.getElementById("addModal").style.display = "none";
}

// Abrir/fechar modal de editar
function openEditModal(id, name, quantity, price) {
  document.getElementById("edit-id").value = id;
  document.getElementById("edit-name").value = name;
  document.getElementById("edit-quantity").value = quantity;
  document.getElementById("edit-price").value = price;
  document.getElementById("editModal").style.display = "block";
}
function closeEditModal() {
  document.getElementById("editModal").style.display = "none";
}

// ===== Modal Delete =====
function openDeleteModal(id, name, quantity, price) {
  document.getElementById("delete-id").value = id;
  document.getElementById("delete-details").innerHTML = `
    <strong>Nome:</strong> ${name} <br>
    <strong>Quantidade:</strong> ${quantity} <br>
    <strong>Preço:</strong> R$ ${price}
  `;
  document.getElementById("deleteModal").style.display = "block";
}

function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}
