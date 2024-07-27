const BtnGuardar = document.getElementById('BtnGuardar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const tablaAlumnos = document.getElementById('AlumnosIngresados');
const FormularioAlumnos = document.querySelector('form');


BtnModificar.parentElement.style.display = 'none'
BtnCancelar.parentElement.style.display = 'none'


const GuardarAlumnos = async (e) => {

    e.preventDefault();

    if (validarFormulario(FormularioAlumnos, ['alu_id'])) {

        BtnGuardar.disabled = true;

        const formData = new FormData(FormularioAlumnos)
        formData.append('tipo', 1);
        formData.delete('alu_id')

        const url = '/CRUD_JS2_VASQUEZ/controller/Alumnos/index.php'

        const config = {
            method: 'POST',
            body: formData

        }

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { mensaje, codigo, detalle } = data

            console.log(data);

            if (codigo == 1 && respuesta.status == 200) {

                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500, 
                    timerProgressBar: true, 
                    background: '#e0f7fa', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }

                });

                FormularioAlumnos.reset();
                ObtenerAlumnos();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnGuardar.disabled = false;

    }
}

const ObtenerAlumnos = async (e) => {

    if (e) e.preventDefault();

    const nombre = FormularioAlumnos.alu_nombre.value;
    const apellido = FormularioAlumnos.alu_apellido.value;
    const grado = FormularioAlumnos.alu_grado.value;
    const arma = FormularioAlumnos.alu_arma.value;
    const nacionalidad = FormularioAlumnos.alu_nacionalidad.value;

    const url = `/CRUD_JS2_VASQUEZ/controller/Alumnos/index.php?alu_nombre=${nombre}&alu_apellido=${apellido}&alu_grado=${grado}&alu_arma=${arma}&alu_nacionalidad=${nacionalidad}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data);

        tablaAlumnos.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status == 200) {
            if (data.length > 0) {
                data.forEach(alumno => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');
                    const celda5 = document.createElement('td');
                    const celda6 = document.createElement('td');
                    const celda7 = document.createElement('td');
                    const celda8 = document.createElement('td');

                    const BtnModificar = document.createElement('button');
                    const BtnEliminar = document.createElement('button');

                    BtnModificar.innerHTML = '<i class="bi bi-pencil"></i>';
                    BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
                    BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnModificar.addEventListener('click', () => llenarFormulario(alumno));
                    BtnEliminar.addEventListener('click', () => EliminarAlumno(alumno.alu_id));

                    celda1.innerText = contador;
                    celda2.innerText = alumno.alu_nombre;
                    celda3.innerText = alumno.alu_apellido;
                    celda4.innerText = alumno.grad_nombre;
                    celda5.innerText = alumno.arm_nombre;
                    celda6.innerText = alumno.alu_nacionalidad;
                    celda7.appendChild(BtnModificar);
                    celda8.appendChild(BtnEliminar);

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);
                    tr.appendChild(celda5);
                    tr.appendChild(celda6);
                    tr.appendChild(celda7);
                    tr.appendChild(celda8);

                    fragment.appendChild(tr);
                    contador++;
                });

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: `Se encontraron ${data.length} alumno(s)`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No hay Alumnos Registrados ';
                tr.classList.add('text-center');
                td.colSpan = 8;

                tr.appendChild(td);
                fragment.appendChild(tr);

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: 'No se encontraron alumnos',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        }

        tablaAlumnos.tBodies[0].appendChild(fragment);

    } catch (error) {
        console.log(error);
    }
}

const llenarFormulario = (alumno) => {
    Swal.fire({
        title: `¿Está seguro de que desea modificar los datos de: "${alumno.alu_nombre} ${alumno.alu_apellido}"?`,
        text: "Esta acción permitirá editar los datos del alumno.",
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sí, modificar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6', 
        denyButtonColor: '#d33', 
        background: '#fff3e0', 
        customClass: {
            title: 'custom-title-class',
            text: 'custom-text-class',
            confirmButton: 'custom-confirm-button',
            denyButton: 'custom-deny-button'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            FormularioAlumnos.alu_id.value = alumno.alu_id;
            FormularioAlumnos.alu_nombre.value = alumno.alu_nombre;
            FormularioAlumnos.alu_apellido.value = alumno.alu_apellido;
            FormularioAlumnos.alu_grado.value = alumno.alu_grado;
            FormularioAlumnos.alu_arma.value = alumno.alu_arma;
            FormularioAlumnos.alu_nacionalidad.value = alumno.alu_nacionalidad;

            BtnModificar.parentElement.style.display = '';
            BtnCancelar.parentElement.style.display = '';
            BtnGuardar.parentElement.style.display = 'none';
            BtnBuscar.parentElement.style.display = 'none';
            BtnLimpiar.parentElement.style.display = 'none';
        }
    });
};

const ModificarAlumnos = async (e) => {

    e.preventDefault();


    if (validarFormulario(FormularioAlumnos)) {

        BtnModificar.disabled = true;

        const formData = new FormData(FormularioAlumnos)
        formData.append('tipo', 2);

        const url = '/CRUD_JS2_VASQUEZ/controller/Alumnos/index.php'
        const config = {
            method: 'POST',
            body: formData

        }

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { mensaje, codigo, detalle } = data


            if (codigo == 2 && respuesta.status == 200) {

                BtnModificar.parentElement.style.display = 'none'
                BtnCancelar.parentElement.style.display = 'none'
                BtnGuardar.parentElement.style.display = ''
                BtnBuscar.parentElement.style.display = ''
                BtnLimpiar.parentElement.style.display = ''
                
                Swal.fire({
                    title: '¡Éxito!',
                    text: mensaje,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500, 
                    timerProgressBar: true, 
                    background: '#e0f7fa', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }

                });

                FormularioAlumnos.reset();
                ObtenerAlumnos();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnModificar.disabled = false;

    }
}

const Cancelar = () => {
    BtnModificar.parentElement.style.display = 'none'
    BtnCancelar.parentElement.style.display = 'none'
    BtnGuardar.parentElement.style.display = ''
    BtnBuscar.parentElement.style.display = ''
    BtnLimpiar.parentElement.style.display = ''
    FormularioAlumnos.reset();
    ObtenerAlumnos();
}

const EliminarAlumno = async (ID) => {
    Swal.fire({
        title: '¿Está seguro de que desea eliminar al alumno?',
        text: "Esta acción es irreversible.",
        icon: 'warning',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Sí, eliminar',
        denyButtonText: 'No, cancelar',
        confirmButtonColor: '#3085d6', 
        denyButtonColor: '#d33', 
        background: '#fff3e0', 
        customClass: {
            title: 'custom-title-class',
            text: 'custom-text-class',
            confirmButton: 'custom-confirm-button',
            denyButton: 'custom-deny-button'
        }
    }).then(async (result) => {
        if (result.isConfirmed) {
     
            const formData = new FormData();
            formData.append('tipo', 3);
            formData.append('alu_id', ID);

            const url = '/CRUD_JS2_VASQUEZ/controller/Alumnos/index.php';
            const config = {
                method: 'POST',
                body: formData
            };

            try {
                const respuesta = await fetch(url, config);
                const data = await respuesta.json();
                const { mensaje, codigo, detalle } = data;

                if (codigo == 3 && respuesta.status == 200) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: mensaje,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        background: '#e0f7fa', 
                        customClass: {
                            title: 'custom-title-class',
                            text: 'custom-text-class'
                        }
                    }).then(() => {
                        FormularioAlumnos.reset();
                        ObtenerAlumnos();
                    });

                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al eliminar el alumno.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#d33',
                        background: '#ffebee', 
                        customClass: {
                            title: 'custom-title-class',
                            text: 'custom-text-class'
                        }
                    });
                }

            } catch (error) {
                console.log(error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#d33',
                    background: '#ffebee', 
                    customClass: {
                        title: 'custom-title-class',
                        text: 'custom-text-class'
                    }
                });
            }
        }
    });
};


ObtenerAlumnos();
FormularioAlumnos.addEventListener('submit', GuardarAlumnos)
BtnModificar.addEventListener('click', ModificarAlumnos)
BtnBuscar.addEventListener('click', ObtenerAlumnos)
BtnCancelar.addEventListener('click', Cancelar)