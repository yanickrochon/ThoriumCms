<?php

namespace ThoriumCms\Mapper;

interface PageContentInterface
{
    public function findByIdAndLocale($pageId, $locale, $strict = true);
}
