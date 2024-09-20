<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script type="text/javascript" src="../handlers/userdata_empty_handler.js" defer></script>
</head>
<body>
<!-- Using a mixture of bootstrap 5.3.3 and a style.css (custom stylesheet)-->
    <div class="overlay">
        <div class="form-container">
            <form method="post" action="registration_handler.php" id="registration-form" class="w-100 max-w-500px">
                <h2 class="mb-4">Regisztráció</h2>    
                <div class="mb-3">
                    <label for="email" class="form-label">Email cím:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_email" class="form-label">Email cím megerősítése</label>
                    <input type="email" class="form-control" id="confirm_email" name="confirm_email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Felhasználónév:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Jelszó megerősítése:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </form>
        </div>
    </div>
</body>
</html>