<?php

namespace App\Models;

use App\Utils\LmFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\ResponseCache\Facades\ResponseCache;
use Storage;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;
    use HasRoles;
    use LmFileTrait;

    
   //  use \OwenIt\Auditing\Auditable;
  
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

   //  public function transformAudit(array $data): array
   //  {
   //      return (new CustomAudit())->initData($data);
   //  }

    protected $casts = [
        'created_at' => 'date:d-m-Y H:i:s',
        'updated_at' => 'date:d-m-Y H:i:s',
        'last_login_at' => 'date:d/m/Y H:i:s',
    ];

    protected $appends = [
        'role',
    ];

    public function scopeFilter($query)
    {
        return $query->whereDate('created_at', \Carbon\Carbon::today());
    }

    public static function boot()
    {
        parent::boot();
        self::created(function () {
            ResponseCache::forget(route('master-user.index'));
        });

        self::updated(function () {
            ResponseCache::forget(route('master-user.index'));
        });

        self::deleted(function () {
            ResponseCache::forget(route('master-user.index'));
        });
    }

    public function getRoleName()
    {
        return implode(',', $this->getRoleNames()->toArray());
    }

    public function getRoleAttribute()
    {
        return implode(',', $this->getRoleNames()->toArray());
    }

    public function file_foto()
    {
        return $this->hasOne(File::class, 'file_id', 'foto')->withDefault();
    }

    public function checkPassword($password)
    {
        if (Hash::check($password, auth()->user()->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUrlFoto()
    {

        $file = User::where('id', $this->attributes['id'])->with('file_foto')->whereHas('file_foto')->first()?->file_foto;
        if ($file) {
            return Storage::url($file->path.'/'.$file->name_random);
        } else {
            return asset('img/avatar2.png');
        }
    }



    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class);
    }

    
    public function pemeriksaan(): HasOne
    {
        return $this->hasOne(Pemeriksaan::class,'user_id','id');
    }
}
