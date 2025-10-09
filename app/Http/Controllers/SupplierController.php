<?php

namespace App\Http\Controllers;

//import return type view
use Illuminate\View\View;

use App\Models\Supplier;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index(): View
    {
        $suppliers = Supplier::orderBy('id', 'DESC')->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

 /**
     * create
     * 
     * @return void
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

 /**
     * create
     * 
     * @return void
     */
    public function edit($id): View
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus!');
    }
}
