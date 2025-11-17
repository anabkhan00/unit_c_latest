<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FileSync;

class FileSyncShareController extends Controller
{
    public function index()
    {
        // dd('here');

        // Get all folders for the user
$folders = FileSync::with('shares')
    ->whereHas('shares', function($q) {
        $q->where('share_with_user_id', auth()->id());
    })
    ->where('type', 'folder')
    ->orderByDesc('created_at')
    ->get();



        // Get all files for the user that are NOT inside any folder (parent_id is null)
        $looseFiles = FileSync::with('shares')
        ->whereHas('shares', function($q) {
        $q->where('share_with_user_id', auth()->id());
    })
            ->where(function($q) {
                $q->where('type', '!=', 'folder')
                  ->orWhereNull('type'); // fallback if type is null
            })
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
            //  dd(auth()->id(),$folders);
        // Merge folders and loose files
        $all = $folders->concat($looseFiles)->values();

        $result = $all->map(function ($file) {
            $type = $file->type === 'folder' ? 'folder' : $this->getFileType($file->name);
            $isImage = $type === 'image';
            return [
                'id' => $file->id,
                'name' => $file->name,
                'type' => $type,
                'url' => $isImage ? asset($file->path) : null,
                'path' => $file->path,
            ];
        });
        return response()->json(['success' => true, 'files' => $result]);
    }
        private function getFileType($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return match ($extension) {
            'pdf' => 'pdf',
            'doc', 'docx' => 'word',
            'xls', 'xlsx' => 'xlsx',
            'ppt', 'pptx' => 'ppt',
            'zip', 'rar' => 'zip',
            'jpg', 'jpeg', 'png', 'gif' => 'image',
            default => 'file',
        };
    }
}
