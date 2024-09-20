<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\Client;
use App\Models\Document;
use App\Models\Installation;
use App\Models\Enterprise;
use App\Models\Inspector;
use App\Models\Project;
use App\Models\Result;

class ClientController extends Controller
{
    public function index()
    {
        return view('company.pages.clients.index');
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Verificar si el archivo ha sido subido
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Cargar el archivo Excel
            $spreadsheet = IOFactory::load($file->getPathName());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true); // Convertir a array

            // dd($rows);
            // Iterar sobre las filas (omitir la primera fila si es el header)
            foreach ($rows as $index => $row) {
                if ($index == 1) {
                    // Ignorar el header (primera fila)
                    continue;
                }

                // Mapeo de columnas del Excel para el cliente
                $dni = $row['H'];  // Número de documento de identificación del solicitante
                $client = Client::where('document_number', $dni)->first();

                // Si el cliente no existe, lo creamos
                if (!$client) {
                    $client = new Client();
                    $client->document_number = $dni;
                }

                // Actualizamos los datos del cliente
                $client->document_type = $row['G']; //tipo de documento
                $client->name = $row['I'];  // Nombre del solicitante
                $client->phone = $row['J']; // Teléfono
                $client->cell_phone = $row['K']; // Celular
                $client->email = $row['L'];   // Correo electrónico
                $client->address = $row['M']; // Dirección
                $client->department = $row['N']; // Departamento
                $client->province = $row['O'];  // Provincia
                $client->district = $row['P'];  // Distrito
                $client->save();

                // Ahora procesamos las otras tablas relacionadas
                // Por ejemplo, la tabla de installations

                // $installationCode = $row['A']; // Código de instalación (columna A)
                // $installation = Installation::where('code', $installationCode)->first();

                // if (!$installation) {
                //     $installation = new Installation();
                //     $installation->code = $installationCode;
                // }

                // // Llenar o actualizar los datos de la instalación
                // $installation->client_id = $client->id; // Relación con el cliente
                // $installation->installation_date = $row['B'];  // Fecha de instalación
                // $installation->installation_address = $row['C']; // Dirección de instalación
                // $installation->save();

                // // Procesar la tabla enterprises (empresas)
                // $enterpriseRUC = $row['D'];  // RUC de la empresa (columna D)
                // $enterprise = Enterprise::where('ruc', $enterpriseRUC)->first();

                // if (!$enterprise) {
                //     $enterprise = new Enterprise();
                //     $enterprise->ruc = $enterpriseRUC;
                // }

                // // Actualizar o crear datos de la empresa
                // $enterprise->name = $row['E'];  // Nombre de la empresa
                // $enterprise->address = $row['F']; // Dirección de la empresa
                // $enterprise->phone = $row['G'];   // Teléfono de la empresa
                // $enterprise->save();

                // // Procesar la tabla de proyectos (projects)
                // $projectName = $row['Q']; // Nombre del proyecto (columna Q)
                // $project = Project::where('name', $projectName)->first();

                // if (!$project) {
                //     $project = new Project();
                //     $project->name = $projectName;
                // }

                // // Asociar el proyecto con la instalación o empresa si aplica
                // $project->enterprise_id = $enterprise->id;
                // $project->save();

                // Procesar otros datos como documentos o resultados, si son necesarios
                // Aquí puedes seguir un flujo similar para otras tablas como Document, Inspector, Result, etc.
            }

            return response()->json(['success' => 'Excel processed successfully']);
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    }
}
