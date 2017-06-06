<?php

namespace Sandbox\Traits;

use Sandbox\Helpers\Marshal;

trait DispatchFrom
{
    protected function dispatchFrom($job, $source, $extras = [])
    {
        return dispatch(Marshal::dispatchFrom($job, $source, $extras));
    }
}
