<?php

namespace ThoriumCms\Model;

interface PageInterface
{
    /**
     * Get pageId.
     *
     * @return int pageId
     */
    public function getId();

    /**
     * Set pageId.
     *
     * @param int $pageId the value to be set
     * @return Page
     */
    public function setId($pageId);

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
     * Has keyword.
     *
     * @param string $keyword the value to check
     * @return boolean true if the page has keyword
     */
    public function hasKeyword($keyword);

    /**
     * Set keywords.
     *
     * @param array $keywords the value to be set
     * @return Page
     */
    public function setKeywords(array $keywords = array());

    /**
     * Get createdTime.
     *
     * @return DateTime createdTime
     */
    public function getCreatedTime();

    /**
     * Set createdTime.
     *
     * @param string $createdTime the value to be set
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

    /**
     * Convert the model to an array 
     * 
     * @return array
     */
    public function toArray();

    /**
     * Convert an array into a model instance 
     * 
     * @param array $array 
     * @static
     * @return Page
     */
    public static function fromArray($array);
}
