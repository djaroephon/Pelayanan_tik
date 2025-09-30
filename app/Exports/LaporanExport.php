<?php

namespace App\Exports;

use App\Models\Laporan;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Laporan::with([
            'kategori',
            'teknisis',
            'penyelesaian.penjabLayanan.penjab', // Tambahkan relasi penjab
        ])->get();
    }

    public function map($row): array
    {
        // Format untuk penjab layanan: "nama - nama_penjab_layanan"
        $penjabLayanan = '-';
        if ($row->penyelesaian?->penjabLayanan) {
            $namaPenjab = $row->penyelesaian->penjabLayanan->penjab->name ?? 'nama';
            $penjabLayanan = $namaPenjab . ' - ' . $row->penyelesaian->penjabLayanan->nama_penjab_layanan;
        }

        return [
            $row->id,
            $row->nama_pelapor,
            $row->no_hp_pelapor,
            $row->email_pelapor,
            $row->instansi,
            $row->bidang,
            $row->laporan_permasalahan,
            $row->waktu_permasalahan ? Carbon::parse($row->waktu_permasalahan)->format('Y-m-d H:i:s') : null,
            $row->ip_jaringan,
            $row->ip_server,
            $row->kategori?->nama_kategori ?? '-',
            $row->teknisis->pluck('nama_teknisi')->join(', '),
            $penjabLayanan, // Format: "nama - nama_penjab_layanan"
            $row->teknisis->pluck('pivot.deskripsi_masalah')->filter()->join(' | '),
            $row->teknisis->pluck('pivot.deskripsi_penyelesaian')->filter()->join(' | '),
            $row->teknisis->pluck('pivot.selesai_pada')->filter()
                ->map(fn ($tanggal) => Carbon::parse($tanggal)->format('Y-m-d H:i:s'))
                ->join(' | '),
            $row->status,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelapor',
            'No. HP',
            'Email',
            'Instansi',
            'Bidang',
            'Laporan Permasalahan',
            'Waktu Permasalahan',
            'IP Jaringan',
            'IP Server',
            'Kategori',
            'Teknisi',
            'Penjab Layanan',
            'Deskripsi Masalah',
            'Penyelesaian',
            'Selesai Pada',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = 'Q';
        $lastRow = Laporan::count() + 1;

        // Border dan wrap text
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'alignment' => [
                'wrapText' => true,
                'vertical' => 'top',
            ],
        ]);

        // Heading bold dan background
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'D9D9D9'],
            ],
        ]);

        // Autofilter
        $sheet->setAutoFilter("A1:{$lastColumn}1");

        return [];
    }
}
