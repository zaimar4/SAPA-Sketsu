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
        $totalprocess = Auth::user()->Complaints()->where('status', 'process')->count();
        $totalresolved = Auth::user()->Complaints()->where('status', 'resolved')->count();
        return view('user.user', compact('complaints','categories','total','totalprocess','totalresolved'));
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
        $pothopath=null;
        if($request->hasFile('evidence_photo')){
            $file = $request->file('evidence_photo');
            $filename = time().'_'.$file->extension();
            $pothopath = $file->storeAs('public/images', $filename);
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
            'evidence_photo' => $pothopath,
            'is_anonymous' => $request->has('is_anonymous'),
            'status' => 'pending',
            'ticket_number' => $ticketNumber,
            'slug' => Str::slug($request->title).'-'.Str::random(5),
        ]);
        return redirect()->route('user.dashboard')->with('success', 'Complaint submitted successfully.');
    }

    public function show(Complaint $complaint)
    {
        $complaints= Auth::user()->Complaints()->latest()->get();
        return view('user.complaints', compact('complaints'));
    }

    public function showAll()
    {
        
        $complaints= Auth::user()->Complaints()->latest()->get();
        return view('user.complaints', compact('complaints'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
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
    public function destroy(Complaint $complaint)
    {
        //
    }
}
