<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ContratistaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Shuchkin\SimpleXLSXGen;

class Reportes extends BaseController
{
    public function contratistas()
    {
        $model = new ContratistaModel();
        // Usamos getWithLocation para obtener datos más completos incluyendo ubicación
        $data = $model->getWithLocation();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 1. Encabezados
        $headers = ['ID', 'Nombre', 'Correo', 'Teléfono', 'Ciudad', 'Departamento', 'Experiencia'];
        $column = 'A';

        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $column++;
        }

        // Estilo para encabezados (Negrita y Fondo Gris Claro)
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFEEEEEE'],
            ],
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        // 2. Llenar datos
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item['id_contratista']);
            $sheet->setCellValue('B' . $row, $item['nombre']);
            $sheet->setCellValue('C' . $row, $item['correo']);
            $sheet->setCellValue('D' . $row, $item['telefono']);
            $sheet->setCellValue('E' . $row, $item['ciudad'] ?? 'N/A');
            $sheet->setCellValue('F' . $row, $item['departamento'] ?? 'N/A');
            $sheet->setCellValue('G' . $row, $item['experiencia']);
            $row++;
        }

        // 3. Autoajustar columnas
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 4. Descargar archivo
        $filename = 'reporte_contratistas_' . date('Y-m-d_H-i') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function solicitudesXlsx()
    {
        // Export simple usando SimpleXLSXGen para minimizar dependencias y conflictos
        $db = db_connect();
        $rows = $db->table('SOLICITUD')
            ->select('id_solicitud, id_cliente, id_contratista, titulo, descripcion, presupuesto, ubicacion, estado, creado_en')
            ->orderBy('creado_en', 'DESC')
            ->get()->getResultArray();

        $data = [];
        $data[] = ['ID', 'Cliente', 'Contratista', 'Título', 'Descripción', 'Presupuesto', 'Ubicación', 'Estado', 'Creado en'];
        foreach ($rows as $r) {
            $data[] = [
                $r['id_solicitud'],
                $r['id_cliente'],
                $r['id_contratista'],
                $r['titulo'],
                $r['descripcion'],
                $r['presupuesto'],
                $r['ubicacion'],
                $r['estado'],
                $r['creado_en'],
            ];
        }

        $xlsx = SimpleXLSXGen::fromArray($data)->setDefaultFont('Arial');
        $fileName = 'reporte_solicitudes_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $xlsx->saveAs('php://output');
        exit;
    }
}
