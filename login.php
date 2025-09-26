<?php
session_start();

$usuarios = json_decode(file_get_contents("usuarios.json"), true);

$data = json_decode(file_get_contents("php://input"), true);
$usuario = $data["usuario"] ?? "";
$senha = $data["senha"] ?? "";

foreach ($usuarios as $u) {
    if ($u["usuario"] === $usuario && $u["senha"] === $senha) {
        $_SESSION["logado"] = $u;
        echo json_encode(["status" => "ok", "tipo" => $u["tipo"]]);
        exit;
    }
}

http_response_code(401);
echo json_encode(["status" => "erro", "msg" => "Usuário ou senha inválidos"]);
?>
