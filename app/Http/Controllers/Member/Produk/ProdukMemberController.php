<?php

namespace App\Http\Controllers\Member\Produk;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\BidangPerusahaan; // Gunakan model BidangPerusahaan untuk sub_kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Quotation;

class ProdukMemberController extends Controller
{
    public function index(Request $request, $categoryId = null)
    {
        // Debugging: Cek apakah parameter sort masuk
        \Log::info('Sort parameter:', ['sort' => $request->input('sort')]);

        $kategori = Kategori::all();
        $sort = $request->input('sort', 'desc'); // Default ke 'desc'

        if ($categoryId) {
            $produks = Produk::where('kategori_id', $categoryId)
                ->orderBy('created_at', $sort)
                ->paginate(9);
            $selectedCategory = Kategori::find($categoryId);
        } else {
            $produks = Produk::orderBy('created_at', $sort)->paginate(6);
            $selectedCategory = null;
        }

        // Ambil semua bidang perusahaan (subkategori) untuk ditampilkan di view
        $bidangPerusahaan = BidangPerusahaan::all();

        return view('Member.Product.product', compact('produks', 'kategori', 'bidangPerusahaan', 'selectedCategory', 'sort'));
    }

    public function filterByCategory(Request $request, $id)
    {
        $kategori = Kategori::all();
        $sort = $request->input('sort', 'desc');

        $produks = Produk::where('kategori_id', $id)
            ->orderBy('created_at', $sort)
            ->paginate(9);

        $selectedCategory = Kategori::find($id);
        
        // Ambil bidang perusahaan (subkategori) berdasarkan kategori yang dipilih
        $bidangPerusahaan = BidangPerusahaan::where('kategori_id', $id)->get();

        return view('Member.Product.product', compact('produks', 'kategori', 'bidangPerusahaan', 'selectedCategory', 'sort'));
    }


    public function search(Request $request)
    {
        $kategori = Kategori::all();
        $keyword = $request->keyword;

        // Ganti get() dengan paginate(9)
        $produks = Produk::where('nama', 'LIKE', '%' . $keyword . '%')->paginate(9);

        $selectedCategory = null;
        
        // Ambil semua bidang perusahaan (subkategori)
        $bidangPerusahaan = BidangPerusahaan::all();

        return view('Member.Product.product', compact('produks', 'kategori', 'bidangPerusahaan', 'selectedCategory'));
    }
    
    public function show($id)
    {
        // Mengambil detail produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        $produkSerupa = Produk::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $id) // Exclude the current product
            ->take(4) // Limit to 4 similar products
            ->get();

        return view('Member.Product.detail', compact('produk', 'produkSerupa'));
    }
    
    public function addToQuotation(Request $request, $id)
    {
        // Find the product by ID using the Produk model
        $produk = Produk::find($id);

        if (!$produk) {
            // Redirect back with an error message if the product doesn't exist
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Get the authenticated user
        $user = auth()->user();

        // Validate the quantity input with a default message if missing
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ], [
            'quantity.required' => 'Kuantitas produk harus diisi.',
            'quantity.integer' => 'Kuantitas produk harus berupa angka.',
            'quantity.min' => 'Kuantitas produk minimal 1.'
        ]);

        // Get the quantity from the request, default to 1 if not provided
        $quantity = $request->input('quantity', 1);

        // Check if a quotation already exists for this user and product
        $existingQuotation = Quotation::where('user_id', $user->id)
            ->where('produk_id', $id)
            ->first();

        if ($existingQuotation) {
            // If the product is already in the quotation list, increment the quantity
            $existingQuotation->increment('quantity', $quantity);
        } else {
            // If no existing quotation, create a new one
            Quotation::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'quantity' => $quantity,
                'status' => 'pending', // Set a default status for the quotation
            ]);
        }

        // Redirect to the request-quotation page with a success message
        return redirect()->route('distribution.request-quotation')->with('success', 'Produk berhasil ditambahkan ke permintaan quotation.');
    }
}