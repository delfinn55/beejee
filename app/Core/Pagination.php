<?php

namespace App\Core;

class Pagination
{
    public static function getPage($itemCount, $perPage)
    {
        if (isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
            $page = $_GET['page'];

            // Match the $_GET['page'] with maximum possible value.
            if ($perPage) {
                $pageMax = ceil($itemCount/$perPage);
                if ($pageMax < $page) {
                    $page = $pageMax;
                }
            }

            return $page;
        }

        return 1;
    }
}