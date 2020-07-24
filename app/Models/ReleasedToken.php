<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 */
class ReleasedToken extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'token';
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    /**
     * @var array
     */
    protected $fillable = ['token'];

}
