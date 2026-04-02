<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = [
        'bullying' => 'Perundungan',
        'facilities' => 'Fasilitas',
        'suggestion' => 'Saran'
    ];
        $complaints= Auth::user()->Complaints()->latest()->paginate(3);
        $total = Auth::user()->Complaints()->count();
        $totalPending = Auth::user()->Complaints()->where('status', 'pending')->count();
        $totalprocess = Auth::user()->Complaints()->where('status', 'process')->count();
        $totalresolved = Auth::user()->Complaints()->where('status', 'resolved')->count();
        return view('user.user', compact('complaints','categories','total','totalprocess','totalresolved','totalPending'));
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'evidence_photo' => 'nullable|image|max:2048',
            'category' => 'required|in:bullying,facilities,suggestion',
        ]);
       $filename = null; 

        if($request->hasFile('evidence_photo')){
            $file = $request->file('evidence_photo');
            $filename = time() . '.' . $file->extension();
            
            $file->move(public_path('images'), $filename);
        }
        $initials=[
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
            'evidence_photo' => $filename,
            'is_anonymous' => $request->has('is_anonymous'),
            'status' => 'pending',
            'ticket_number' => $ticketNumber,
            'slug' => Str::slug($request->title).'-'.Str::random(5),
        ]);
        return redirect()->route('user.dashboard')->with('success', 'Complaint submitted successfully.');
    }

    public function show($slug)
    {
       $complaint = Auth::user()->complaints()->where('slug', $slug)->firstOrFail();

          return view('user.detail-complaint', compact('complaint'));
    }
public function showAll(Request $request)
{
    $query = Auth::user()->complaints()->latest();

  
    if ($request->has('search') && $request->search != '') {
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
    $total = $query->count();
    $categories = ['bullying' => 'Bullying', 'facilities' => 'Fasilitas', 'suggestion' => 'Saran'];

    return view('user.complaints', compact('complaints', 'total', 'categories'));
}
    
  
    public function edit(Complaint $complaint)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect()->back()->with('success', 'Complaint deleted successfully.');

    }
}
