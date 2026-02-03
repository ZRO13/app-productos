<?php
require_once __DIR__.'/Conexion.php';
require_once __DIR__.'/../CapaEntidades/Producto.php';

class ProductoDAO {
    private PDO $conexion;

    public function __construct(){
        $this->conexion = Conexion::getConexion();
    }

    public function crear(Producto $p): bool {
        $stmt = $this->conexion->prepare("CALL sp_crear_producto(?,?,?,?)");
        return $stmt->execute([
            $p->getNombre(),
            $p->getDescripcion(),
            $p->getPrecio(),
            $p->getStock()
        ]);
    }

    public function listar(): array {
        $stmt = $this->conexion->prepare("CALL sp_listar_productos()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false {
        $stmt = $this->conexion->prepare("CALL sp_producto_por_id(?)");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar(Producto $p): bool {
        $stmt = $this->conexion->prepare("CALL sp_actualizar_producto(?,?,?,?,?)");
        return $stmt->execute([
            $p->getId(),
            $p->getNombre(),
            $p->getDescripcion(),
            $p->getPrecio(),
            $p->getStock()
        ]);
    }

    public function eliminar(int $id): bool {
        $stmt = $this->conexion->prepare("CALL sp_eliminar_producto(?)");
        return $stmt->execute([$id]);
    }
}
