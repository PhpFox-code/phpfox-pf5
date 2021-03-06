<?php
namespace Phpfox\Session;


/**
 * Class SessionManager
 *
 * @package Phpfox\Session
 */
class SessionManager
{
    protected $started = false;

    public function __construct()
    {
        $this->start();
    }

    /**
     * Start session manager
     *
     * @see session_start
     *
     * @return bool
     */
    public function start()
    {
        if ($this->started) {
            return false;
        }

        $this->started = true;

        if (session_id()) {
            return false;
        }

        \Phpfox::get('session.save_handler')->register();

        @session_start();

        return true;
    }

    /**
     * @see session_destroy
     */
    public function destroy()
    {
        if (session_id()) {
            session_destroy();
        }
    }

    /**
     * call session_commit
     *
     * @see session_commit
     */
    public function close()
    {
        if (session_id()) {
            session_commit();
        }
    }

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function remember()
    {
        // how to implement remember me ?
    }
}