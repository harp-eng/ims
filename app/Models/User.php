<?php

namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Models\Traits\HasHashedMediaTrait;
use App\Models\TaskEfficiency;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Modules\Order\Models\Address;
use Modules\TimeSheet\Models\TimeSheet;
use Modules\Order\Models\Order;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory;
    use HasHashedMediaTrait;
    use HasRoles;
    use Notifiable;
    use SoftDeletes;
    use UserPresenter;
    use HasApiTokens;

    protected $guarded = ['id', 'updated_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

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
            'date_of_birth' => 'datetime',
            'last_login' => 'datetime',
            'deleted_at' => 'datetime',
            'social_profiles' => 'array',
        ];
    }

    /**
     * Boot the model.
     *
     * Register the model's event listeners.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = Auth::id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on saving
        static::saving(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = Auth::id();
            $table->save();
        });
    }

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany('App\Models\UserProvider');
    }

    /**
     * Retrieve the providers associated with the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'CustomerID', 'id');
    }

    /**
     * Get the list of users related to the current User.
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    // Define the relationship to shippingAddress
    public function shippingAddress()
    {
        return $this->hasOne(Address::class, 'EntityID', 'id')
                    ->where('EntityType', 'Customer')
                    ->where('AddressType', 'Shipping');
    }

    // Define the relationship to billingAddress
    public function billingAddress()
    {
        return $this->hasOne(Address::class, 'EntityID', 'id')
                    ->where('EntityType', 'Customer')
                    ->where('AddressType', 'Billing');
    }

    public function taskEfficiencies()
    {
        return $this->hasMany(TaskEfficiency::class);
    }

    // Define the relationship to billingAddress
    public function addresses()
    {
        return $this->hasMany(Address::class, 'EntityID', 'id')
                    ->where('EntityType', 'Customer');
    }

    public function todayTimeSheet()
    {
        return $this->hasOne(TimeSheet::class, 'employee_id', 'id')
            ->whereDate('date', now());
    }

    // Other model properties and methods

    /**
     * Get the records created by the user.
     */
    public function createdRecords()
    {
        return $this->hasMany(BaseModel::class, 'created_by');
    }

    /**
     * Get the records last updated by the user.
     */
    public function updatedRecords()
    {
        return $this->hasMany(BaseModel::class, 'updated_by');
    }

    /**
     * Get the records deleted by the user.
     */
    public function deletedRecords()
    {
        return $this->hasMany(BaseModel::class, 'deleted_by');
    }
}
