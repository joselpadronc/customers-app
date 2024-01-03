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

    /**
     * @var array
     */
    protected $fillable = ['id_com', 'id_reg', 'email', 'name', 'last_name', 'address', 'date_reg', 'status'];

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
