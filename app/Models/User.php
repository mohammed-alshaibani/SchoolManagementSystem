<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar; // <-- add
use Filament\Models\Contracts\HasName;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;





class User extends Authenticatable implements FilamentUser, HasAvatar
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * Determine if the user can access the Filament admin panel.
     *
     * @param  \Filament\Panel  $panel
     * @return bool
     */
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Allow all users to access the panel; adjust logic as needed.
        return $this->hasAnyRole(['Admin', 'Editor']); //|| $this->email === 'Osama_Shujaa_aldeen@hotmail.com';
        // return $this->email === 'osama_shujaa_aldeen@hotmail.com';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username', 'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
 public function getFilamentAvatarUrl(): ?string
    {
        // If a full URL is already stored, just return it.
        // if (is_string($this->avatar) && str_starts_with($this->avatar, ['http://', 'https://', '//'])) {
        //     return $this->avatar;
        // }


        // Prefer public disk. If file exists there, build URL.
        if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
            return Storage::disk('public')->url($this->avatar);
        }


        // If using a private/local disk by mistake, try generating a temporary URL.
        // if ($this->avatar && Storage::disk('local')->exists($this->avatar)) {
        //     // why: provides a short-lived URL so the menu can render the image
        //     return Storage::disk('local')->temporaryUrl($this->avatar, now()->addMinutes(5));
        // }


        // Fallback to Gravatar
        $hash = md5(strtolower(trim((string) $this->email)));
        return "https://www.gravatar.com/avatar/{$hash}?s=160&d=mp";
    }
    public function getFilamentName(): string
        {
            return $this->username ?: ($this->name ?: (string) str($this->email)->before('@'));
        }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_user')->withTimestamps();
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isEditor(): bool
    {
        return $this->hasRole('editor');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user')->withTimestamps();
    }

}
