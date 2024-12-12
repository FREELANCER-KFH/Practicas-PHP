<?php
session_start();

class Producto {
    public $id;
    public $nombre;
    public $precio;

    public function __construct($id, $nombre, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
}

class Cliente {
    public $id;
    public $nombre;
    public $email;

    public function __construct($id, $nombre, $email) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
    }
}

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}
if (!isset($_SESSION['clientes'])) {
    $_SESSION['clientes'] = [];
}

function agregarProducto($id, $nombre, $precio) {
    $_SESSION['productos'][$id] = new Producto($id, $nombre, $precio);
}

function editarProducto($id, $nombre, $precio) {
    if (isset($_SESSION['productos'][$id])) {
        $_SESSION['productos'][$id]->nombre = $nombre;
        $_SESSION['productos'][$id]->precio = $precio;
    }
}

function eliminarProducto($id) {
    unset($_SESSION['productos'][$id]);
}

function obtenerProductos() {
    return $_SESSION['productos'];
}

function agregarCliente($id, $nombre, $email) {
    $_SESSION['clientes'][$id] = new Cliente($id, $nombre, $email);
}

function editarCliente($id, $nombre, $email) {
    if (isset($_SESSION['clientes'][$id])) {
        $_SESSION['clientes'][$id]->nombre = $nombre;
        $_SESSION['clientes'][$id]->email = $email;
    }
}

function eliminarCliente($id) {
    unset($_SESSION['clientes'][$id]);
}

function obtenerClientes() {
    return $_SESSION['clientes'];
}

function renderProductos() {
    $productos = obtenerProductos();
    echo "<h2>Productos</h2>";
    echo "<ul>";
    foreach ($productos as $producto) {
        echo "<li>{$producto->id} - {$producto->nombre} - {$producto->precio} <a href='?ver=productos&editar_producto={$producto->id}'>Editar</a> <a href='?ver=productos&eliminar_producto={$producto->id}'>Eliminar</a></li>";
    }
    echo "</ul>";
    echo "<form method='POST'>
            <input type='text' name='nombre' placeholder='Nombre del producto' required>
            <input type='number' step='0.01' name='precio' placeholder='Precio' required>
            <button type='submit' name='agregar_producto'>Agregar Producto</button>
          </form>";
    if (isset($_GET['editar_producto']) && isset($_SESSION['productos'][$_GET['editar_producto']])) {
        $producto = $_SESSION['productos'][$_GET['editar_producto']];
        echo "<form method='POST'>
                <input type='hidden' name='id' value='{$_GET['editar_producto']}'>
                <input type='text' name='nombre' value='{$producto->nombre}' required>
                <input type='number' step='0.01' name='precio' value='{$producto->precio}' required>
                <button type='submit' name='actualizar_producto'>Actualizar Producto</button>
              </form>";
    }
}

function renderClientes() {
    $clientes = obtenerClientes();
    echo "<h2>Clientes</h2>";
    echo "<ul>";
    foreach ($clientes as $cliente) {
        echo "<li>{$cliente->id} - {$cliente->nombre} - {$cliente->email} <a href='?ver=clientes&editar_cliente={$cliente->id}'>Editar</a> <a href='?ver=clientes&eliminar_cliente={$cliente->id}'>Eliminar</a></li>";
    }
    echo "</ul>";
    echo "<form method='POST'>
            <input type='text' name='nombre' placeholder='Nombre del cliente' required>
            <input type='email' name='email' placeholder='Correo electrónico' required>
            <button type='submit' name='agregar_cliente'>Agregar Cliente</button>
          </form>";
    if (isset($_GET['editar_cliente']) && isset($_SESSION['clientes'][$_GET['editar_cliente']])) {
        $cliente = $_SESSION['clientes'][$_GET['editar_cliente']];
        echo "<form method='POST'>
                <input type='hidden' name='id' value='{$_GET['editar_cliente']}'>
                <input type='text' name='nombre' value='{$cliente->nombre}' required>
                <input type='email' name='email' value='{$cliente->email}' required>
                <button type='submit' name='actualizar_cliente'>Actualizar Cliente</button>
              </form>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['agregar_producto'])) {
        agregarProducto(uniqid(), $_POST['nombre'], $_POST['precio']);
    }
    if (isset($_POST['agregar_cliente'])) {
        agregarCliente(uniqid(), $_POST['nombre'], $_POST['email']);
    }
    if (isset($_POST['actualizar_producto'])) {
        editarProducto($_POST['id'], $_POST['nombre'], $_POST['precio']);
    }
    if (isset($_POST['actualizar_cliente'])) {
        editarCliente($_POST['id'], $_POST['nombre'], $_POST['email']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['eliminar_producto'])) {
        eliminarProducto($_GET['eliminar_producto']);
    }
    if (isset($_GET['eliminar_cliente'])) {
        eliminarCliente($_GET['eliminar_cliente']);
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>POO con LocalStorage</title>
</head>
<body>
    <div class="main-container">
        <h1>POO con LocalStorage</h1>
        <h3><span class="label">Matrícula:</span> 40220759860</h3>
        <h3><span class="label">Participante:</span> Kevin Feliz Henríquez</h3>
        <h3><span class="label">Profesor:</span> Adrian Fondeur</h3>
        <h3><span class="label">Nombre del Diplomado:</span> Back-End con PHP</h3>
        <h3><span class="label">Nombre de la Academia:</span> Instituto Tecnológico de las Americas</h3>
        <h3><span class="label">Nombre de la Actividad:</span> POO con LocalStorage - Producto y Cliente</h3>

        <div class="practice-content">
            <nav>
                <a href="?ver=productos">Ver Productos</a> |
                <a href="?ver=clientes">Ver Clientes</a>
            </nav>
            <hr>
            <?php
            if (isset($_GET['ver'])) {
                if ($_GET['ver'] == 'productos') {
                    renderProductos();
                } elseif ($_GET['ver'] == 'clientes') {
                    renderClientes();
                }
            } else {
                echo "<p>Seleccione una opción del menú para continuar.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
