<?php

namespace ThoriumCms\Model;

interface PageInterface
{
    /**
     * Get pageId.
     *
     * @return int pageId
     */
    public function getPageId();

    /**
     * Set pageId.
     *
     * @param int $pageId the value to be set
     * @return Page
     */
    public function setPageId($pageId);

    /**
     * Get page name.
     *
     * @return string page name
     */
    public function getName();

    /**
     * Set page name.
     *
     * @param string $pageName the value to be set
     * @return Page
     */
    public function setName($pageName);

    /**
     * Get page title.
     *
     * @return string page title
     */
    public function getTitle();

    /**
     * Set page title.
     *
     * @param string $pagetitle the value to be set
     * @return Page
     */
    public function setTitle($pageTitle);

    /**
     * Get keywords.
     *
     * @return array keywords
     */
    public function getKeywords();

    /**
     * Has all keywords.
     *
     * @param string|array $keywords the value to check
     * @return boolean true if the page has all the keywords
     */
    public function hasKeywords($keywords);

    /**
     * Set keywords.
     *
     * @param array|string $keywords the value to be set
     * @return Page
     */
    public function setKeywords($keywords);

    /**
     * Get createdTime.
     *
     * @return DateTime createdTime
     */
    public function getCreatedTime();

    /**
     * Set createdTime.
     *
     * @param string|DateTime $createdTime the value to be set
     * @return Page
     */
    public function setCreatedTime($createdTime);

    /**
     * Get active.
     * 
     * @return bool
     */
    public function getActive();

    /**
     * Set active.
     *
     * @param bool $active the value to be set
     * @return Page
     */
    public function setActive($active);

}
