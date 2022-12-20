<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Package;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    public function packages(): BelongsTo
    {
        return $this->belongsTo(Package::class, 'package_id', 'id')->withTrashed();
    }
}
