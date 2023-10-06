<?php
/**
 * Created by PhpStorm.
 * User: nvanhaezebrouck
 * Date: 06/11/2017
 * Time: 17:42
 */

namespace OxygenzSAS\Container;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends ContainerException implements NotFoundExceptionInterface
{

}