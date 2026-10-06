<?php
// auth/loginuser.php
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="card card-primary card-outline shadow">

                <div class="card-header text-center">
                    <h4>
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login User
                    </h4>
                </div>

                <div class="card-body">

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <?= htmlspecialchars($_GET['error']) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="proses/proseslogin.php">

                        <div class="form-group">
                            <label>
                                <i class="fas fa-user mr-1"></i>
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-lock mr-1"></i>
                                Password
                            </label>

                            <div class="input-group">
                                <input
                                    type="password"
                                    name="password"
                                    id="passwordLogin"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required
                                >

                                <div class="input-group-append">
                                    <button
                                        type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()"
                                    >
                                        <i class="fas fa-eye" id="iconPassword"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <button
                            type="submit"
                            name="login"
                            class="btn btn-primary btn-block"
                        >
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            Login
                        </button>

                    </form>

                    <hr>

                    <div class="text-center">
                        <a href="index.php?halaman=home"
                           class="btn btn-secondary btn-sm">
                            <i class="fas fa-home mr-1"></i>
                            Kembali ke Home
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
function togglePassword() {

    const password = document.getElementById("passwordLogin");
    const icon = document.getElementById("iconPassword");

    if (password.type === "password") {

        password.type = "text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    } else {

        password.type = "password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");

    }
}
</script>