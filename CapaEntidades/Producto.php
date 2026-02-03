<?php
class Producto {
    private ?int $id;
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $stock;

    public function __construct(
        ?int $id = null,
        string $nombre = '',
        string $descripcion = '',
        float $precio = 0,
        int $stock = 0
    ){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
    }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getDescripcion(){ return $this->descripcion; }
    public function getPrecio(){ return $this->precio; }
    public function getStock(){ return $this->stock; }
}
