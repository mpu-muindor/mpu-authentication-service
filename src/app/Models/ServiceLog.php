<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $service_id
 * @property string $remote_address
 * @property string $request_target
 * @property string $token
 * @property boolean $result
 * @property array $params
 * @property string $created_at
 * @property string $updated_at
 * @property Service $service
 */
class ServiceLog extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'remote_address', 'request_target', 'token', 'result', 'params'];

    protected $casts = [
        'params' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Service::class);
    }
}
