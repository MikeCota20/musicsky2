<?php

include '../../config.php'; // Incluir el archivo de configuración

// Función para obtener todos los usuarios excepto el de ID 8
function getUsers($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id != 8"); // Excluir ID 8
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener un usuario por ID
function getUserById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para agregar un nuevo usuario
function addUser($pdo, $username, $email, $password) {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
}

// Función para actualizar un usuario
function updateUser($pdo, $id, $username, $email, $password) {
    $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
    $stmt->execute(['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT), 'id' => $id]);
}

// Función para eliminar un usuario
function deleteUser($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

// Manejo de solicitudes POST para agregar y actualizar usuarios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        addUser($pdo, $_POST['username'], $_POST['email'], $_POST['password']);
    } elseif (isset($_POST['update'])) {
        updateUser($pdo, $_POST['id'], $_POST['username'], $_POST['email'], $_POST['password']);
    }
}

// Manejo de solicitudes GET para eliminar usuarios
if (isset($_GET['delete'])) {
    deleteUser($pdo, $_GET['delete']);
}

// Obtener todos los usuarios
$users = getUsers($pdo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './navbar.php';?>
<div class="container">
    <h1 class="mt-5">Gestión de Usuarios</h1>

    <form method="POST" class="mb-5">
        <h2>Añadir/Actualizar Usuario</h2>
        <input type="hidden" name="id" id="userId">
        <div class="mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Añadir Usuario</button>
        <button type="submit" name="update" class="btn btn-success">Actualizar Usuario</button>
    </form>

    <h2>Lista de Usuarios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <button class="btn btn-warning" onclick="editUser(<?php echo $user['id']; ?>)">Editar</button>
                    <a href="?delete=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function editUser(id) {
    // Obtener todas las filas de la tabla
    const rows = document.querySelectorAll('tbody tr');
    
    // Recorrer las filas para encontrar la fila con el ID correspondiente
    for (let row of rows) {
        if (row.cells[0].textContent == id) { // Comparar el ID
            const username = row.cells[1].textContent;
            const email = row.cells[2].textContent;

            // Asignar los valores a los campos del formulario
            document.getElementById('userId').value = id;
            document.getElementById('username').value = username;
            document.getElementById('email').value = email;
            break; // Salir del bucle una vez encontrado
        }
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
