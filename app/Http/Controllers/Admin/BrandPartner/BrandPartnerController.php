<?php

namespace App\Http\Controllers\Admin\BrandPartner;

use App\Http\Controllers\Controller;
use App\Models\BrandPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandPartners = BrandPartner::all();
        return view('Admin.Brand.index', compact('brandPartners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gambar' => 'required|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');

            // Generate nama file unik menggunakan SHA256
            $hash = hash('sha256', time() . $image->getClientOriginalName());
            $imageName = $hash . '.' . $image->getClientOriginalExtension();

            // Simpan ke dalam storage (public/uploads/brand)
            $path = $image->storeAs('uploads/brand', $imageName, 'public');
            $validated['gambar'] = $path;
        }

        BrandPartner::create($validated);

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.show', compact('brandPartner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);
        return view('Admin.Brand.edit', compact('brandPartner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $brandPartner = BrandPartner::findOrFail($id);

        $validated = $request->validate([
            'gambar' => 'nullable|image|max:2048',
            'type' => 'required|in:brand,partner,principal',
            'url' => 'nullable|string',
            'nama' => 'nullable|string',
        ]);

        // Jika ada gambar baru, hapus gambar lama dan simpan yang baru
        if ($request->hasFile('gambar')) {
            if ($brandPartner->gambar) {
                Storage::disk('public')->delete($brandPartner->gambar);
            }

            $image = $request->file('gambar');
            $hash = hash('sha256', time() . $image->getClientOriginalName());
            $imageName = $hash . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/brand', $imageName, 'public');

            $validated['gambar'] = $path;
        } else {
            $validated['gambar'] = $brandPartner->gambar;
        }

        $brandPartner->update($validated);

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brandPartner = BrandPartner::findOrFail($id);

        if ($brandPartner->gambar) {
            Storage::disk('public')->delete($brandPartner->gambar);
        }

        $brandPartner->delete();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Partner berhasil dihapus.');
    }
}
