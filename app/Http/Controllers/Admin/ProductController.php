<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(10);
    	return view('admin.products.index')->with(compact('products'));		// Listado
    }

    public function create()
    {
 		return view('admin.products.create');		// Formulario de registro	
    }

    public function store(Request $request)
    {
    	// Validación
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre para el producto.',
    		'name.max' => 'El nombre del producto no debe de exceder 8 caracteres.',
    		'price.required' => 'Es obligatorio definir un precio para el producto.',
    		'price.numeric' => 'Ingrese un precio valido',
    		'price.min' => 'No se admiten valores negativos',
    		'description.required' => 'La descripción corta es un campo obligatorio.',
    		'description.max' => 'La descripción corta solo admite hasta 50 caracteres.',    		
    	];
    	$rules = [
    		'name' => 'required|max:8',    		
    		'price' => 'required|numeric|min:0',
    		'description' => 'required|max:50',
    	];
    	$this->validate($request, $rules, $messages);

		// Registrar el nuevo producto en la db
		//dd($request->all()); // Metodo para imprimir registro
		$product = new Product();
		$product->name = $request->input('name');
		$product->description = $request->input('description');
		$product->price = $request->input('price');
		$product->long_description = $request->input('long_description');
		$product->save(); // INSERT

		return redirect('admin/products');
    }

    public function edit($id)
    {
    	//return "Mostrar aqui el form de edición para el producto con el $id";  // Metodo para imprimir registro para editar
    	$product = product::find($id);
 		return view('admin.products.edit')->with(compact('product'));		// Formulario de edición	
    }

    public function update(Request $request, $id)
    {
    	// Validación
    	$messages = [
    		'name.required' => 'Es necesario ingresar un nombre para el producto.',
    		'name.max' => 'El nombre del producto no debe de exceder 8 caracteres.',
    		'price.required' => 'Es obligatorio definir un precio para el producto.',
    		'price.numeric' => 'Ingrese un precio valido',
    		'price.min' => 'No se admiten valores negativos',
    		'description.required' => 'La descripción corta es un campo obligatorio.',
    		'description.max' => 'La descripción corta solo admite hasta 50 caracteres.',    		
    	];
    	$rules = [
    		'name' => 'required|max:8',    		
    		'price' => 'required|numeric|min:0',
    		'description' => 'required|max:50',
    	];
    	$this->validate($request, $rules, $messages);
		// Registrar el nuevo producto en la db
		//dd($request->all()); // Metodo para imprimir registro
		$product = Product::find($id);
		$product->name = $request->input('name');
		$product->description = $request->input('description');
		$product->price = $request->input('price');
		$product->long_description = $request->input('long_description');
		$product->save(); // UPDATE

		return redirect('admin/products');
    }

    public function destroy($id)
    {
		$product = Product::find($id);
		$product->delete(); // DELETE

		return back();
    }
}
