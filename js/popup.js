// Función para mostrar el popup
function mostrarPopup() {
    Swal.fire({
        imageUrl: "./img/LOGORICK.png",
        imageHeight: 100,
        title: "¿Quieres cerrar la sesión?",
        showConfirmButton: true,
        showCancelButton: true,
        cancelButtonText: "Mantener Sesión",
        confirmButtonText: "Cerrar Sesión",
        cancelButtonColor: "#3085d6",
        confirmButtonColor: "#d33",
        allowOutsideClick: false // Evita que se cierre haciendo clic fuera del modal
    }).then((result) => {
        if (result.isConfirmed) {
            // Acción para cerrar sesión
            cerrarSesion();
        }
    });
}

// Función para cerrar sesión
function cerrarSesion() {
    // Aquí debes realizar las acciones necesarias para cerrar la sesión
    // Por ejemplo, redirigir al usuario a la página de cierre de sesión
    window.location.href = "./inc/salir.php";
}

// Muestra el popup cada 10 minutos (600,000 milisegundos = 10 minutos)
setInterval(mostrarPopup, 600000);