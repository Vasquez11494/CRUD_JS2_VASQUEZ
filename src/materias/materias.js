const BtnGuardar = document.getElementById('BtnGuardar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const MateriasIngresadas = document.getElementById('MateriasIngresadas');
const FormularioMaterias = document.querySelector('form');


BtnModificar.parentElement.style.display = 'none'
BtnCancelar.parentElement.style.display = 'none'

const GuardarMaterias = async (e) => {

    e.preventDefault();

    if (validarFormulario(FormularioMaterias, ['materia_id'])) {

        BtnGuardar.disabled = true;

        const formData = new FormData(FormularioMaterias)
        formData.append('tipo', 1);
        formData.delete('materia_id')

        const url = '/CRUD_JS2_VASQUEZ/controller/Materias/index.php'

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

                FormularioMaterias.reset();
                ObtenerMaterias();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnGuardar.disabled = false;

    }
}

const ObtenerMaterias = async (e) => {

    if (e) e.preventDefault();

    const nombre = FormularioMaterias.materia_nombre.value;


    const url = `/CRUD_JS2_VASQUEZ/controller/Materias/index.php?materia_nombre=${nombre}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data);

        MateriasIngresadas.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status == 200) {
            if (data.length > 0) {
                data.forEach(materias => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');
                    const celda4 = document.createElement('td');

                    const BtnModificar = document.createElement('button');
                    const BtnEliminar = document.createElement('button');
                    
                    BtnModificar.innerHTML = '<i class="bi bi-pencil"></i>';
                    BtnModificar.classList.add('btn', 'btn-warning', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnEliminar.innerHTML = '<i class="bi bi-trash3"></i>';
                    BtnEliminar.classList.add('btn', 'btn-danger', 'w-100', 'text-uppercase', 'fw-bold', 'shadow', 'border-0');

                    BtnModificar.addEventListener('click', () => llenarFormulario(materias));
                    BtnEliminar.addEventListener('click', () => EliminarMateria(materias.materia_id));

                    celda1.innerText = contador;
                    celda2.innerText = materias.materia_nombre;
                    celda3.appendChild(BtnModificar);
                    celda4.appendChild(BtnEliminar);

                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);
                    tr.appendChild(celda4);

                    fragment.appendChild(tr);
                    contador++;
                });

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: `Se encontraron ${data.length} materia(s)`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }

            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No existen materias ';
                tr.classList.add('text-center');
                td.colSpan = 8;

                tr.appendChild(td);
                fragment.appendChild(tr);

                if (e) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: 'No se encontraron materias',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        }

        MateriasIngresadas.tBodies[0].appendChild(fragment);

    } catch (error) {
        console.log(error);
    }
}

const llenarFormulario = (materias) =>{
    Swal.fire({
        title: `¿Está seguro de que desea modificar el nombre de: "${materias.materia_nombre}"?`,
        text: "Esta acción permitirá editar el nombre de la materia.",
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

            FormularioMaterias.materia_id.value = materias.materia_id
            FormularioMaterias.materia_nombre.value = materias.materia_nombre

            BtnModificar.parentElement.style.display = '';
            BtnCancelar.parentElement.style.display = '';
            BtnGuardar.parentElement.style.display = 'none';
            BtnBuscar.parentElement.style.display = 'none';
            BtnLimpiar.parentElement.style.display = 'none';
        }
    });
}

const ModificarMaterias = async (e) => {

    e.preventDefault();


    if (validarFormulario(FormularioMaterias)) {

        BtnModificar.disabled = true;

        const formData = new FormData(FormularioMaterias)
        formData.append('tipo', 2);

        const url = '/CRUD_JS2_VASQUEZ/controller/Materias/index.php'
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

                FormularioMaterias.reset();
                ObtenerMaterias();

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
    FormularioMaterias.reset();
    ObtenerMaterias();
}

const EliminarMateria = async (ID) => {
    Swal.fire({
        title: '¿Está seguro de que desea eliminar esta Materia?',
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
            formData.append('materia_id', ID);

            const url = '/CRUD_JS2_VASQUEZ/controller/Materias/index.php';
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
                        FormularioMaterias.reset();
                        ObtenerMaterias();
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




ObtenerMaterias();
FormularioMaterias.addEventListener('submit', GuardarMaterias)
BtnBuscar.addEventListener('click', ObtenerMaterias)
BtnModificar.addEventListener('click', ModificarMaterias)
BtnCancelar.addEventListener('click', Cancelar )