const BtnGuardar = document.getElementById('BtnGuardar');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnCancelar = document.getElementById('BtnCancelar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const tablaAlumnos = document.getElementById('AlumnosIngresados');
const DatosAlumnos = document.getElementById('DatosAlumnos')
const FormularioAlumnos = document.querySelector('form');


BtnModificar.parentElement.style.display = 'none'
BtnCancelar.parentElement.style.display = 'none'
DatosAlumnos.style.display = 'none'

const GuardarAlumnos = async (e) =>{

    e.PreventDefault();

    if(validarFormulario(FormularioAlumnos, ['alu_id'])) {

        BtnGuardar.disable = true;

        const formData = new FormData(FormularioAlumnos)
        formData.append('tipo', 1);
        formData.delete('alu_id')
        
        const url = '/CRUD_JS2_VASQUEZ/controller/Alumnos/index.php'
        
        const config = {
            method: 'POST',
            body: formData

        }
    }
}