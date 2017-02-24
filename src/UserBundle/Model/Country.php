<?php
/**
 * Created by PhpStorm.
 * User: kostya
 * Date: 24.02.17
 * Time: 2:06
 */

namespace Acme\UserBundle\Model;

use App\Db;

/**
 * Class Country
 * @package Acme\UserBundle\Model
 */
class Country
{
    /**
     * Get List country
     *
     * @return array
     */
    public static function getCountryList()
    {
        $db = Db::connect();

        $sql = 'SELECT * FROM country';
        $result = $db->query($sql);
        $counties = [];
        $i = 0;

        while ($row = $result->fetch()) {
            $counties[$i]['id'] = $row['id'];
            $counties[$i]['name'] = $row['name'];
            $i++;
        }
        return $counties;
    }
}