<?php

namespace SpeckCms\Model;

use ZfcBase\Mapper\DbMapperAbstract,
    SpeckCms\Module as SpeckCms,
    ArrayObject,
    DateTime;

class PageMapper extends DbMapperAbstract implements PageMapperInterface
{
    protected $tableName         = 'page';
    protected $pageIDField       = 'page_id';
    protected $pageNameField     = 'name';

    public function persist(PageInterface $page)
    {
        $data = new ArrayObject($this->toScalarValueArray($page)); // or perhaps pass it by reference?
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('data' => $data, 'page' => $page));
        if ($page->getPageId() > 0) {
            $this->getTableGateway()->update((array) $data, array($this->pageIDField => $page->getPageId()));
        } else {
            $this->getTableGateway()->insert((array) $data);
            $pageId = $this->getTableGateway()->getAdapter()->getDriver()->getLastGeneratedValue();
            $page->setPageId($pageId);
        }
        return $page;
    }

    public function findByName($name)
    {
        $rowset = $this->getTableGateway()->select(array($this->pageNameField => $name));
        $row = $rowset->current();
        $page = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('page' => $page, 'row' => $row));
        return $page;
    }

    public function findById($id)
    {
        $rowset = $this->getTableGateway()->select(array($this->pageIDField => $id));
        $row = $rowset->current();
        $page = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('page' => $page, 'row' => $row));
        return $page;
    }

    protected function fromRow($row)
    {
        if (!$row) return false;
        $pageModelClass = SpeckCms::getOption('page_model_class');
        $page = $pageModelClass::fromArray($row->getArrayCopy());
        $page->setCreatedTime(DateTime::createFromFormat('Y-m-d H:i:s', $row['created_time']));
        return $page;
    }
}
