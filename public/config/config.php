<?php
$host = 'dpg-d202m7bipnbc73ai6vt0-a.oregon-postgres.render.com';
$port = '5432';
$dbname = 'spartask';
$usuario = 'spartask_user';
$senha = 'WhXkz6P2fEkMpMJz5CSslqiCLYCnBQQZ';

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "✅ Conectado com sucesso ao PostgreSQL!";
} catch (PDOException $e) {
    die("❌ Erro na conexão: " . $e->getMessage());
}
?>
