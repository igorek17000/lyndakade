<?php

namespace App;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Models\Role;

// use Illuminate\Support\Facades\Auth;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstName', 'lastName', 'username', 'avatar', 'mobile', 'email', 'google_id',
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $with = ['carts', 'demands', 'paids', 'payments'];

    /**
     * A user can have many messages
     *
     * @return HasMany
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * A user can have many messages
     *
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * A user can have many demands
     *
     * @return HasMany
     */
    public function demands()
    {
        return $this->hasMany(Demand::class);
    }

    /**
     * A user can have many bookmarks
     *
     * @return HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * A admin created many courses
     *
     * @return HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * A user can have many paids
     *
     * @return HasMany
     */
    public function paids()
    {
        return $this->hasMany(Paid::class)->latest();
    }

    /**
     * A user can have many payments
     *
     * @return HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * A user can have many activities
     *
     * @return HasMany
     */
    public function userActivities()
    {
        return $this->hasMany(UserActivity::class);
    }

    public function isAdmin()
    {
        return $this->role->id == Role::all()->where('name', 'admin')->first()->id;
    }

    // public function getUrlAttribute()
    // {
    //     $courses = Course::with('user')->latest()->paginate(10);
    //     return view('home', compact('courses'));
    // }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
        // return $this->fillable;
    }

    // public function sendEmailVerificationNotification()
    // {
    // //     $this->notify(new VerifyEmailNotification());
    // //     // $this->notify(new VerifyEmail());
    // //     //        $this->notify(new VerifyEmailNotification());
    // //     //        $current_user = Auth::user();
    // //     //        $sid    = getenv("TWILIO_ACCOUNT_SID");
    // //     //        $token  = getenv("TWILIO_AUTH_TOKEN");
    // //     //        $twilio = new Client($sid, $token);
    // //     //
    // //     //        $verification = $twilio->verify->v2->services(getenv("TWILIO_VERIFY_SID"))
    // //     //            ->verifications
    // //     //            ->create($current_user->email, "email");
    // }
}
