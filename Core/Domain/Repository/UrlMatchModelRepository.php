<?php

namespace Core\Domain\Repository;

use Core\Domain\Manager\UrlMatchModelManager;
use Core\Domain\Entity\UrlMatchModel;

/**
 * Class UrlMatchModelRepository
 */
class UrlMatchModelRepository
{
    /**
     * @var UrlMatchModelManager
     */
    private $urlMatchModelManager;

    /**
     * @param UrlMatchModelManager $urlMatchModelManager
     */
    public function __construct(UrlMatchModelManager $urlMatchModelManager)
    {
        $this->urlMatchModelManager = $urlMatchModelManager;
    }

    /**
     * @param string $longUrl
     *
     * @return UrlMatchModel
     */
    public function findFromLongUrl($longUrl)
    {
        $result = $this->urlMatchModelManager->findOne("SELECT * FROM url_match WHERE long_url = '" . $longUrl . "' LIMIT 1");

        return $result;
    }

    /**
     * @param UrlMatchModel $model
     */
    public function saveMatchedUrl($model)
    {
        $this->urlMatchModelManager->save("INSERT INTO url_match SET short_url = '".$model->getShortUrl()."', long_url = '".$model->getLongUrl()."'");
    }
}
