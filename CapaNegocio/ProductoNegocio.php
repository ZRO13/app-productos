<?php
require_once __DIR__.'/../CapaDatos/ProductoDAO.php';
require_once __DIR__.'/../CapaEntidades/Producto.php';
require_once __DIR__.'/../CapaPresentacion/dto/ProductoDTO.php';

class ProductoNegocio {

    private ProductoDAO $dao;

    public function __construct(){
        $this->dao = new ProductoDAO();
    }

    /**
     * Crear producto
     */
    public function crear($nombre, $descripcion, $precio, $stock): bool {

        if (empty($nombre) || strlen($nombre) < 3) {
            throw new Exception("El nombre es obligatorio y debe tener al menos 3 caracteres");
        }

        if (!is_numeric($precio) || $precio <= 0) {
            throw new Exception("El precio debe ser mayor que 0");
        }

        if (!is_numeric($stock) || $stock < 0) {
            throw new Exception("El stock no puede ser negativo");
        }

        $producto = new Producto(
            null,
            $nombre,
            $descripcion,
            (float)$precio,
            (int)$stock
        );

        return $this->dao->crear($producto);
    }

    /**
     * Listar productos (DTO)
     */
    public function listar(): array {
        $data = $this->dao->listar();
        $dtos = [];

        foreach ($data as $row) {
            $dtos[] = new ProductoDTO(
                $row['id'],
                $row['nombre'],
                $row['precio'],
                $row['stock'],
                $row['descripcion']
            );
        }
        if(count($dtos)==0){
        
        }

        return $dtos;
    }

    /**
     * Obtener producto por ID (DTO)
     */
    public function obtenerPorId(int $id): ProductoDTO {

        if ($id <= 0) {
            throw new Exception("ID inválido");
        }

        $row = $this->dao->obtenerPorId($id);

        if (!$row) {
            throw new Exception("Producto no encontrado");
        }

        return new ProductoDTO(
            $row['id'],
            $row['nombre'],
            $row['precio'],
            $row['stock'],
            $row['descripcion']
        );
    }

    /**
     * Actualizar producto
     */
    public function actualizar($id, $nombre, $descripcion, $precio, $stock): bool {

        if ($id <= 0) {
            throw new Exception("ID inválido");
        }

        if (empty($nombre) || strlen($nombre) < 3) {
            throw new Exception("El nombre es obligatorio y mínimo 3 caracteres");
        }

        if ($precio <= 0) {
            throw new Exception("El precio debe ser mayor que 0");
        }

        if ($stock < 0) {
            throw new Exception("El stock no puede ser negativo");
        }

        $producto = new Producto(
            $id,
            $nombre,
            $descripcion,
            (float)$precio,
            (int)$stock
        );

        return $this->dao->actualizar($producto);
    }

    /**
     * Eliminar producto
     */
    public function eliminar(int $id): bool {

        if ($id <= 0) {
            throw new Exception("ID inválido");
        }

        return $this->dao->eliminar($id);
    }
}
