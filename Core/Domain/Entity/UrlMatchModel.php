<?php

namespace Core\Domain\Entity;

/**
 * Class UrlMatchModel
 */
class UrlMatchModel
{
    /**
     * @var string
     */
    private $longUrl;

    /**
     * @var string
     */
    private $shortUrl;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getLongUrl()
    {
        return $this->longUrl;
    }

    /**
     * @param string $url
     *
     * @return UrlMatchModel
     */
    public function setLongUrl($url)
    {
        $this->longUrl = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }

    /**
     * @param string $shortUrl
     *
     * @return UrlMatchModel
     */
    public function setShortUrl($shortUrl)
    {
        $this->shortUrl = $shortUrl;

        return $this;
    }
}
