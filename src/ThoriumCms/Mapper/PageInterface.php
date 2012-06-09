<?php

namespace ThoriumCms\Mapper;

interface PageInterface
{
    public function findByName($name);

    public function findById($id);
}
