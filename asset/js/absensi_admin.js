function editAbsensi(id, currentStatus) {
  const newStatus = prompt(
    `Ubah status dari "${currentStatus}" ke:\n\n- Hadir\n- Sakit\n- Izin\n- Alpa`,
    currentStatus
  );

  if (!newStatus) return;

  const validStatus = ["Hadir", "Sakit", "Izin", "Alpa"];
  const capitalizedStatus =
    newStatus.charAt(0).toUpperCase() + newStatus.slice(1).toLowerCase();

  if (!validStatus.includes(capitalizedStatus)) {
    alert("Status tidak valid! Pilih: Hadir, Sakit, Izin, atau Alpa");
    return;
  }

  document.getElementById("update_id").value = id;
  document.getElementById("update_status").value = capitalizedStatus;
  document.getElementById("updateForm").submit();
}

function deleteAbsensi(id) {
  if (confirm("Yakin ingin menghapus data absensi ini?")) {
    document.getElementById("delete_id").value = id;
    document.getElementById("deleteForm").submit();
  }
}