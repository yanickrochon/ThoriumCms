<?php

namespace SpeckCms\Model;

use DateTime,
    ZfcBase\Model\ModelAbstract;

class Page extends ModelAbstract implements PageInterface
{
    protected $page_id;

    protected $page_name;

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
    public function getPageName()
    {
        return $this->page_name;
    }

    /**
     * Set page name.
     *
     * @param string $pageName the value to be set
     * @return Page
     */
    public function setPageName($pageName)
    {
        $this->page_name = $pageName;
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
        if ($createdTime instanceof DateTime) {
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
}
