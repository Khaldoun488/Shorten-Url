<?php

namespace Core\Domain\DB;

/**
 * Interface DBManagerInterface
 */
interface DBManagerInterface
{
    public function save($query);

    public function findOne($query);
}
