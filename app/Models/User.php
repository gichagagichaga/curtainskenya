<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable
{
    public const ROLE_SUPER_ADMIN = 'super_admin';

    public const ROLE_ORDERS_MANAGER = 'orders_manager';

    public const ROLE_CUSTOMER_SERVICE = 'customer_service';

    public const ROLE_CATALOGUE_MANAGER = 'catalogue_manager';

    public const ROLE_CONTENT_MANAGER = 'content_manager';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        $initials = Str::initials($this->name, true);

        return Str::length($initials) > 1
            ? Str::substr($initials, 0, 1).Str::substr($initials, -1)
            : $initials;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    /** @return array<string, string> */
    public static function roleOptions(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => 'Super Admin',
            self::ROLE_ORDERS_MANAGER => 'Orders Manager',
            self::ROLE_CUSTOMER_SERVICE => 'Customer Service',
            self::ROLE_CATALOGUE_MANAGER => 'Catalogue Manager',
            self::ROLE_CONTENT_MANAGER => 'Content Manager',
        ];
    }

    public function hasRole(string $role): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN || $this->role === $role;
    }

    /** @param array<int, string> $roles */
    public function hasAnyRole(array $roles): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN || in_array($this->role, $roles, true);
    }
}
