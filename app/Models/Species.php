<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Species extends Model

{
    // что ключ строкового типа
    protected $keyType = 'string';
    
    // Отключаем автоинкремент
    public $incrementing = false;

    /** @use HasFactory<\Database\Factories\SpeciesFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image_paths',
        
    ];

    protected static function boot()
    {
        parent::boot();

        // Генерируем UUID при создании новой записи
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function varieties()
    {
        return $this->hasMany(Variety::class);
    }

    /** Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'image_paths' => 'array',
        ];
    }
}
