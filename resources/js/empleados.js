document.addEventListener("DOMContentLoaded", function () {
    mostrarFlashMensajes();
    document.querySelectorAll(".form-eliminar").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // evitar envío inmediato
            alertaConfirmacion(form);
        });
    });

    // Al hacer click en "Generar QR"
    const btnGenerarQR = document.getElementById("btn-generar-qr");
    if (btnGenerarQR) {
        btnGenerarQR.addEventListener("click", function () {
            const empleadosSeleccionados = obtenerEmpleadosSeleccionados();
            if (empleadosSeleccionados.length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "¡Atención!",
                    text: "Por favor, selecciona al menos un empleado para generar el QR.",
                });
            }
            generarQR(empleadosSeleccionados);
        });
    }
});

/**
 * Alerta de confirmación para realizar una acción.
 *
 * @param form Formulario que se va a enviar si el usuario confirma la acción
 *
 * @author Henry Pérez
 * @version 1.0
 * @since 05-02-2026
 *
 */
function alertaConfirmacion(form) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

/**
 * Mostrar mensajes flash de éxito o error utilizando SweetAlert.
 *
 * @author Henry Pérez
 * @version 1.0
 * @since 05-02-2026
 *
 */
function mostrarFlashMensajes() {
    if (!window.flashMessages) return;

    if (window.flashMessages.success) {
        Swal.fire({
            icon: "success",
            title: "¡Éxito!",
            text: window.flashMessages.success,
            timer: 3000,
            showConfirmButton: false,
        });
    }

    if (window.flashMessages.error) {
        Swal.fire({
            icon: "error",
            title: "¡Error!",
            text: window.flashMessages.error,
            showConfirmButton: false,
        });
    }
}

/**
 * Alerta de confirmación para realizar una acción.
 *
 * @param idsEmpleados IDs de empleados seleccionados.
 *
 * @author Henry Pérez
 * @version 1.0
 * @since 05-02-2026
 *
 */
function generarQR(idsEmpleados) {
    console.log("seleccionados: ", idsEmpleados);

    fetch("/generar-qr", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
            Accept: "application/json",
        },
        body: JSON.stringify({
            ids: idsEmpleados,
        }),
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            if (data.success) {
                Swal.fire("¡Listo!", data.message, "success");
            } else {
                Swal.fire("¡Error!", data.message, "error");
            }

            // aquí luego puedes:
            // - abrir PDF
            // - descargar ZIP
            // - mostrar preview
        })
        .catch((error) => {
            console.error("Error al generar QR:", error);
            Swal.fire({
                icon: "error",
                title: "¡Error!",
                text: "Ocurrió un error al generar el QR. Por favor, intenta nuevamente.",
            });
        });
}

/**
 * Obtiene los IDs de los empleados seleccionados mediante checkboxes.
 *
 * @author Henry Pérez
 * @version 1.0
 * @since 05-02-2026
 *
 */
function obtenerEmpleadosSeleccionados() {
    const checkboxes = document.querySelectorAll(".checkbox-empleado:checked");
    return Array.from(checkboxes).map((cb) => cb.value);
}
