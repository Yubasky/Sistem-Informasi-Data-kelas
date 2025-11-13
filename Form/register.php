<!DOCTYPE html>
<head>
  <title>Form | Register</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Register Form </h1>
   
    </header>

    <main>

      <section class="tips-list">
      <form action="login.php" method="POST" class="login-form">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Masukkan username" required>
        
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>

          <button type="submit">Login</button>
         <a class="kembali" href="login.php">Kembali ke halaman login</a>
      </section>
      <h1>Contoh</h1>
      <br>
    </main>

    <footer>
      <p>&copy; 2025 Yubasky</p>
    </footer>
  </div>
</body>
</html>