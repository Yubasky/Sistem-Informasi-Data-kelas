document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("absensiForm");
    const successMsg = document.getElementById("successMsg");
  
    form.addEventListener("submit", (e) => {
      e.preventDefault();
  
      const status = form.status.value;
      const keterangan = form.keterangan.value.trim();
  
      // Simpan data ke localStorage (contoh simulasi)
      const dataAbsensi = {
        status,
        keterangan,
        tanggal: new Date().toLocaleDateString("id-ID")
      };
  
      localStorage.setItem("absensiUser", JSON.stringify(dataAbsensi));
  
      // Tampilkan pesan sukses
      successMsg.style.display = "block";
  
      // Reset form setelah submit
      form.reset();
  
      // Sembunyikan pesan setelah 3 detik
      setTimeout(() => {
        successMsg.style.display = "none";
      }, 3000);
    });
  });
  