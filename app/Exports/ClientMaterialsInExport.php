<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;

class ClientMaterialsInExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    public function collection()
    {
        // Step 1: Fetch clients
        $clients = DB::table('client_materials')
            ->select('client_unique_id', 'client_name', 'email', 'mobile', 'material_details', 'created_at')
            ->orderBy('id', 'desc')
            ->get();

        // Step 2: Fetch paints for ral_code lookup
        $paints = DB::table('paints')->select('id', 'ral_code')->get()->keyBy('id');

        $rows = collect();
        $serial = 1;

        // Step 3: Loop through clients and materials
        foreach ($clients as $client) {
            $materials = json_decode($client->material_details, true) ?? [];

            if (count($materials) > 0) {
                foreach ($materials as $mat) {
                    // Match paint_id with paints table to get RAL code
                    $paintId = $mat['paint_id'] ?? null;
                    $ralCode = $paintId && isset($paints[$paintId]) ? $paints[$paintId]->ral_code : '';

                    $rows->push([
                        'SL' => $serial,
                        'Client Unique ID' => $client->client_unique_id,
                        'Client Name' => $client->client_name,
                        'Email' => $client->email,
                        'Mobile' => $client->mobile,
                        'Type' => $mat['type'] ?? '',
                        'Material Name' => $mat['material_name'] ?? '',
                        'Quantity' => $mat['quantity'] ?? '',
                        'Unit' => $mat['unit'] ?? '',
                        'RAL Code' => $ralCode,
                        'Created At' => $client->created_at,
                    ]);
                }
            } else {
                // If no materials found
                $rows->push([
                    'SL' => $serial,
                    'Client Unique ID' => $client->client_unique_id,
                    'Client Name' => $client->client_name,
                    'Email' => $client->email,
                    'Mobile' => $client->mobile,
                    'Type' => '',
                    'Material Name' => '',
                    'Quantity' => '',
                    'Unit' => '',
                    'RAL Code' => '',
                    'Created At' => $client->created_at,
                ]);
            }

            $serial++;
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            ['SL', 'Client Unique ID', 'Client Name', 'Email', 'Mobile', 'Type', 'Material Name', 'Quantity', 'Unit', 'RAL Code', 'Created At'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold header row
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Header styling
                $sheet->getStyle('A1:K1')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'FFFF00'], // Yellow background
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Auto-size columns
                foreach (range('A', 'K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Table border styling
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:K{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
