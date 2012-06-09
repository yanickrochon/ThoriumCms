<?php

namespace ThoriumCms\Model;

use DateTime;
use Zend\Locale\Locale;
use ZfcBase\Model\AbstractModel;

class PageContent extends AbstractModel implements PageContentInterface
{
    protected $page_id;

    protected $locale;

    protected $modified_time;

    protected $content;


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
     * @return PageContent
     */
    public function setId($pageId)
    {
        $this->page_id = (int) $pageId;
    }

    /**
     * Get content locale.
     *
     * @return Zend_Locale content locale
     */
    public function getLocale()
    {
        if (null === $this->locale) {
            $this->locale = new Zend_Locale();
        }
        return $this->locale;
    }

    /**
     * Set page name.
     *
     * @param  string|\Zend\Locale\Locale $locale content locale
     * @return PageContent
     */
    public function setLocale($locale)
    {
        if ($locale instanceof Locale) {
            $this->locale = $locale;
        } else {
            $this->locale = new Locale($locale);
        }
        return $this;
    }

    /**
     * Get modifiedTime.
     *
     * @return DateTime modifiedTime
     */
    public function getModifiedTime()
    {
        return $this->modified_time;
    }

    /**
     * Set modifiedTime.
     *
     * @param string|DateTime $modifiedTime the value to be set
     * @return Page
     */
    public function setModifiedTime($modifiedTime)
    {
        if($modifiedTime instanceof DateTime) {
            $this->modified_time = $modifiedTime;
        } else {
            $this->modified_time = new DateTime($modifiedTime);
        }
        return $this;
    }

    /**
     * Get content.
     * 
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set content.
     *
     * @param string $content the value to be set
     * @return Page
     */
    public function setContent($content)
    {
        if (is_object($content)) {
            if (is_callable($content, 'toString')) {
                $content = $content->toString();
            }
        } else if (!is_string($content)) {
            $content = (string) $content;
        }
        $this->content = $content;
        return $this;
    }

}
