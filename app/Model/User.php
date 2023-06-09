<?php
namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;
use UploadIMG\UploadImg;

class User extends Model implements IdentityInterface
{
    use HasFactory;
    use UploadIMG;

    public $timestamps = false;
    protected $fillable = [
        'surname',
        'name',
        'patronymic',
        'phone',
        'job_title',
        'email',
        'password',
        'filename'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['email' => $credentials['email'],
            'password' => md5($credentials['password'])])->first();
    }
    public function is_admin(): bool
    {
        if (app()->auth::user()->job_title === 'admin'){return true;}
        else{return false;}
    }
}
