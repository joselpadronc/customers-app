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
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['description', 'status'];
}
