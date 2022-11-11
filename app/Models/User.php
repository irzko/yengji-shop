<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'permissionLevel'];

    public static function validate(array $data) {
        $errors = [];

        if (! $data['email']) {
            $errors['email'] = 'Email không hợp lệ.';
        } elseif (static::where('email', $data['email'])->count() > 0) {
            $errors['email'] = 'Email này đã được sử dụng.';
        }    

        if (strlen($data['password']) < 6) {
            $errors['password'] = 'Mật khẩu phải chứa ít nhất 6 kí tự.';
        } elseif ($data['password'] != $data['password_confirmation']) {
            $errors['password'] = 'Mật khẩu nhập lại không trùng khớp.';
        }
        
        return $errors;
    }
    public function carts()
    {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    } 
}
