document.getElementById("submitBtn").addEventListener("click", function () {
  const nim = document.getElementById("nimInput").value.trim();
  const nama = document.getElementById("namaInput").value.trim();
  const jumlah = document.getElementById("jumlahInput").value.trim();
  const ket = document.getElementById("ketInput").value.trim();

  if (!nim || !nama || !jumlah) {
      alert("Harap isi data dengan lengkap.");
      return;
  }

  const formData = new FormData();
  formData.append("nim", nim);
  formData.append("nama", nama);
  formData.append("jumlah", jumlah);
  formData.append("keterangan", ket);

  fetch("../koneksi/proses_uangkas.php", {
      method: "POST",
      body: formData
  })
  .then(response => response.text())
  .then(result => {
      if (result === "success") {
          alert("Pembayaran berhasil ditambahkan!");
          location.reload();
      } else {
          alert("Gagal menambah pembayaran: " + result);
      }
  });
});
