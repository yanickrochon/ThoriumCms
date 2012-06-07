<?php

namespace SpeckCms\Model;

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
    public function getPageName();

    /**
     * Set page name.
     *
     * @param string $pageName the value to be set
     * @return Page
     */
    public function setPageName($pageName);

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
