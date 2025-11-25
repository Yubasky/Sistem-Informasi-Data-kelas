function editAbsensi(id, currentStatus, currentKeterangan) {
  document.getElementById("update_id").value = id;
  document.getElementById("update_status").value = currentStatus;
  document.getElementById("update_keterangan").value = currentKeterangan;
  document.getElementById("editModal").style.display = "block";
}

function closeModal() {
  document.getElementById("editModal").style.display = "none";
}

function deleteAbsensi(id) {
  if (confirm("Yakin ingin menghapus data absensi ini?")) {
    document.getElementById("delete_id").value = id;
    document.getElementById("deleteForm").submit();
  }
}

// Tutup modal ketika klik di luar modal
document.getElementById("editModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeModal();
  }
});