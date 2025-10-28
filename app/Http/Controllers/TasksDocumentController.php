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
    // dd($request->all());
    $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'document' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
    ]);

    $path = $request->file('document')->store('task_documents', 'public');

    TasksDocument::create([
        'task_id' => $request->task_id,
        'document_path' => $path,
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
