document.getElementById("absensiForm").addEventListener("submit", function(e) {
  e.preventDefault();

  const status = document.querySelector('input[name="status"]:checked').value;
  const keterangan = document.getElementById("keterangan").value;

  const formData = new FormData();
  formData.append("status", status);
  formData.append("keterangan", keterangan);

  fetch("proses_absensi.php", {
      method: "POST",
      body: formData
  })
  .then(res => res.json())
  .then(data => {
      if (data.status === "success") {
          document.getElementById("successMsg").style.display = "block";
      } else {
          alert("Gagal menyimpan absensi: " + data.message);
      }
  });
});
