<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
   public function index()
    {
        $responses = Response::with('complaint')->latest()->get();
        return view('user.user', compact('responses'));
    }
  public function store(Request $request)
{
    
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $request->validate([
        'complaint_id' => 'required|exists:complaints,id', 
        'massage'      => 'required|string|min:2|max:2000',
    ]);

    $complaint = Complaint::findOrFail($request->complaint_id);

    Response::create([
        'complaint_id' => $complaint->id,
        'user_id'      => Auth::id(), 
        'massage'      => $request->massage, 
    ]);

    if (Auth::user()?->role !== 'user' && $complaint->status === 'pending') {
        $complaint->update(['status' => 'process']);
    }

    return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
}
    public function destroy($id)
    {
        $response = Response::findOrFail($id);

      
        if ($response->user_id !== Auth::id() && Auth::user()->role === 'user') {
            abort(403, 'Kamu tidak punya akses menghapus pesan ini.');
        }

        $response->delete();

        return redirect()->back()->with('success', 'Tanggapan telah dihapus.');
    }
}