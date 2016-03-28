<?php

namespace PHoogkamer\CloudSearchWrapper;

use Exception;

/**
 * Class CloudSearchResult
 *
 * @package PHoogkamer\CloudSearchWrapper
 */
class CloudSearchResult
{

    /**
     * @var int
     */
    private $amountOfHits;

    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $time;

    /**
     * @var array
     */
    private $hits;

    /**
     * @var array
     */
    private $facets;

    /**
     * @var string
     */
    private $cursor;

    /**
     * @param      $amountOfHits
     * @param      $start
     * @param      $time
     * @param      $facets
     * @param string $cursor
     */
    public function __construct($amountOfHits, $start, $time, $facets, $cursor = null)
    {
        $this->amountOfHits = $amountOfHits;
        $this->start        = $start;
        $this->time         = $time;
        $this->facets       = $facets;
        $this->cursor       = $cursor;
    }

    /**
     * @return int
     */
    public function getAmountOfHits()
    {
        return $this->amountOfHits;
    }

    /**
     * @return array
     */
    public function getFacets()
    {
        return $this->facets;
    }

    /**
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return array
     */
    public function getHits()
    {
        return $this->hits;
    }

    public function getNextCursor()
    {
        return $this->cursor;
    }

    /**
     * @param array $hits
     * @param       $resultDocumentClass
     * @throws \Exception
     */
    public function fillWithHits(array $hits, $resultDocumentClass)
    {
        $this->hits = array();

        foreach ($hits as $hit) {
            /* @var $document CloudSearchDocumentInterface */
            $document = new $resultDocumentClass();

            if ( ! ($document instanceof CloudSearchDocumentInterface)) {
                throw new Exception($resultDocumentClass . ' must implement CloudSearchDocumentInterface');
            }

            $document->fillWithHit($hit);

            $this->hits[] = $document;
        }
    }
}