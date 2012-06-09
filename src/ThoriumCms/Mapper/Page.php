<?php

namespace ThoriumCms\Mapper;

use ArrayObject;
use DateTime;
use ZfcBase\Mapper\AbstractDbMapper;
use ZfcBase\Model\AbstractModel;
use ThoriumCms\Module as ThoriumCms;

class Page extends AbstractDbMapper implements PageInterface
{
    protected $tableName         = 'page';
    protected $primaryKey        = 'page_id';
    protected $pageNameField     = 'name';


    /**
     * Returns the class name of the object mapped by the data mapper
     *
     * @return string
     */
    public function getClassName()
    {
        return ZfcUser::getOption('page_model_class');
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

        $data = new ArrayObject($this->toArray($model));
        $this->events()->trigger(__FUNCTION__ . '.pre', $this, array('data' => $data, 'model' => $model));
        if ($model->getPageId() > 0) {
            $this->getTableGateway()->update((array) $model, array($this->primaryKey => $model->getPageId()));
        } else {
            $this->getTableGateway()->insert((array) $data);
            $pageId = $this->getTableGateway()->getAdapter()->getDriver()->getLastGeneratedValue();
            $model->setPageId($pageId);
        }
        return $model;
    }

    public function findByName($name)
    {
        $rowset = $this->getTableGateway()->select(array($this->pageNameField => $name));
        $row = $rowset->current();
        $page = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('model' => $page, 'row' => $row));
        return $page;
    }

    public function findById($id)
    {
        $rowset = $this->getTableGateway()->select(array($this->primaryKey => $id));
        $row = $rowset->current();
        $page = $this->fromRow($row);
        $this->events()->trigger(__FUNCTION__ . '.post', $this, array('model' => $page, 'row' => $row));
        return $page;
    }

    protected function fromRow($row)
    {
        if (!$row) return false;
        $pageModelClass = ThoriumCms::getOption('page_model_class');
        $page = $pageModelClass::fromArray($row->getArrayCopy());
        $page->setCreatedTime(DateTime::createFromFormat('Y-m-d H:i:s', $row['created_time']));
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
