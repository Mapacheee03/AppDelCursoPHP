<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Mostrar lista de productos
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');
        $status = $request->input('status');

        $products = Product::with('category')
            ->search($search)
            ->filterByCategory($categoryId)
            ->filterByStatus($status)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::where('is_active', true)->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Mostrar productos eliminados (papelera de reciclaje)
     */
    public function trashed()
    {
        $products = Product::onlyTrashed()
            ->with('category')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('products.trashed', compact('products'));
    }

    /**
     * Mostrar formulario para crear producto
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_active' => $request->has('is_active'),
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar detalles de un producto
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    /**
     * Mostrar formulario para editar producto
     */
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_active' => $request->has('is_active'),
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar producto (soft delete)
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto movido a la papelera de reciclaje.');
    }

    /**
     * Restaurar producto eliminado
     */
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('products.trashed')
            ->with('success', 'Producto restaurado exitosamente.');
    }

    /**
     * Eliminar permanentemente
     */
    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->forceDelete();

        return redirect()->route('products.trashed')
            ->with('success', 'Producto eliminado permanentemente.');
    }

    /**
     * API: Listar productos
     */
    public function apiIndex(Request $request)
    {
        $products = Product::with('category')
            ->active()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $products,
            'count' => $products->count()
        ]);
    }

    /**
     * API: Mostrar producto específico
     */
    public function apiShow($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'error' => 'Producto no encontrado'
            ], 404);
        }

        return response()->json([
            'data' => $product
        ]);
    }
}
