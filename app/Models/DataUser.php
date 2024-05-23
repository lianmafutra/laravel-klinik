<?php

namespace App\Models;

use App\Utils\LmFileTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataUser extends Model
{
    use HasFactory;

    use LmFileTrait;

    protected $table = 'users';

    protected $guarded = [];

    protected $hidden = ['id'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y  H:i:s',
    ];

    public function file_foto_r(): HasOne
    {
        return $this->hasOne(File::class, 'file_id', 'file_foto');
    }
}
