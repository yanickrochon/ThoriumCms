<?php

namespace ThoriumCms\Mapper;

use ArrayObject;
use DateTime;
use Zend\Locale\Locale;
use ZfcBase\Mapper\AbstractDbMapper;
use ZfcBase\Model\AbstractModel;
use ThoriumCms\Module as ThoriumCms;

class PageContent extends AbstractDbMapper implements PageContentInterface
{
    protected $tableName         = 'page_content';
    protected $primaryKey        = 'page_id';
    protected $localeKey         = 'locale';

    /**
     * Returns the class name of the object mapped by the data mapper
     *
     * @return string
     */
    public function getClassName()
    {
        return ZfcUser::getOption('page_content_model_class');
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function persist($model)
    {
        $class = $this->getClassName();
        if (!is_object($model) || !$model instanceof $class) {
            throw new Exception\InvalidArgumentException('$model must be an instance of ' . $class);
        }
        $model->setModifiedTime(new DateTime());
        
        $data = new ArrayObject($this->toArray($model));
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('data' => $data, 'model' => $model));
        
        if ($this->findByIdAndLocale($model->getPageId(), $model->getLocale(), true)) {
            $this->getTableGateway()->update((array) $data, array(
                $this->primaryKey => $model->getPageId(),
                $this->localeKey => $model->getLocale()->toString(),
            ));
        } else {
            $this->getTableGateway()->insert((array) $data);
            $pageId = $this->getTableGateway()->getAdapter()->getDriver()->getLastGeneratedValue();
            $page->setPageId($pageId);
        }
        return $page;
    }

    public function findByIdAndLocale($pageId, $locale, $strict = true)
    {
        if (null === $locale) {
            $locale = new Locale();
        } else if (!$locale instanceof Locale) {
            $locale = new Locale($locale);
        }
        $locales = $this->_buildContentLocales($locale);
        
        foreach ($locales as $locale) {
            // TODO : change this into where/predicates
            if (false === $locale) {
                $rowset = $this->getTableGateway()->select(array(
                    $this->primaryKey => $pageId,
                ));
            } else if (null === $locale) {
                $rowset = $this->getTableGateway()->select(array(
                    $this->primaryKey => $pageId,
                    "{$this->localeKey} IS NULL",
                ));
            } else {
                $rowset = $this->getTableGateway()->select(array(
                    $this->primaryKey => $pageId,
                    $this->localeKey => $locale,
                ));
            }
            if ($rowset->count() > 0) break;
        }
        
        // TODO : implement non strict search
        $row = $rowset->current();
        $page = $this->fromRow($row);
        
        if ($page) {
            $this->events()->trigger(__FUNCTION__ . '.post', $this, array('model' => $page, 'row' => $row));
        }
        return $page;
    }

    protected function _buildContentLocales(Locale $locale) {
        $contentLocales = array(
            $locale->toString(),
            $locale->getLanguage(),
        );
        $contentLocales = array_unique(array_merge($contentLocales, array_keys(Locale::getFallback())));
        
        $contentLocales[] = null; // no locale (all)
        $contentLocales[] = false; // any
        return $contentLocales;
    }

    protected function fromRow($row)
    {
        if (!$row) return false;
        $pageContentModelClass = ThoriumCms::getOption('page_content_model_class');
        $page = $pageContentModelClass::fromArray($row->getArrayCopy());
        return $page;
    }

    public function remove($model)
    {
        // TODO : implement remove
    }

    public function getPaginatorAdapter(array $params)
    {
        // TODO : implement getPaginatorAdapter
    }
}
