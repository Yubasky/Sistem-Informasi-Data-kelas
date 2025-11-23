const editButtons = document.querySelectorAll(".btn-edit");
editButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const newStatus = prompt("Ubah status ke (hadir/sakit/izin/alpa):");
    if (!newStatus) return;
    const td = btn.parentElement.previousElementSibling;
    td.innerHTML = `<span class="status ${newStatus.toLowerCase()}">${
      newStatus.charAt(0).toUpperCase() + newStatus.slice(1)
    }</span>`;
  });
});

document.getElementById("exportBtn").addEventListener("click", () => {
  alert("Laporan absensi berhasil diekspor!");
});