<?php

namespace uGovernUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpFoundation\Response;

class uGovernUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
