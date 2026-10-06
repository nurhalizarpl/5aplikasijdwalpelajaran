
<div class="login-box">

  <div class="card card-outline card-primary">

    <div class="card-header text-center">
      <a href="../index.php" class="h1">
        <b>CV</b> Digital
      </a>
    </div>

    <div class="card-body">

      <p class="login-box-msg">
        Silakan masuk untuk memulai sesi
      </p>

      <!-- Form Login -->
      <form action="proses/proseslogin.php" method="post">
        

        <!-- Email -->
        <div class="input-group mb-3">

          <input
            type="email"
            name="email"
            class="form-control"
            placeholder="Email"
            required
          >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>

        </div>

        <!-- Password -->
        <div class="input-group mb-3">

          <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Password"
            required
          >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>

        </div>

        <!-- Tombol Login -->
        <div class="row">

          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>

          <div class="col-4">
            <button
              type="submit"
              class="btn btn-primary btn-block"
            >
              Sign In
            </button>
          </div>

        </div>

      </form>

      <!-- Registrasi Peserta -->
      <p class="mb-0 mt-3">
        <a href="registrasipeserta.php" class="text-center">
          Registrasi sebagai Peserta
        </a>
      </p>

    </div>

  </div>

</div>