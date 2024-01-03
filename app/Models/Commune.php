<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_com
 * @property integer $id_reg
 * @property string $description
 * @property string $status
 */
class Commune extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_com';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['id_reg', 'description', 'status'];

    public function region()
    {
        return $this->hasOne(Region::class, 'id_reg', 'id_reg');
    }
}
