<?php


namespace App\Helpers;


class TableListingHelper
{
    public static function headerSort($field){
        $orderBy = request('order_by');
        $sortOrder = request('sort_order');
        if($sortOrder){
            $item = '<a href="'. self::addQueryParams(['order_by' => $field, 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']).'" type="button" class="btn btn-flat-success mr-1 mb-1 waves-effect waves-light">';
        }else{
            $item = '<a href="'. self::addQueryParams(['order_by' => $field, 'sort_order' => 'asc']).'" type="button" class="btn btn-flat-success mr-1 mb-1 waves-effect waves-light">';
        }
        $is_current_sort = $field == $orderBy;
        if($is_current_sort){
            if($sortOrder == 'asc'){
                $item .= '<i class="fa fa-sort-amount-asc"></i>';
            }else{
                $item .= '<i class="fa fa-sort-amount-desc"></i>';
            }
        }else{
            $item .= '<i class="fa fa-align-center"></i>';
        }
        $item .= '</a>';
        return $item;
    }

    private static function uriString()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    private static function queryString()
    {
        return isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';
    }

    private static function parseQueryParams()
    {
        $query = self::queryString();
        parse_str($query, $params);

        return $params;
    }

    private static function addQueryParams($arrayParams)
    {
        $targetPage = self::uriString();
        $queryParams = self::parseQueryParams();
        foreach ($arrayParams as $param => $value) {
            $queryParams[$param] = $value;
        }

        return $targetPage . '?' . http_build_query($queryParams);
    }


}
