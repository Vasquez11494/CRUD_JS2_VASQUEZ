const BtnGuardar = document.getElementById('BtnGuardar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const tablaAlumnos = document.getElementById('AlumnosIngresados');
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

                FormularioMaterias.reset();
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
