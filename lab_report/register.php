<?php
// Start session to store errors or previous inputs if you want (optional)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animate.css CDN for animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            background-color: rgba(255,255,255,0.95);
            max-width: 400px;
            width: 100%;
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 8px #764ba2;
        }
        .btn-primary {
            background: #764ba2;
            border: none;
        }
        .btn-primary:hover {
            background: #5b367a;
        }
    </style>
</head>
<body>

<div class="card animate__animated animate__fadeInDown">

    <h2 class="text-center mb-4 text-primary">Register</h2>

    <!-- Display errors if any -->
    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="alert alert-danger animate__animated animate__shakeX">
            <ul class="mb-0">
                <?php
                foreach ($_SESSION['errors'] as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                unset($_SESSION['errors']);
                ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="process.php" method="POST" novalidate id="registerForm">
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required
                value="<?php echo isset($_SESSION['old']['full_name']) ? htmlspecialchars($_SESSION['old']['full_name']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" id="email" class="form-control" required
                value="<?php echo isset($_SESSION['old']['email']) ? htmlspecialchars($_SESSION['old']['email']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (min 6 chars)</label>
            <input type="password" name="password" id="password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-primary w-100 animate__animated animate__pulse animate__infinite">Register</button>
    </form>
</div>

<!-- Optional JavaScript for client-side validation -->
<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const fullName = document.getElementById('full_name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        let errors = [];

        if (!fullName) errors.push("Full Name is required.");
        if (!email) errors.push("Email is required.");
        else {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(!emailPattern.test(email)) errors.push("Invalid email format.");
        }
        if (!password) errors.push("Password is required.");
        else if(password.length < 6) errors.push("Password must be at least 6 characters.");

        if(errors.length > 0) {
            e.preventDefault();
            alert(errors.join("\n"));
        }
    });
</script>

</body>
</html>

<?php
unset($_SESSION['old']);
?>
