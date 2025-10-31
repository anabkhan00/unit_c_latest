<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TasksDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class TasksDocumentController extends Controller
{
    public function getDocuments($taskId)
{
    $documents = \App\Models\TasksDocument::where('task_id', $taskId)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'documents' => $documents,
    ]);
}

public function store(Request $request)
{
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'document' => 'required|file',
    ]);

    $file = $request->file('document');

    // Get the original name of the file (e.g. "report.pdf")
    $originalName = $file->getClientOriginalName();

    // Optional: ensure unique filename by prefixing timestamp
    $fileName = $originalName;
// time() . '_' . 
    // Store file in public storage with the original name
    $path = $file->storeAs('task_documents', $fileName, 'public');

    TasksDocument::create([
        'task_id' => $request->task_id,
        'document_path' => $path,
        'document_name' => $originalName, // Optional: store original name separately
        'uploaded_by' => Auth::user()->name ?? 'Guest',
    ]);

    $documents = TasksDocument::where('task_id', $request->task_id)
        ->latest()
        ->get();

    return response()->json([
        'message' => 'Document uploaded successfully.',
        'documents' => $documents,
    ]);
}



    /**
     * Remove the specified document.
     */
    public function destroy($id)
    {
        $document = TasksDocument::findOrFail($id);
        $taskId = $document->task_id;

        Storage::disk('public')->delete($document->document_path);
        $document->delete();

        $documents = TasksDocument::where('task_id', $taskId)->get();

        return response()->json([
            'message' => 'Document deleted successfully.',
            'documents' => $documents,
        ]);
    }
}
