<?php
class ProductoDTO {
    public int $id;
    public string $nombre;
    public float $precio;
    public int $stock;
    public string $descripcion;
    
    public function __construct($id,$nombre,$precio,$stock,$descripcion){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->descripcion = $descripcion;
    }
}
