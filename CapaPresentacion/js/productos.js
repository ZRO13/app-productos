const API_URL = "http://localhost/app-productos/CapaPresentacion/api/productos.php";


function mostrarFormulario() {
    document.getElementById("formularioProducto").style.display = "block";
}

function ocultarFormulario() {
    document.getElementById("formularioProducto").style.display = "none";
    limpiarFormulario();
}

function limpiarFormulario() {
    document.getElementById("producto_id").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("descripcion").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("stock").value = "";
}

// LISTAR
async function listarProductos() {
    const res = await fetch(API_URL);
    const data = await res.json();

    const tbody = document.getElementById("tabla-productos");
    tbody.innerHTML = "";

    let iterador=0
    data.forEach(p => {
        tbody.innerHTML += `
            <tr>
                <td>${iterador+=1}</td>
                <td>${p.nombre}</td>
                <td>${p.precio}</td>
                <td>${p.stock}</td>
                <td>
                    <button onclick="editarProducto(${p.id})">Editar</button>
                    <button onclick="eliminarProducto(${p.id})">Eliminar</button>
                </td>
            </tr>
        `;
    });
}

//    CREAR / ACTUALIZAR
async function guardarProducto(e) {
    e.preventDefault();

    const id = document.getElementById("producto_id").value;

    const producto = {
        id: id,
        nombre: document.getElementById("nombre").value,
        descripcion: document.getElementById("descripcion").value,
        precio: parseFloat(document.getElementById("precio").value),
        stock: parseInt(document.getElementById("stock").value)
    };

    const method = id ? "PUT" : "POST";

    const res = await fetch(API_URL, {
        method: method,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(producto)
    });

    const r = await res.json();

    if (r.success) {
        alert(id ? "Producto actualizado" : "Producto creado");
        ocultarFormulario();
        listarProductos();
    } else {
        alert("Error al guardar");
    }
}

//    EDITAR
async function editarProducto(id) {
    const res = await fetch(`${API_URL}?id=${id}`);
    const p = await res.json();

    document.getElementById("producto_id").value = p.id;
    document.getElementById("nombre").value = p.nombre;
    document.getElementById("descripcion").value = p.descripcion;
    document.getElementById("precio").value = p.precio;
    document.getElementById("stock").value = p.stock;

    document.getElementById("titulo-form").innerText = "Editar Producto";
    document.getElementById("btn-guardar").innerText = "Actualizar";

    mostrarFormulario();
}

//    ELIMINAR
async function eliminarProducto(id) {
    if (!confirm("¿Seguro que deseas eliminar este producto?")) return;

    const res = await fetch(`${API_URL}?id=${id}`, { method: "DELETE" });
    const r = await res.json();

    if (r.success) {
        alert("Producto eliminado");
        listarProductos();
    } else {
        alert("Error al eliminar");
    }
}

//    INIT
window.onload = listarProductos;