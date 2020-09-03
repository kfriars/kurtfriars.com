<?php

namespace Tests\Traits;

class MailHogLetterCollection
{
    /** @var int */
    private $total;
    /** @var int */
    private $count;
    /** @var int */
    private $start;
    /** @var array */
    private $items;
    /** @var bool */
    private $debug = false;

    /**
     * MailHogLetters constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->total = $data['total'];
        $this->count = $data['count'];
        $this->start = $data['start'];
        $this->items = $data['items'];

        $this->prepareItemsDates();
        //
    }

    /**
     * Enable debug statements
     *
     * @return self
     */
    public function debug()
    {
        $this->debug = true;

        return $this;
    }

    /**
     * Gets Total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Gets Count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Gets Start
     *
     * @return int
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Gets Items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Prepares items dates - fix string format and wraps it in DateTime object
     */
    private function prepareItemsDates()
    {
        foreach ($this->items as &$item) {
            $this->sanitizeBody($item['Content']['Body']);
            if (! $item['Created'] instanceof \DateTime) {
                $dateStr = preg_replace('|(\.[0-9]+)|', '', $item['Created']);
                $item['Created'] = new \DateTime($dateStr);
            }
        }
    }

    /**
     * Filters items received from given date
     *
     * @param \DateTime $fromDate
     *
     * @return MailHogLetterCollection
     */
    public function filterFromDate(\DateTime $fromDate)
    {
        $result = [];
        foreach ($this->items as $item) {
            if ($item['Created'] >= $fromDate) {
                $result[] = $item;
            }
        }

        return self::createCollectionByItems($result, $this->debug);
    }

    /**
     * Filters items by subject substring
     *
     * @param string $query
     *
     * @return MailHogLetterCollection
     */
    public function filterBySubject($query)
    {
        $result = [];
        foreach ($this->items as $item) {
            if (array_key_exists('Subject', $item['Content']['Headers'])) {
                if ($this->strMatchWithoutParameters($query, $item['Content']['Headers']['Subject'][0])) {
                    $result[] = $item;
                }
            }
        }

        return self::createCollectionByItems($result, $this->debug);
    }

    /**
     * Match all unparameterized words of a string ie) :some_parameter
     */
    private function strMatchWithoutParameters($expected, $actual)
    {
        $tokenized = explode(' ', $expected);
   
        foreach ($tokenized as $token) {
            if (preg_match('|:[a-zA-Z]|', $token)) {
                continue;
            }
   
            if (strpos($actual, $token) === false) {
                return false;
            }
        }
   
        return true;
    }
    /**
     * Filters items by body substring
     *
     * @param string $query
     *
     * @return MailHogLetterCollection
     */
    public function filterByBody($query)
    {
        $result = [];
        foreach ($this->items as $item) {
            $this->sanitizeBody($item['Content']['Body']);
            if (false !== mb_stripos($item['Content']['Body'], $query, 0, 'UTF-8')) {
                $result[] = $item;
            }
        }

        return self::createCollectionByItems($result, $this->debug);
    }

    public function filterByContent($content, $debug = false)
    {
        $this->debug = $debug;
        $result = [];
        foreach ($this->items as $item) {
            // Decode email encoding
            $body = quoted_printable_decode($item['Content']['Body']);

            if ($this->contentMatchesMessageBody($body, $content)) {
                $result[] = $item;
            }
        }

        return self::createCollectionByItems($result, $this->debug);
    }

    /**
     * Creates new filtered collection by fiven items
     *
     * @param array $items
     *
     * @return MailHogLetterCollection
     */
    public static function createCollectionByItems(array $items, $debug = false)
    {
        $collection = new self(
            [
                'total' => count($items),
                'count' => count($items),
                'start' => 0,
                'items' => $items,
            ]
        );

        if ($debug) {
            $collection->debug();
        }

        return $collection;
    }

    private function sanitizeBody(string &$body)
    {
        $body = str_replace("=\r\n", "", $body);
        $body = str_replace("\r\n", "\n", $body);
    }

    private function contentMatchesMessageBody($message, $content)
    {
        // Back to Dom document - verify all h4, p, a and span have same value
        $messageDom = new \DOMDocument();
        $messageDom->loadHTML($message);
        
        $contentDom = new \DOMDocument();
        $contentDom->loadHTML($content);

        return  $this->elementsMatch($messageDom, $contentDom, 'p') &&
                $this->elementsMatch($messageDom, $contentDom, 'a') &&
                $this->elementsMatch($messageDom, $contentDom, 'h4') &&
                $this->elementsMatch($messageDom, $contentDom, 'font') &&
                $this->elementsMatch($messageDom, $contentDom, 'span');
    }

    private function elementsMatch(\DOMDocument $dom1, \DOMDocument $dom2, $tag)
    {
        $elements1 = $dom1->getElementsByTagName($tag);
        $elements2 = $dom2->getElementsByTagName($tag);

        if ($elements1->length !== $elements2->length) {
            if ($this->debug) {
                $el1 = [];
                $el2 = [];
                foreach ($elements1 as $el) {
                    $el1[] = $el->nodeValue;
                }
                foreach ($elements2 as $el) {
                    $el2[] = $el->nodeValue;
                }
                dd($tag, $elements1->length, $elements2->length, $el1, $el2);
            }

            return false;
        }

        for ($i = 0; $i < $elements1->length; $i++) {
            if (html_entity_decode($elements1[$i]->nodeValue) !== html_entity_decode($elements2[$i]->nodeValue)) {
                if ($this->debug) {
                    dd($elements1[$i]->nodeValue, html_entity_decode($elements1[$i]->nodeValue), $elements2[$i]->nodeValue, html_entity_decode($elements2[$i]->nodeValue));
                }

                return false;
            }
        }
        
        return true;
    }
}
