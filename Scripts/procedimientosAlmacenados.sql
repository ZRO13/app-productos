DELIMITER $$

CREATE PROCEDURE sp_crear_producto(
    IN p_nombre VARCHAR(120),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10,2),
    IN p_stock INT
)
BEGIN
    INSERT INTO productos(nombre, descripcion, precio, stock)
    VALUES (p_nombre, p_descripcion, p_precio, p_stock);
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_listar_productos()
BEGIN
    SELECT id, nombre, descripcion, precio, stock, created_at
    FROM productos;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_producto_por_id(
    IN p_id INT
)
BEGIN
    SELECT id, nombre, descripcion, precio, stock, created_at
    FROM productos
    WHERE id = p_id;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_actualizar_producto(
    IN p_id INT,
    IN p_nombre VARCHAR(120),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10,2),
    IN p_stock INT
)
BEGIN
    UPDATE productos
    SET nombre = p_nombre,
        descripcion = p_descripcion,
        precio = p_precio,
        stock = p_stock
    WHERE id = p_id;
END$$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_eliminar_producto(
    IN p_id INT
)
BEGIN
    DELETE FROM productos WHERE id = p_id;
END$$

DELIMITER ;
