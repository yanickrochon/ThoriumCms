<?php

namespace ThoriumCms\Model;

interface PageContentInterface
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
     * @return PageContent
     */
    public function setId($pageId);

    /**
     * Get content locale.
     *
     * @return Zend_Locale content locale
     */
    public function getLocale();

    /**
     * Set page name.
     *
     * @param  string|\Zend\Locale\Locale $locale content locale
     * @return PageContent
     */
    public function setLocale($pageName);

    /**
     * Get modifiedTime.
     *
     * @return DateTime modifiedTime
     */
    public function getModifiedTime();

    /**
     * Set modifiedTime.
     *
     * @param string|DateTime $modifiedTime the value to be set
     * @return Page
     */
    public function setModifiedTime($createdTime);

    /**
     * Get content.
     * 
     * @return string
     */
    public function getContent();

    /**
     * Set content.
     *
     * @param string $content the value to be set
     * @return Page
     */
    public function setContent($content);

}
