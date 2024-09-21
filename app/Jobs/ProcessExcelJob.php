<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // Inicializar los contadores
        $createdCount = 0;
        $updatedCount = 0;

        try {

            // Cargar el archivo Excel
            $spreadsheet = IOFactory::load($this->filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            // Iterar sobre las filas (omitir la primera fila si es el header)
            foreach ($rows as $index => $row) {
                if ($index == 1) {
                    continue; // Ignorar el header
                }

                // Validar que las columnas clave existen y tienen datos válidos
                if (empty($row['H']) || empty($row['I']) || empty($row['G']) || !is_numeric($row['H'])) {
                    // Registrar un error si faltan datos críticos o si el DNI no es numérico
                    Log::warning("Fila $index omitida: faltan datos clave o el formato es incorrecto.");
                    continue; // Saltar a la siguiente fila
                }

                // Mapeo de columnas del Excel para el cliente
                $dni = trim($row['H']); // Número de documento de identificación del solicitante
                $client = Client::where('document_number', $dni)->first();

                // Si el cliente no existe, lo creamos y aumentamos el contador de creados
                if (!$client) {
                    $client = new Client();
                    $client->document_number = $dni;
                    $createdCount++;  // Incrementar el contador de nuevos registros
                } else {
                    $updatedCount++;  // Incrementar el contador de actualizados
                }

                // Validaciones adicionales para los campos específicos
                if (!filter_var($row['L'], FILTER_VALIDATE_EMAIL)) {
                    // Si el correo electrónico no es válido, saltamos la fila y registramos el error
                    Log::warning("Fila $index omitida: correo electrónico no válido.");
                    continue; // Saltar esta fila
                }

                // Actualizamos los datos del cliente
                $client->document_type = $row['G']; // Tipo de documento
                $client->name = $row['I'];  // Nombre del solicitante
                $client->phone = $row['J']; // Teléfono
                $client->cell_phone = $row['K']; // Celular
                $client->email = $row['L'];   // Correo electrónico
                $client->address = $row['M']; // Dirección
                $client->department = $row['N']; // Departamento
                $client->province = $row['O'];  // Provincia
                $client->district = $row['P'];  // Distrito
                $client->save();
            }

            // Después de procesar todas las filas, registrar el resultado
            Log::info("Se agregaron $createdCount nuevos clientes y se actualizaron $updatedCount clientes existentes.");

            // Devolver un resumen del procesamiento si quieres mostrarlo al usuario
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Se agregaron ' . $createdCount . ' nuevos clientes y se actualizaron ' . $updatedCount . ' clientes existentes.'
            // ]);
        } catch (\Exception $e) {
            // Si ocurre algún error, registrarlo en los logs de Laravel
            Log::error('Error procesando el archivo Excel: ' . $e->getMessage());

            // return response()->json([
            //     'success' => false,
            //     'message' => 'Error procesando el archivo Excel. Ver logs para más detalles.'
            // ], 500);
        }
    }
}
