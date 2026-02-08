<?php
require_once __DIR__.'/../../CapaNegocio/ProductoNegocio.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$negocio = new ProductoNegocio();
$data = json_decode(file_get_contents("php://input"), true);

try {

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {

        case 'GET':
            if (isset($_GET['id'])) {
                echo json_encode($negocio->obtenerPorId((int)$_GET['id']));
            } else {
                echo json_encode($negocio->listar());
            }
            break;

        case 'POST':
            $res = $negocio->crear(
                $data['nombre'] ?? '',
                $data['descripcion'] ?? '',
                $data['precio'] ?? 0,
                $data['stock'] ?? 0
            );
            echo json_encode(['success' => $res]);
            break;

        case 'PUT':
            $res = $negocio->actualizar(
                $data['id'] ?? 0,
                $data['nombre'] ?? '',
                $data['descripcion'] ?? '',
                $data['precio'] ?? 0,
                $data['stock'] ?? 0
            );
            echo json_encode(['success' => $res]);
            break;

        case 'DELETE':
            $res = $negocio->eliminar((int)($_GET['id'] ?? 0));
            echo json_encode(['success' => $res]);
            break;

        default:
            throw new Exception("Método no permitido");

    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
