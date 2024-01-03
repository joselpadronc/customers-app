<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $dni
 * @property integer $id_reg
 * @property integer $id_com
 * @property string $email
 * @property string $name
 * @property string $last_name
 * @property string $address
 * @property string $date_reg
 * @property string $status
 */
class Customer extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'dni';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['dni', 'id_com', 'id_reg', 'email', 'name', 'last_name', 'address', 'date_reg', 'status'];

    public function commune()
    {
        return $this->hasOne("App\Models\Commune", 'id_com', 'id_com');
    }

    public function region()
    {
        return $this->hasOne("App\Models\Region", 'id_reg', 'id_reg');
    }
}
