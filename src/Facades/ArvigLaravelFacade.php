<?php 
namespace Arvig\ArvigLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ArvigLaravelFacade
 * @package Arvig\ArvigLaravel
 */
class ArvigLaravelFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'arvig-laravel';
    }
}