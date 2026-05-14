<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\ComplaintsExport;
use Illuminate\Support\Facades\Http as FacadesHttp;
use League\Uri\Http;

class ComplaintController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $categories = [
            'bullying' => 'Perundungan',
            'facilities' => 'Fasilitas',
            'suggestion' => 'Saran'
        ];

        
        $query = ($user->role === 'admin') 
            ? Complaint::query() 
            : $user->complaints();

        $complaints = $query->orderBy('created_at', 'desc')->paginate(5);
        
        $total = $query->count();
        $totalPending = (clone $query)->where('status', 'pending')->count();
        $totalprocess = (clone $query)->where('status', 'process')->count();
        $totalresolved = (clone $query)->where('status', 'resolved')->count();

        
        $view = ($user->role === 'admin') ? 'admin.dashboardadmin' : 'user.user';
        
        return view($view, compact('complaints', 'categories', 'total', 'totalprocess', 'totalresolved', 'totalPending'));
    }

    public function showAll(Request $request)
    {
        $user = Auth::user();
        
       
        $query = ($user->role === 'admin') 
            ? Complaint::with('user') 
            : $user->complaints();

        $query->latest();

       
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('ticket_number', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $complaints = $query->paginate(10)->withQueryString();
        $total = $complaints->total();
        $categories = ['bullying' => 'Bullying', 'facilities' => 'Fasilitas', 'suggestion' => 'Saran'];

        $view = ($user->role === 'admin') ? 'admin.adminreports' : 'user.complaints';

        return view($view, compact('complaints', 'total', 'categories'));
    }

    public function show($slug)
    {
        $user = Auth::user();
        
        $complaint = ($user->role === 'admin')
            ? Complaint::where('slug', $slug)->firstOrFail()
            : $user->complaints()->where('slug', $slug)->firstOrFail();

        $view = ($user->role === 'admin') ? 'admin.detail-report' : 'user.detail-complaint';
        
        return view($view, compact('complaint'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'evidence_photo' => 'nullable|image|max:2048',
            'category' => 'required|in:bullying,facilities,suggestion',
        ]);

        $imageUrl = null;

            if ($request->hasFile('evidence_photo')) {
                $file = $request->file('evidence_photo');
                $imageUrl = $this->uploadToSufy($file);
            }

        $initials = [
            'bullying' => 'BLY',
            'facilities' => 'FCL',
            'suggestion' => 'SGS'
        ];
        
        $prefix = $initials[$request->category] ?? 'LPR';
        $ticketNumber = $prefix . '-' . strtoupper(Str::random(8));

        Complaint::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'evidence_photo' => $imageUrl,
            'is_anonymous' => $request->has('is_anonymous'),
            'status' => 'pending',
            'ticket_number' => $ticketNumber,
            'slug' => Str::slug($request->title).'-'.Str::random(5),
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint submitted successfully.');
    }
    public function update(Request $request, $id) 
{
    $request->validate([
        'status' => 'required|in:pending,process,resolved,rejected',
    ]);

    $complaint = Complaint::findOrFail($id);
    $complaint->update([
        'status' => $request->status,
    ]);

    return back()->with('success', 'Status berhasil diperbarui!');
}

  public function quickUpdateStatus(Request $request) 
{
    $complaint = Complaint::findOrFail($request->complaint_id);
    $currentStatus = $complaint->status;
    $nextStatus = $currentStatus;

    if ($currentStatus === 'pending') {
        $nextStatus = 'process';
    } elseif ($currentStatus === 'process') {
        $nextStatus = 'resolved';
    }

    $complaint->update([
        'status' => $nextStatus,
    ]);

    return back()->with('success', 'Status berhasil diperbarui ke ' . $nextStatus);
}

    public function destroy($id)
    {
        $user = Auth::user();
        
        $complaint = Complaint::findOrFail($id);
        
        if ($user->role !== 'admin' && $complaint->user_id !== $user->id) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $complaint->delete();
        return redirect()->back()->with('success', 'Complaint deleted successfully.');
    }
 public function exportPDF(Request $request)
{
    $month = (int) $request->get('month', date('n'));
    $year = (int) $request->get('year', date('Y'));
    
    $complaints = Complaint::whereMonth('created_at', $month)
        ->whereYear('created_at', $year)
        ->latest()
        ->get();

    $namaBulan = \Carbon\Carbon::create()->month($month)->isoFormat('MMMM YYYY');

    $pdf = Pdf::loadView('admin.export-pdf', compact('complaints', 'month', 'year', 'namaBulan'));
    
    return $pdf->download("Laporan-SAPA-$month-$year.pdf");
}

public function exportExcel(Request $request)
{
    $month = (int) $request->get('month', Carbon::now()->month);
    $year = (int) $request->get('year', Carbon::now()->year);
    
    $namaBulan = Carbon::create()->month($month)->year($year)->isoFormat('MMMM-YYYY');
    
    return Excel::download(new ComplaintsExport($month, $year), 'Rekap-SAPA-' . $namaBulan . '.xlsx');
}

private function uploadToSufy($file)
{
    $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

    $response = FacadesHttp::withHeaders([
        'Authorization' => 'Bearer ' . env('SUVY_API_SECRET'),
    ])->attach(
        'file',
        file_get_contents($file),
        $fileName
    )->post('https://idoxf6f.sufydely.com/api/storage/upload', [
        'bucket' => 'evidence'
    ]);

    if ($response->successful()) {

        $data = $response->json();

        return $data['url'] ?? $data['data']['url'] ?? null;
    }

    throw new \Exception('Upload ke Sufy gagal: ' . $response->body());
}
}