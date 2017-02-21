<?php

namespace P3\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class P3UserBundle extends Bundle
{
    public function getParent()
  {
    return 'FOSUserBundle';
  }
}