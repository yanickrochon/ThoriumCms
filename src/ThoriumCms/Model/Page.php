<?php

namespace ThoriumCms\Model;

use DateTime,
    ZfcBase\Model\ModelAbstract;

class Page extends ModelAbstract implements PageInterface
{
    protected $page_id;

    protected $name;

    protected $title;

    protected $keywords;

    protected $created_time;

    protected $active;

    /**
     * Get pageId.
     *
     * @return int pageId
     */
    public function getId()
    {
        return $this->page_id;
    }

    /**
     * Set pageId.
     *
     * @param int $pageId the value to be set
     * @return Page
     */
    public function setId($pageId)
    {
        $this->page_id = (int) $pageId;
        return $this;
    }

    /**
     * Get page name.
     *
     * @return string page name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set page name.
     *
     * @param string $pageName the value to be set
     * @return Page
     */
    public function setName($pageName)
    {
        $this->name = $pageName;
        return $this;
    }

    /**
     * Get page title.
     *
     * @return string page title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set page title.
     *
     * @param string $pagetitle the value to be set
     * @return Page
     */
    public function setTitle($pageTitle)
    {
        $this->title = $pageTitle;
        return $this;
    }

    /**
     * Get keywords.
     *
     * @return array keywords
     */
    public function getKeywords()
    {
        if(null === $this->keywords) {
            $this->keywords = array();
        } elseif(is_string($this->keywords)) {
            $this->keywords = static::getKeywordsArrayFromString($this->keywords);
        }

        return $this->keywords;
    }

    /**
     * Has keyword.
     *
     * @param string $keyword the value to check
     * @return boolean true if the page has keyword
     */
    public function hasKeyword($keyword)
    {
        return in_array(strtolower($keyword), $this->getKeywords());
    }

    /**
     * Set keywords.
     *
     * @param mixed $keywords the value to be set
     * @return Page
     */
    public function setKeywords($keywords = array())
    {
        if(is_object($keywords)) {
            if(is_callable(array($keywords, 'toScalarValueArray'))) {
                return $keywords->toScalarValueArray();
            }

            if(is_callable(array($keywords, 'toArray'))) {
                $keywords = $keywords->toArray();
            }
        }

        if(is_string($keywords)) {
            $keywords = static::getKeywordsArrayFromString($keywords);
        }

        if(!is_array($keywords)) {
            throw new NotArrayException("Parameter is not an array");
        }

        $this->keywords = $keywords;
        return $this;
    }

    /**
     * Get createdTime.
     *
     * @return DateTime createdTime
     */
    public function getCreatedTime()
    {
        return $this->created_time;
    }

    /**
     * Set createdTime.
     *
     * @param string $createdTime the value to be set
     * @return Page
     */
    public function setCreatedTime($createdTime)
    {
        if($createdTime instanceof DateTime) {
            $this->created_time = $createdTime;
        } else {
            $this->created_time = new DateTime($createdTime);
        }
        return $this;
    }

    /**
     * Get active.
     * 
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active.
     *
     * @param bool $active the value to be set
     * @return Page
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get the scalar array value of this model
     *
     * @return array
     */
    public function toScalarValueArray()
    {
        return array(
            'id'           => $this->page_id,
            'name'         => $this->name,
            'title'        => $this->title,
            'keywords'     => static::getKeywordsArrayFromString($this->keywords),
            'created_time' => $this->created_time,
            'active'       => $this->active,
        );
    }

    /**
     * getKeywordsArrayFromString
     *
     * returns an array from the string of keywords
     *
     * @param int $byteLength
     * @return string
     */
    protected static function getKeywordsArrayFromString($keywordsString)
    {
        return array_map(function($item) {
            return strtolower(str_replace('_', ' ', $item));
        }, explode(' ', $keywordsString));
    }

    protected static function getKeywordsStringFromArray(array $keywordsArray)
    {
        return implode(' ', array_map(function($item) { 
            return str_replace(' ', '_', $item);
        }, $keywordsArray));
    }
}
