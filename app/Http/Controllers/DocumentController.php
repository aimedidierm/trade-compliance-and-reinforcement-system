<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\Enums\UserRole;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        } elseif (Auth::user()->role == UserRole::EXPORTER->value) {
            $documents = Document::latest()->where('status', DocumentStatus::APPROVED->value)->paginate(10);
            $documents->load('user');
            return view('exporter.documents', compact('documents'));
        } else {
            $documents = Document::latest()->paginate(10);
            $documents->load('user');
            return view('minicom.documents', compact('documents'));
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

    /**
     * Update the specified resource from storage.
     */
    public function reject(string $id, Request $request)
    {
        $document = Document::find($id);
        if ($document) {
            $document->status = DocumentStatus::REJECTED->value;
            $document->comment = $request->input('comment');
            $document->update();
            return redirect('/minicom/documents')->with('success', 'Document rejected successfully.');
        } else {
            return redirect('/minicom/documents')->withErrors('Document not found');
        }
    }

    /**
     * Update the specified resource from storage.
     */
    public function approve(string $id)
    {
        $document = Document::find($id);
        if ($document) {
            $document->status = DocumentStatus::APPROVED->value;
            $document->update();
            return redirect('/minicom/documents')->with('success', 'Document approved successfully.');
        } else {
            return redirect('/minicom/documents')->withErrors('Document not found');
        }
    }
}
