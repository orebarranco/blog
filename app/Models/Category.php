<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Para que Laravel no tome la informacion del id para mostrar la categoría, sino el slug.
    public function getRouteKeyName()
    {
        return "slug";
    }

    // Relación 1:M
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
