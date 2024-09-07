<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\Enums\UserRole;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == UserRole::SELLER->value) {
            $documents = Document::latest()->where('user_id', Auth::id())->paginate(10);
            return view('seller.documents', compact('documents'));
        } else {
            # code...
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentRequest $request)
    {
        $uniqueid = uniqid();
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;

        $path = $request->file('file')->storeAs('files', $filename, 'public');
        $fileUrl = Storage::url($path);

        Document::create([
            "name" => $request->input('name'),
            "type" => $request->input('type'),
            "src" => $fileUrl,
            "status" => DocumentStatus::PENDING->value,
            "user_id" => Auth::id(),
        ]);

        return redirect('/seller/documents')->with('success', 'Document submitted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->delete();
            return redirect('/seller/documents')->with('success', 'Document deleted successfully.');
        } else {
            return redirect('/seller/documents')->withErrors('Document not found');
        }
    }
}
