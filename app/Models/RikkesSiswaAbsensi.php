<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RikkesSiswaAbsensi extends Model
{
    use HasFactory;
    protected $table = 'rikkes_siswa_absensi';
    protected $guarded = [];
 
    protected $casts = [
       'created_at' => 'datetime:d-m-Y  H:i:s',
       'updated_at' => 'datetime:d-m-Y  H:i:s',
    ];

    /**
     * Get the rikkes_jadwal that owns the RikkesSiswaAbsensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(RikkesSiswaJadwal::class, 'rikkes_siswa_jadwal_id', 'id');
    }

    /**
     * Get the user that owns the RikkesSiswaAbsensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
