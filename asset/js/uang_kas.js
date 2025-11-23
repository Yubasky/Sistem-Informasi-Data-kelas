let dataKas = [];

// Tambah Data
document.getElementById("addBtn").addEventListener("click", () => {
  const nim = document.getElementById("nimInput").value;
  const nama = document.getElementById("namaInput").value;
  const jumlah = document.getElementById("jumlahInput").value;
  const ket = document.getElementById("ketInput").value;

  if (!nim || !nama || !jumlah || !ket) {
    alert("Semua data harus diisi!");
    return;
  }

  dataKas.push({
    nim,
    nama,
    jumlah: parseInt(jumlah),
    ket
  });

  renderTable();
  clearForm();
});

// Render Tabel
function renderTable() {
  const body = document.getElementById("kasBody");
  body.innerHTML = "";

  dataKas.forEach((item, index) => {
    const tr = document.createElement("tr");

    tr.innerHTML = `
      <td>${index + 1}</td>
      <td>${item.nim}</td>
      <td>${item.nama}</td>
      <td>Rp ${item.jumlah.toLocaleString()}</td>
      <td>${item.ket}</td>
      <td>
        <button class="btn-edit" onclick="editData(${index})">Edit</button>
        <button class="btn-delete" onclick="hapusData(${index})">Hapus</button>
      </td>
    `;
    body.appendChild(tr);
  });
}

// Kosongkan Form
function clearForm() {
  document.getElementById("nimInput").value = "";
  document.getElementById("namaInput").value = "";
  document.getElementById("jumlahInput").value = "";
  document.getElementById("ketInput").value = "";
}

// Edit Data
function editData(i) {
  const newJumlah = prompt("Masukkan jumlah baru (Rp):", dataKas[i].jumlah);
  const newKet = prompt("Keterangan baru (minggu/bulan):", dataKas[i].ket);

  if (!newJumlah || !newKet) return;

  dataKas[i].jumlah = parseInt(newJumlah);
  dataKas[i].ket = newKet;

  renderTable();
}

// Hapus Data
function hapusData(i) {
  if (confirm("Yakin ingin menghapus data ini?")) {
    dataKas.splice(i, 1);
    renderTable();
  }
}

// Export Laporan (simulasi)
document.getElementById("exportBtn").addEventListener("click", () => {
  alert("Laporan uang kas berhasil diekspor!");
});
