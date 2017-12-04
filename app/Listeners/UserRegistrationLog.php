<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

class UserRegistrationLog
{
  /**
   * Создание слушателя события.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Обработка события.
   *
   * @param  Registered  $event
   * @return void
   */
  public function handle(Registered $event)
  {
      Log::info('UserName:'.$event->user->name.' registration: '.$event->user->created_at); 
  }
}