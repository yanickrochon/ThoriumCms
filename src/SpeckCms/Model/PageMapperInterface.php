<?php

namespace SpeckCms\Model;

interface PageMapperInterface
{
    public function persist(PageInterface $page);

    public function findByName($name);

    public function findById($id);
}
