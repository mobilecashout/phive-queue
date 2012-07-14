<?php

namespace Phive\Queue;

abstract class AbstractQueue implements QueueInterface
{
    /**
     * @param \DateTime|string|int|null $eta
     *
     * @return \DateTime
     *
     * @throws \InvalidArgumentException
     */
    protected function normalizeEta($eta)
    {
        if (is_string($eta)) {
            $eta = new \DateTime($eta);
        }
        if ($eta instanceof \DateTime) {
            return $eta->getTimestamp();
        }
        if (is_numeric($eta)) {
            return $eta;
        }

        throw new \InvalidArgumentException('Parameter eta must be a string, integer or \DateTime instance.');
    }

    /**
     * @param int $limit
     * @param int $skip
     *
     * @throws \OutOfRangeException
     */
    protected function assertLimit($limit, $skip)
    {
        if ($limit <= 0 && -1 != $limit) {
            throw new \OutOfRangeException('Parameter limit must either be -1 or a value greater than 0.');
        }
        if ($skip < 0) {
            throw new \OutOfRangeException('Parameter skip must be greater than or equal 0.');
        }
    }
}
