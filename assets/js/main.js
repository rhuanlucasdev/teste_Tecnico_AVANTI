// ==========================
// MODAL - ADICIONAR PRODUTO
// ==========================
function openAddModal() {
  document.getElementById("addModal").style.display = "block";
}
function closeAddModal() {
  document.getElementById("addModal").style.display = "none";
}

// ==========================
// MODAL - EDITAR PRODUTO
// ==========================
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

// ==========================
// MODAL - EXCLUIR PRODUTO
// ==========================
function openDeleteModal(id, name, quantity, price) {
  document.getElementById("delete-id").value = id;

  const details = `
    <p><strong>Nome:</strong> ${name}</p>
    <p><strong>Quantidade:</strong> ${quantity}</p>
    <p><strong>Preço:</strong> R$ ${parseFloat(price)
      .toFixed(2)
      .replace(".", ",")}</p>
  `;
  document.getElementById("delete-details").innerHTML = details;

  document.getElementById("deleteModal").style.display = "block";
}
function closeDeleteModal() {
  document.getElementById("deleteModal").style.display = "none";
}

// ==========================
// FECHAR MODAL AO CLICAR FORA
// ==========================
window.onclick = function (event) {
  const addModal = document.getElementById("addModal");
  const editModal = document.getElementById("editModal");
  const deleteModal = document.getElementById("deleteModal");

  if (event.target === addModal) closeAddModal();
  if (event.target === editModal) closeEditModal();
  if (event.target === deleteModal) closeDeleteModal();
};

// ==========================
// FILTRO DE PESQUISA
// ==========================
document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  if (searchInput) {
    searchInput.addEventListener("keyup", () => {
      const filter = searchInput.value.toLowerCase();
      const rows = document.querySelectorAll(".table tbody tr");

      rows.forEach((row) => {
        const nameCell = row.querySelector("td:first-child");
        if (nameCell) {
          const text = nameCell.textContent.toLowerCase();
          row.style.display = text.includes(filter) ? "" : "none";
        }
      });
    });
  }
});

// ==========================
// ALERTA AUTO-DESAPARECER
// ==========================
document.addEventListener("DOMContentLoaded", () => {
  const alert = document.querySelector(".alert");
  if (alert) {
    setTimeout(() => {
      alert.style.transition = "opacity 0.5s";
      alert.style.opacity = "0";
      setTimeout(() => alert.remove(), 500);
    }, 4000); // some em 4s
  }
});
