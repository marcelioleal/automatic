<?php
namespace Util;

class Exception extends \Exception
{
    public static function duplicatedMail($email)
    {
        return new self("This e-mail ($email) is already registered!");
    }
    
    public static function userNotFound()
    {
        return new self(Message::get("USER", "NOT_FOUND"));
    }
    
    public static function mismatchPassword()
    {
        return new self(Message::get("USER", "PASSWORD_MISMATCH"));
    }
    
    public static function invalidPath($path)
    {
        return new self("Can't create directory $path !");
    }
    
    public static function fileNotFound($filename)
    {
        return new self("The file $filename was not found!");
    }
}