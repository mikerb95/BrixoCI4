
<?php // Archivo de controlador para autenticacion

namespace App\Controllers; // Define el espacio de nombres de la app

use CodeIgniter\Database\Exceptions\DatabaseException; // Importa excepciones de base de datos

class Auth extends BaseController // Controlador especializado en autenticacion
{
    public function register() // Metodo para mostrar y procesar el registro
    {
        helper(['form']); // Carga el helper de formularios

        $session = session(); // Obtiene la instancia de sesion
        $data = [ // Prepara los datos que se enviaran a la vista
            'message'    => $session->getFlashdata('message'), // Mensaje flash positivo
            'error'      => $session->getFlashdata('error'), // Mensaje flash de error
            'validation' => null, // Contenedor para los errores de validacion
        ];

        if ($this->request->getMethod() === 'post') { // Verifica si el formulario fue enviado
            $rules = [ // Reglas de validacion para el registro
                'nombre'               => 'required|min_length[3]|alpha_numeric_space', // Nombre requerido y con longitud minima
                'correo'               => 'required|valid_email|is_unique[ADMINISTRADOR.correo]', // Correo unico y valido
                'contrasena'           => 'required|min_length[8]', // Contrasena con longitud minima
                'contrasena_confirmar' => 'required|matches[contrasena]', // Confirmacion igual a la contrasena
            ];

            if (! $this->validate($rules)) { // Si la validacion falla
                $data['validation'] = $this->validator; // Adjunta los errores

                return view('auth/register', $data); // Retorna la vista con errores
            }

            $builder = db_connect()->table('ADMINISTRADOR'); // Construye la consulta a la tabla ADMINISTRADOR

            try {
                $builder->insert([ // Inserta el nuevo usuario
                    'nombre'     => trim((string) $this->request->getPost('nombre')), // Sanitiza el nombre
                    'correo'     => strtolower(trim((string) $this->request->getPost('correo'))), // Normaliza el correo
                    'contrasena' => password_hash((string) $this->request->getPost('contrasena'), PASSWORD_DEFAULT), // Guarda la contrasena hasheada
                ]);
            } catch (DatabaseException $exception) { // Atrapa errores de base de datos
                $session->setFlashdata('error', 'No se pudo registrar el usuario. Intentalo de nuevo.'); // Mensaje al usuario

                return redirect()->back()->withInput(); // Regresa al formulario conservando datos
            }

            $session->setFlashdata('message', 'Cuenta creada correctamente. Ahora puedes iniciar sesion.'); // Mensaje de exito

            return redirect()->to('/'); // Redirige al login
        }

        return view('auth/register', $data); // Muestra el formulario de registro
    }
}