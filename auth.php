<?php
namespace Scb\Modules;

class Auth
{
    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance))
        {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function user()
    {
        return app('db')->select()
            ->from('users')
            ->where('id', '=', @$_SESSION['auth'])->execute()->fetch();
    }
    public function is_admin()
    {
        $user = $this->user();
        return $user && $user['role'] == 1;
    }
}
