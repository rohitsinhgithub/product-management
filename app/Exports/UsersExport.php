<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

class UsersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Roles',
            'Created Date',
            'Created Time',
            'Updated Date',
            'Updated Time'
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->roles->pluck('name')->implode(', '),
            $user->created_at->format('Y-m-d'),
            $user->created_at->format('H:i:s'),
            $user->updated_at->format('Y-m-d'),
            $user->updated_at->format('H:i:s')
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,     // ID
            'B' => 25,    // Name
            'C' => 35,    // Email
            'D' => 30,    // Roles
            'E' => 15,    // Created Date
            'F' => 12,    // Created Time
            'G' => 15,    // Updated Date
            'H' => 12,    // Updated Time
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => ['rgb' => 'E2E8F0']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            'A1:H1' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                
                // Auto-fit columns
                foreach(range('A', 'H') as $column) {
                    $sheet->getDelegate()->getColumnDimension($column)->setAutoSize(false);
                }

                // Style for data cells
                $lastRow = $sheet->getHighestRow();
                $dataRange = 'A2:H'.$lastRow;
                
                $sheet->getDelegate()->getStyle($dataRange)->applyFromArray([
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC']
                        ]
                    ]
                ]);

                // Alternate row colors
                for($row = 2; $row <= $lastRow; $row++) {
                    if($row % 2 == 0) {
                        $sheet->getDelegate()->getStyle('A'.$row.':H'.$row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'color' => ['rgb' => 'F8FAFC']
                            ]
                        ]);
                    }
                }

                // Center align ID columns
                $sheet->getDelegate()->getStyle('A2:A'.$lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                // Center align dates and times
                $sheet->getDelegate()->getStyle('E2:H'.$lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
} 