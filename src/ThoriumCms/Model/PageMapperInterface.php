<?php

namespace ThoriumCms\Model;

interface PageMapperInterface
{
    public function persist(PageInterface $page);

    public function findByName($name);

    public function findById($id);
}
