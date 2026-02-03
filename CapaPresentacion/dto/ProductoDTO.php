<?php
class ProductoDTO {
    public int $id;
    public string $nombre;
    public float $precio;
    public int $stock;

    public function __construct($id,$nombre,$precio,$stock){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
    }
}
