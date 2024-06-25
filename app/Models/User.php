<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasRoles, HasApiTokens, Notifiable,InteractsWithMedia;
    protected $guard_name = 'web';
    protected $appends = ['medias','referral_counts'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'mess_id',
        'payment',
        'subscription_starts_at',
        'referral_code',
        'parent_id',
        'is_referred',
        'status',
        'level_type',
        'breakfast',
        'lunch',
        'dinner',
        'reporting_person',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function mess_owner()
    {
        return $this->hasOne(MessOwner::class,'id','mess_id');
    }
    public function customer_menu()
    {
        return $this->hasOne(CustomerMenu::class)->latest();
    }
    public function payments()
    {
        return $this->hasOne(Payment::class);
    }
    public function reporting_user()
    {
        return $this->hasOne(User::class,'id','reporting_person');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    protected function getMediasAttribute()
    {
        $media = $this->getMedia("USER_IMAGE")->first();
        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }

    public function locationPreferences(){
        return $this->hasMany(UserLocation::class);
    }

    public function assigned_mess(){
        return $this->hasOne(MessOwner::class,'id','mess_id');
    }

    public function getReferralCountsAttribute(){
        return User::where('parent_id',$this->id)->count();
    }
}
