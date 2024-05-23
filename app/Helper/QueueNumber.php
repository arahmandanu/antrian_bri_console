<?php

namespace App\Helper;

trait QueueNumber
{
    public const MAX_QUEUE = 3;

    public function formatQueue($que)
    {
        if (strlen($que) == self::MAX_QUEUE) return $que;

        return $this->formatQueue('0' . $que);
    }
}
