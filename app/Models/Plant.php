<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{

    // что ключ строкового типа
    protected $keyType = 'string';
    
    // Отключаем автоинкремент
    public $incrementing = false;

    /** @use HasFactory<\Database\Factories\PlantFactory> */
    use HasFactory;
    protected $fillable = [
        'description',
        'image_paths',
        'varieties_id',
        'price',
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

    public function variety()
    {
        return $this->belongsTo(Variety::class, 'varieties_id');
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
