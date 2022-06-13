<?php

use \Bitrix\Vebinar\VebinarTable;

namespace Bitrix\Vebinar;

/**
 * Class VebinarController
 * @package Bitrix\Vebinar
 */
class VebinarController
{
    /**
     * @param $data
     * @return array|string|string[]
     * Главный метод получение фильтров и вебинаров
     */
    public static function getVebinar($data) {
        if (empty($data))
            return [
                'ERROR' => 'ERROR_3',
                'MSG' => 'Отправляйте данные в формате json',
            ];
        $data = \Bitrix\Main\Web\Json::decode($data);
        $error = self::validateData($data);
        if ($error == 'OK') {
            $filters = self::buildOrmFilter($data);
            $vebinars = self::getVebinarsByMounth($filters);
            return $vebinars;
        } else
            return $error;
    }

    /**
     * @param $filters
     * @return array
     * Получение вебинаров по фильтрам
     */
    public static function getVebinarsByMounth($filters) {
        $vebinars = array();

        foreach ($filters as $filter)
            $vebinars = array_merge($vebinars, VebinarTable::getListWitchGroup($filter));

        return $vebinars;
    }

    /**
     * @param $page
     * @param null $variable
     * @return false|string
     */
    public static function includeTemplate($page, $variable = null) {
        $filepath = \Bitrix\Vebinar\Config\API_TEMPLATE_PATH . '/' . $page . '.php';

        if (is_file($filepath)) {
            extract(array(
                'arResult' => $variable,
            ));
            ob_start();
            include $filepath;
            return ob_get_clean();
        }
        return false;
    }

    /**
     * @param $parameters
     * @return array
     * @throws \Exception
     * Построение фильтра по входных данным json
     */
    public static function buildOrmFilter($parameters)
    {
        $filters = array();
        if (!empty($parameters['month'])) {
            //$datetime = \Bitrix\Main\Type\DateTime(date("Y") . "-{$month}-01");
            $index = 0;
            foreach ($parameters['month'] as $month) {
                $datetime = new \DateTime("01.${month}." . date("Y"));
                $filter['>=PROP_DATE_VALUE'] = $datetime->format('Y-m-d');
                $filter['<=PROP_DATE_VALUE'] = $datetime->modify('+1 month')->format('Y-m-d');

                if (!empty($parameters['theme']))
                    $filter['PROP_THEME_VALUE'] = $parameters['theme'];

                $filters[$index]['filter'] = $filter;

                $index++;
            }
        } else if (!empty($parameters['theme']))
            $filters[]['filter']['PROP_THEME_VALUE'] = $parameters['theme'];
        else $filters[]['filter'] = array();

        return $filters;
    }

    /**
     * @param $parameters
     * @return string|string[]
     * Проверка входных данных json
     */
    public static function validateData($parameters)
    {
        if (isset($parameters['month']))
            foreach ($parameters['month'] as $month)
                if ((is_int($month) && $month > 0 && $month <= 12) === false)
                    return ['ERROR' => 'ERROR_1', 'MSG' => 'Указаны неккоерктные месяца'];
        if (isset($parameters['theme']))
            foreach ($parameters['theme'] as $theme)
                if ( (is_int($theme) && $theme > 0) === false)
                    return ['ERROR' => 'ERROR_2', 'MSG' => 'Указаны неверные темы'];

        return 'OK';
    }

}