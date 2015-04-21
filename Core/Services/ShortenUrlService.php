<?php

namespace Core\Services;

use Core\Domain\Entity\UrlMatchModel;
use Core\Domain\Repository\UrlMatchModelRepository;

use Mremi\UrlShortener\Model\Link;
use Mremi\UrlShortener\Provider\Bitly\BitlyProvider;
use Mremi\UrlShortener\Provider\Bitly\OAuthClient;

/**
 * Class ShortenUrlService
 */
class ShortenUrlService
{
    /**
     * @var BitlyProvider
     */
    private $bitlyProvider;

    /**
     * @var UrlMatchModelRepository
     */
    private $urlMatchModelRepository;

    /**
     * @param string                  $loginBitly
     * @param string                  $pwdBitly
     * @param UrlMatchModelRepository $urlMatchModelRepository
     */
    public function __construct($loginBitly, $pwdBitly, $urlMatchModelRepository)
    {
        $this->urlMatchModelRepository = $urlMatchModelRepository;

        $this->bitlyProvider = new BitlyProvider(
            new OAuthClient($loginBitly, $pwdBitly),
            array('connect_timeout' => 1, 'timeout' => 1)
        );
    }

    /**
     * @param string $longUrl
     *
     * @return string
     */
    public function shorten($longUrl)
    {
        $model = $this->urlMatchModelRepository->findFromLongUrl($longUrl);

        if ($model!== null && $model->getShortUrl() !== null) {
            return $model->getShortUrl();
        } else {
            $shortUrl = $this->getShortenFromAPI($longUrl);

            if ($shortUrl) {
                $this->cacheResult($shortUrl, $longUrl);

                return $shortUrl;
            } else {
                return null;
            }
        }
    }

    /**
     * @param string $shortUrl
     * @param string $longUrl
     */
    private function cacheResult($shortUrl, $longUrl)
    {
        $model = new UrlMatchModel();
        $model->setLongUrl($longUrl);
        $model->setShortUrl($shortUrl);

        $this->urlMatchModelRepository->saveMatchedUrl($model);
    }

    /**
     * @param string $longUrl
     *
     * @return string
     */
    private function getShortenFromAPI($longUrl)
    {
        $link = new Link();
        $link->setLongUrl($longUrl);

        $this->bitlyProvider->shorten($link);

        return ($link !== null) ? $link->getShortUrl() : null;
    }
}
