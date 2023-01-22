<?php

namespace App\Core;

class Pagination
{
    /**
     * Get current page.
     * Checks if value from $_GET data more than possible.
     *
     * @param $itemCount
     * @param $perPage
     * @return float|int|mixed
     */
    public static function getPage($itemCount, $perPage): mixed
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