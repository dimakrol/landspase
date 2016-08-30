<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Hash\Hasher as Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

  const USER_TYPE_ADMIN = 1;
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'user';
  
  protected $fillable = [
    'email', 'active', 'password', 'password_confirmation'
  ];
  
  public static $rules = [
    'email' => 'required|email|max:255|unique:user',
    'password' => 'required|min:6|confirmed',
  ];

  public function beforeSave() {
    parent::beforeSave();

    if($this->password) {
      $this->password = (new Hash)->make($this->password);
    }

    unset($this->password_confirmation);
  }

  public function getPublicInfo() {
    return [
      'id' => $this->id,
      'email' => $this->email,
      'fullname' => $this->fullname,
    ];
  }
    
  /**
   * Get the name of the unique identifier for the user.
   *
   * @return string
   */
  public function getAuthIdentifierName()
  {
      return 'id';
  }

  /**
   * Get the unique identifier for the user.
   *
   * @return mixed
   */
  public function getAuthIdentifier()
  {
      return $this->id;
  }

  /**
   * Get the password for the user.
   *
   * @return string
   */
  public function getAuthPassword()
  {
      return $this->password;
  }

  /**
   * Get the token value for the "remember me" session.
   *
   * @return string
   */
  public function getRememberToken()
  {
      return $this->{$this->getRememberTokenName()};
  }

  /**
   * Set the token value for the "remember me" session.
   *
   * @param  string  $value
   * @return void
   */
  public function setRememberToken($value)
  {
      $this->{$this->getRememberTokenName()} = $value;
  }

  public function getFullNameAttribute() {
    return trim(ucwords(strtolower($this->userData->firstname . ' ' . $this->userData->lastname)));
  }

  public function userData()
  {
    return $this->hasOne('App\Models\UserData', 'user_id');
  }

  /**
   * Get the column name for the "remember me" token.
   *
   * @return string
   */
  public function getRememberTokenName()
  {
      return 'remember_token';
  }
  
  public function getEmailForPasswordReset()
  {
    return $this->email;
  }

  public function isActive() {
    return $this->active == 'Y';
  }

  public function isAdmin() {
    return $this->user_type == static::USER_TYPE_ADMIN;
  }

  public function hasAdminAccess() {
    return $this->isActive() && $this->isAdmin();
  }
}
