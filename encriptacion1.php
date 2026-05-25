<?php
$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensaje = trim($_POST['mensaje'] ?? '');
    $clave   = trim($_POST['clave'] ?? '');

    if ($mensaje === '' || $clave === '') {
        $error = "Ambos campos son obligatorios.";
    } else {
        // Normalizar clave a exactamente 16 caracteres
        $clave = str_pad(substr($clave, 0, 16), 16, '0');

        // Generar IV dinámico
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));

        // Cifrar
        $cifrado = openssl_encrypt($mensaje, 'AES-128-CBC', $clave, 0, $iv);

        // Descifrar
        $descifrado = openssl_decrypt($cifrado, 'AES-128-CBC', $clave, 0, $iv);

        $resultado = [
            'iv'        => bin2hex($iv),
            'cifrado'   => $cifrado,
            'descifrado'=> $descifrado,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cifrado AES-128-CBC</title>
    <style>
        body { font-family: monospace; background: #1e1e2e; color: #cdd6f4; padding: 40px; }
        h1 { color: #89b4fa; }
        label { display: block; margin-top: 16px; color: #a6e3a1; }
        textarea, input[type=text] { width: 100%; padding: 10px; background: #313244;
            border: 1px solid #45475a; color: #cdd6f4; border-radius: 6px; font-family: monospace; }
        textarea { height: 100px; }
        button { margin-top: 20px; padding: 10px 30px; background: #89b4fa;
            color: #1e1e2e; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background: #74c7ec; }
        .bloque { margin-top: 20px; background: #313244; padding: 16px;
            border-radius: 8px; border-left: 4px solid #89b4fa; word-break: break-all; }
        .bloque h3 { margin: 0 0 8px; color: #f38ba8; }
        .error { color: #f38ba8; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Cifrado Simétrico AES-128-CBC</h1>
    <form method="POST">
        <label>Mensaje en claro:</label>
        <textarea name="mensaje" required><?= htmlspecialchars($_POST['mensaje'] ?? '') ?></textarea>

        <label>Clave secreta (se normalizará a 16 caracteres):</label>
        <input type="text" name="clave" value="<?= htmlspecialchars($_POST['clave'] ?? '') ?>" required>

        <button type="submit">Cifrar y Descifrar</button>
    </form>

    <?php if ($error): ?>
        <p class="error">⚠ <?= $error ?></p>
    <?php endif; ?>

    <?php if ($resultado): ?>
        <div class="bloque">
            <h3>Vector de Inicialización (IV) — Hexadecimal</h3>
            <p><?= $resultado['iv'] ?></p>
        </div>
        <div class="bloque">
            <h3>Texto Cifrado — Base64</h3>
            <p><?= $resultado['cifrado'] ?></p>
        </div>
        <div class="bloque">
            <h3>Resultado del Descifrado</h3>
            <p><?= $resultado['descifrado'] ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
