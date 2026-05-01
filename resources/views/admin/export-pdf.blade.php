<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan SAPA - {{ $month }}/{{ $year }}</title>
    <style>
        @page { margin: 1cm; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #0f172a;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #64748b;
            font-weight: bold;
        }

        .info-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .info-box table {
            width: 100%;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #0f172a;
            color: #ffffff;
            text-align: left;
            padding: 12px 10px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 11px;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .bg-pending { background-color: #fef3c7; color: #92400e; }
        .bg-process { background-color: #dbeafe; color: #1e40af; }
        .bg-resolved { background-color: #dcfce7; color: #166534; }
        .bg-rejected { background-color: #fee2e2; color: #991b1b; }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 9px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
            padding-top: 5px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Sistem Informasi SAPA</h1>
        <p>LAPORAN REKAPITULASI KELUHAN SISWA</p>
    </div>

    <div class="info-box">
        <table>
            <tr>
                <td style="border:none; padding:0; width: 150px;">Periode Laporan</td>
                <td style="border:none; padding:0;">: <strong>{{ \Carbon\Carbon::create()->month((int)$month)->isoFormat('MMMM') }} {{ $year }}</strong></td>
            </tr>
            <tr>
                <td style="border:none; padding:0;">Total Laporan</td>
                <td style="border:none; padding:0;">: {{ $complaints->count() }} Data</td>
            </tr>
            <tr>
                <td style="border:none; padding:0;">Dicetak Pada</td>
                <td style="border:none; padding:0;">: {{ now()->isoFormat('D MMMM YYYY, HH:mm') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">No. Tiket</th>
                <th width="35%">Judul Keluhan</th>
                <th width="15%">Kategori</th>
                <th width="15%">Status</th>
                <th width="15%">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($complaints as $key => $item)
            <tr>
                <td align="center">{{ $key + 1 }}</td>
                <td><strong>#{{ $item->ticket_number }}</strong></td>
                <td>{{ $item->title }}</td>
                <td>{{ ucfirst($item->category) }}</td>
                <td>
                    <span class="badge bg-{{ $item->status }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center" style="padding: 50px; color: #94a3b8;">
                    Tidak ada data laporan pada periode ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh Sistem SAPA - {{ now()->year }}
    </div>

</body>
</html>