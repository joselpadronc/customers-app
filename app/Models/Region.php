<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_reg
 * @property string $description
 * @property string $status
 */
class Region extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_reg';

    /**
     * @var array
     */
    protected $fillable = ['description', 'status'];

    protected $casts = [
        'status' => Status::class,
    ];
}

enum Status: string
{
    case Active = 'A';
    case Inactive = 'I';
    case Trash = 'trash';
}
