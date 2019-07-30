<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   	// Validación
	public static $messages = [
		'name.required' => 'Es necesario ingresar un nombre para la categoría.',
		'name.max' => 'El nombre de la categoría no debe de exceder 50 caracteres.',     		
		'description.max' => 'La descripción corta solo admite hasta 250 caracteres.',    		
	];
	public static $rules = [
		'name' => 'required|max:50',   		
		'description' => 'max:250',
	];

	protected $fillable = ['name', 'description'];

    // $category->products
    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
    	$featuredProduct = $this->products()->first();
    	return $featuredProduct->featured_image_url;
    }
}
