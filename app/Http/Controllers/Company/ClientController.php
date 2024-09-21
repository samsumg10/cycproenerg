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
use App\Jobs\ProcessExcelJob;

class ClientController extends Controller
{
    public function index()
    {
        return view('company.pages.clients.index');
    }

    // public function change(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|file|mimes:xlsx,xls'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');

    //         // Enviar el archivo para ser procesado en segundo plano (usando colas)
    //         ProcessExcelJob::dispatch($file->getPathname());

    //         return response()->json(['success' => 'Excel processing started'], 200);
    //     }

    //     return response()->json(['error' => 'File not uploaded'], 400);
    // }

    public function change(Request $request)
    {
        // Validación del archivo cargado
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'El archivo debe ser un documento Excel válido (.xlsx o .xls).'
            ], 422);
        }
    
        // Inicializar contadores y flag de error
        $createdCount = 0;
        $updatedCount = 0;
        $hasErrors = false;
    
        // Verificar si el archivo ha sido subido
        if ($request->hasFile('file')) {
            $file = $request->file('file');
    
            try {
                // Cargar el archivo Excel
                $spreadsheet = IOFactory::load($file->getPathName());
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray(null, true, true, true);
    
                // Verificar si el archivo está vacío
                if (count($rows) <= 1) {
                    throw new \Exception("El archivo Excel está vacío o solo contiene encabezados.");
                }
    
                // Iterar sobre las filas (omitir la primera fila si es el header)
                foreach ($rows as $index => $row) {
                    if ($index == 1) {
                        continue; // Ignorar el header (primera fila)
                    }
    
                    // Validar que las columnas clave existen y tienen datos válidos
                    if (empty($row['H']) || empty($row['I']) || empty($row['G']) || !is_numeric($row['H']) || !filter_var($row['L'], FILTER_VALIDATE_EMAIL)) {
                        $hasErrors = true;
                        continue;
                    }
    
                    // Procesamiento del cliente (crear o actualizar)
                    $dni = trim($row['H']);
                    $client = Client::where('document_number', $dni)->first();
    
                    if (!$client) {
                        $client = new Client();
                        $client->document_number = $dni;
                        $createdCount++;
                    } else {
                        $updatedCount++;
                    }
    
                    // Actualizar datos del cliente
                    $client->document_type = trim($row['G']);
                    $client->name = trim($row['I']);
                    $client->phone = trim($row['J']);
                    $client->cell_phone = trim($row['K']);
                    $client->email = trim($row['L']);
                    $client->address = trim($row['M']);
                    $client->department = trim($row['N']);
                    $client->province = trim($row['O']);
                    $client->district = trim($row['P']);
                    $client->save();

                    // $installationCode = trim($row['A']);
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


                }
    
                // Preparar el mensaje de respuesta
                if ($hasErrors) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Se encontraron datos inconsistentes. Por favor, revise el archivo y vuelva a intentarlo.'
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => "Se agregaron $createdCount nuevos clientes y se actualizaron $updatedCount clientes existentes."
                    ]);
                }
    
            } catch (\Exception $e) {
                Log::error('Error procesando el archivo Excel: ' . $e->getMessage());
    
                return response()->json([
                    'success' => false,
                    'message' => 'Error al procesar el archivo. Por favor, verifique el formato e intente nuevamente.'
                ], 500);
            }
        }
    
        return response()->json([
            'success' => false,
            'message' => 'No se ha subido ningún archivo.'
        ], 400);
    }
}
