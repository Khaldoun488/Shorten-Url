<?php

namespace Core\Domain\Manager;

use Core\Domain\DB\DBManager;
use Core\Domain\Entity\UrlMatchModel;

/**
 * Class UrlMatchModelManager
 */
class UrlMatchModelManager extends DBManager
{
    /**
     * {@inheritdoc}
     */
    public function findOne($query)
    {
        $result = parent::findOne($query);

        if ($result && is_array($result)) {
            $model = new UrlMatchModel();
            $model->setLongUrl($result['long_url']);
            $model->setShortUrl($result['short_url']);

            return $model;
        } else {
            return null;
        }
    }
}
