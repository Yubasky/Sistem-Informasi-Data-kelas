<!DOCTYPE html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Login Form </h1>
      <nav>
        <strong>
        <a href="index.html">Home</a>
        </strong>
      </nav>      
    </header>

    <main>

      <section class="tips-list">
      <form action="login.php" method="POST" class="login-form">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Masukkan username" required>
        
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Masukkan password" required>

          <button type="submit">Login</button>
      </section>
    </main>

sa
    <footer>
      <p>&copy; 2025 Yubasky</p>
    </footer>
  </div>
</body>
</html>