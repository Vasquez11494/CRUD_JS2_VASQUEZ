const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const tablaMaterias = document.getElementById('tablaMaterias');
const FormularioNotas = document.querySelector('form');
const inputAlumno = document.getElementById('alu_id')

BtnGuardar.classList.add()

const manejarBotones = (tieneNotas) => {
    if (tieneNotas) {
        BtnGuardar.classList.add('d-none');
        BtnModificar.classList.remove('d-none');
        BtnCancelar.classList.remove('d-none');
    } else {
        BtnGuardar.classList.remove('d-none');
        BtnModificar.classList.add('d-none');
        BtnCancelar.classList.add('d-none');
    }
};

const BuscarNotas = async () => {

    const alumno_id = FormularioNotas.alu_id.value;

    const formData = new FormData()
    formData.append('tipo', 2);
    formData.append('nota_alu_id', alumno_id)

    const url = '/CRUD_JS2_VASQUEZ/controller/Notas/index.php'

    const config = {
        method: 'POST',
        body: formData
    }

    try {

        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        tablaMaterias.tBodies[0].innerHTML = '';
        const fragment = document.createDocumentFragment();
        let contador = 1;

        if (respuesta.status == 200) {
            if (data.length > 0) {
                // console.log(data)
                data.forEach(materia => {
                    const tr = document.createElement('tr');
                    const celda1 = document.createElement('td');
                    const celda2 = document.createElement('td');
                    const celda3 = document.createElement('td');


                    celda1.innerText = contador;
                    celda2.innerText = materia.materia_nombre;
                    celda3.innerHTML = `
                        <input type="hidden" name="materia_id[]" value="${materia.materia_id}">
                        <input type="number" name="nota[]" 
                        value="${materia.nota !== null ? materia.nota : ''}" 
                        placeholder="${materia.nota !== null ? '' : 'Sin nota'}" 
                        class="form-control form-control-sm w-50 mx-auto" 
                        step="0.01" required min="0" max="100">
                    `;
                    tr.appendChild(celda1);
                    tr.appendChild(celda2);
                    tr.appendChild(celda3);


                    fragment.appendChild(tr);

                    if (materia.nota !== null) {
                        tieneNotas = true;
                    }
                    contador++;
                });

            } else {
                const tr = document.createElement('tr');
                const td = document.createElement('td');
                td.innerText = 'No existen Materias';
                tr.classList.add('text-center');
                td.colSpan = 3;

                tr.appendChild(td);
                fragment.appendChild(tr);
            }
        }

        tablaMaterias.tBodies[0].appendChild(fragment);

    } catch (error) {
        console.log(error);
    }


}

const GuardarNotas = async (e) => {

    e.preventDefault();

    if (validarFormulario(FormularioNotas)) {

        const nota_alu_id = FormularioNotas.alu_id.value
        // console.log(nota_alu_id)
        const formData = new FormData(FormularioNotas)
        formData.append('tipo', 1);

        const url = '/CRUD_JS2_VASQUEZ/controller/Notas/index.php'

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

                FormularioNotas.reset();
                BuscarNotas();

            } else {
                console.log(detalle);
            }


        } catch (error) {
            console.log(error);
        }
        BtnGuardar.disabled = false;

    }
}

FormularioNotas.addEventListener('submit', GuardarNotas)

inputAlumno.addEventListener('change', BuscarNotas)



