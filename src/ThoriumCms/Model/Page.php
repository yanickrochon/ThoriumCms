<?php

namespace ThoriumCms\Model;

use DateTime;
use ZfcBase\Model\AbstractModel;

class Page extends AbstractModel implements PageInterface
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
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * Set pageId.
     *
     * @param int $pageId the value to be set
     * @return Page
     */
    public function setPageId($pageId)
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
     * @return string keywords
     */
    public function getKeywords()
    {
        if(null === $this->keywords) {
            $this->keywords = '';
        }

        return $this->keywords;
    }

    /**
     * Has keyword.
     *
     * @param string|array $keywords the value to check
     * @return boolean true if the page has all keyword
     */
    public function hasKeywords($keywords)
    {
        if(is_object($keywords)) {
            if(is_callable(array($keywords, 'toString'))) {
                $keywords = $keywords->toString();
            } else {
                return false;
            }
        }
        if (!is_array($keywords)) {
            $keywords = explode(' ', $keywords);
        }

        $keywordMatch = array_intersect(explode(' ', $this->getKeywords()), $keywords);

        return count($keywordMatch) == count($keywords);
    }

    /**
     * Set keywords.
     *
     * @param string $keywords the value to be set
     * @return Page
     */
    public function setKeywords($keywords)
    {
        if(is_object($keywords)) {
            if(is_callable(array($keywords, 'toString'))) {
                $keywords = $keywords->toString();
            } else {
                throw new Exception("Parameter cannot be converted into a string");
            }
        } else if (is_array($keywords)) {
            $keywords = implode(' ', $keywords);
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
     * @param string|DateTime $createdTime the value to be set
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
        $this->active = (bool) $active;
        return $this;
    }

}
