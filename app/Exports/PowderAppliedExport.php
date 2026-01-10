<?php

namespace App\Exports;

use App\Models\Jobcard;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class PowderAppliedExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    public function collection()
    {
        $jobcards = Jobcard::with(['order.client', 'paint'])
            ->where('jobcard_status', 'powder-applied')
            ->orderBy('id', 'desc')
            ->get();

        $rows = collect();
        $serial = 1;

        foreach ($jobcards as $jobcard) {
            $rows->push([
                'SL' => $serial++,
                'Jobcard No' => $jobcard->jobcard_number,
                'Client Name' => $jobcard->order->client->client_name ?? '',
                'Email' => $jobcard->order->client->email ?? '',
                'Mobile' => $jobcard->order->client->mobile ?? '',
                'Address' => $jobcard->order->client->address ?? '',
                'Order No' => $jobcard->order->order_number ?? '',
                'Order Date' => $jobcard->order->created_at ? $jobcard->order->created_at->format('d-m-Y') : '',
                'Material' => $jobcard->material_name,
                'Quantity' => $jobcard->material_quantity,
                'Unit' => $jobcard->material_unit,
                'Paint Brand' => $jobcard->paint->brand_name ?? '',
                'Shade' => $jobcard->paint->shade_name ?? '',
                'RAL Code' => $jobcard->paint->ral_code ?? '',
                'Finish' => $jobcard->paint->finish ?? '',
                'Status' => ucfirst($jobcard->jobcard_status),
                'Pre-treatment Date' => $jobcard->pre_treatment_date ? $jobcard->pre_treatment_date->format('d-m-Y') : '',
                'Powder Applied Date' => $jobcard->powder_applied_date ? $jobcard->powder_applied_date->format('d-m-Y') : '',
                'Creation Date' => $jobcard->jobcard_creation_date ? $jobcard->jobcard_creation_date->format('d-m-Y') : '',
                'Description' => $jobcard->description ?? '',
            ]);
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'SL',
            'Jobcard No',
            'Client Name',
            'Email',
            'Mobile',
            'Address',
            'Order No',
            'Order Date',
            'Material',
            'Quantity',
            'Unit',
            'Paint Brand',
            'Shade',
            'RAL Code',
            'Finish',
            'Status',
            'Pre-treatment Date',
            'Powder Applied Date',
            'Creation Date',
            'Description'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold header row
        $sheet->getStyle('A1:S1')->getFont()->setBold(true);

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
                $sheet->getStyle('A1:S1')->applyFromArray([
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
                foreach (range('A', 'S') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Table border styling
                $highestRow = $sheet->getHighestRow();
                $sheet->getStyle("A1:S{$highestRow}")->applyFromArray([
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
