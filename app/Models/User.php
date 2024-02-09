<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\HasUuid;
// use Laravel\Sanctum\HasApiTokens;
use App\Models\Traits\User\UserTraits;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @OA\Schema(
 *  title="User",
 *  description="User model NB: (only mentor are allowed to add there bio & occupation fields, because bio, occupation won't be returned to student)",
 *  @OA\Xml(
 *    name="user",
 *  )
 * )
*/
class User extends Authenticatable implements JWTSubject 
{
    use /*HasApiTokens,*/ HasFactory, Notifiable, HasUuid, UserTraits;

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     *  @OA\Property(
     *    title="Full Name",
     *    description="Full Name of the User",
     *    format="string",
     *    example="Gift Owens"
     *  )
    */
    private $fullname;


    /**
     *  @OA\Property(
     *    title="Email",
     *    description="Email of the User",
     *    format="string",
     *    example="giftowens@example.com"
     *  )
    */
    private $email;


    /**
     *  @OA\Property(
     *    title="Password",
     *    description="Password of the User",
     *    format="string",
     *    example="secret"
     *  )
    */
    private $password;


    /**
     *  @OA\Property(
     *    title="Role",
     *    description="Role of the User",
     *    format="string",
     *    example="mentee",
     *    enum={"mentor", "mentee"}
     *  )
    */
    private $role;


    /**
     *  @OA\Property(
     *    title="Address",
     *    description="Address of the User",
     *    format="string",
     *    example="10a avenue Street"
     *  )
    */
    private $address;


    /**
     *  @OA\Property(
     *    title="City",
     *    description="City of the User",
     *    format="string",
     *    example="ikeja"
     *  )
    */
    private $city;


    /**
     *  @OA\Property(
     *    title="State",
     *    description="State of the User",
     *    format="string",
     *    example="lagos"
     *  )
    */
    private $state;


    /**
     *  @OA\Property(
     *    title="Zip",
     *    description="Zip code of the User",
     *    format="number",
     *    example="100001"
     *  )
    */
    private $zip;


    /**
     *  @OA\Property(
     *    title="Country",
     *    description="Country of the User",
     *    format="string",
     *    example="Nigeria"
     *  )
    */
    private $country;


    /**
     *  @OA\Property(
     *    title="Avatar",
     *    description="Avatar of the User",
     *    format="string",
     *    example="https://res.cloudinary.com/dbx3dhfkt/image/upload/v1672045944/estudy/pictures/image-5a9482cd3-a97e-4627-dbc3-9cb53797e40a.png"
     *  )
    */
    private $avatar;


    
    /**
     *  @OA\Property(
     *    title="Occupation",
     *    description="Occupation",
     *    example="Web Developer & online intructor"
     *  )
    */
    private $occupation;

    /**
     *  @OA\Property(
     *    title="Bio",
     *    description="Bio of the User",
     *    format="string",
     *    example="I'm Gift Owens founder of GON learning"
     *  )
    */
    private $bio;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'role',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'avatar',
        'bio',
        'occupation',
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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
