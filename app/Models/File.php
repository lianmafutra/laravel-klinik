<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'date:d-m-Y H:i:s',
        'updated_at' => 'date:d-m-Y H:i:s',
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
       $file = $this;
        if ($file->name_hash) {
            $file = url(Storage::url($file->path . $file->name_hash));
        } else {
            $file = asset('img/avatar2.png');
        }
        return  $file;
    }
}
