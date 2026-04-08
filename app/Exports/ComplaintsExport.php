<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ComplaintsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $month, $year;

    public function __construct($month, $year) {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection() {
        return Complaint::whereMonth('created_at', $this->month)
                        ->whereYear('created_at', $this->year)
                        ->latest()->get();
    }

    public function headings(): array {
        return ['Nomor Tiket', 'Judul', 'Kategori', 'Status', 'Tanggal'];
    }

    public function map($complaint): array {
        return [
            $complaint->ticket_number,
            $complaint->title,
            $complaint->category,
            strtoupper($complaint->status),
            $complaint->created_at->format('d/m/Y'),
        ];
    }
}