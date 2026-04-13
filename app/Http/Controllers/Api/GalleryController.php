<?php

namespace App\Http\Controllers\Admin; // Pastikan ini ada \Admin

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * FUNGSI UNTUK API (Flutter/Postman)
     * Tanpa Middleware Auth
     */
    public function getGalleryApi()
    {
        try {
            $photos = GalleryPhoto::orderBy('urutan', 'asc')->get()->map(function($photo) {
                return [
                    'id'       => $photo->id,
                    'caption'  => $photo->caption,
                    // asset() menghasilkan URL lengkap http://127.0.0.1:8000/storage/...
                    'foto_url' => asset('storage/' . $photo->foto),
                ];
            });

            return response()->json([
                'status' => 'success',
                'data'   => $photos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * FUNGSI UNTUK WEB ADMIN
     */
    public function index()
    {
        $photos = GalleryPhoto::orderBy('urutan', 'asc')->get();
        return view('gallery', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto'    => 'required|array',
            'foto.*'  => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan'  => 'required|integer',
        ]);

        if ($request->hasFile('foto')) {
            $urutan = (int) $request->urutan;
            foreach ($request->file('foto') as $file) {
                $path = $file->store('gallery', 'public');
                GalleryPhoto::create([
                    'foto'    => $path,
                    'caption' => $request->caption,
                    'urutan'  => $urutan++,
                ]);
            }
        }
        return back()->with('success', 'Berhasil upload ke gallery!');
    }

    public function destroy($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        Storage::disk('public')->delete($photo->foto);
        $photo->delete();
        return back()->with('success', 'Berhasil hapus foto!');
    }
}
