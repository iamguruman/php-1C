<?php 

class OnecComponentsUuid
{

    /**
     * проблема заключается в том, что UUID объекта документа в 1С не совпадает
     * с адресом для указания ссылки на объект через веб
     *
     * чтобы это исправить нужно преобразовать UUID объекта в GUID для использования ссылки
     *
     * пример UUID документа: 5bcea6f6-28f0-11ec-a01a-00155d12cb0e
     *
     * пример GUID документа: a01a00155d12cb0e11ec28f05bcea6f6
     *
     * пример GUID в ссылке на этот объект документа через адресную строку:
     *      e1cib/data/Документ.ОтчетПроизводстваЗаСмену?ref=a01a00155d12cb0e11ec28f05bcea6f6
     *
     * для решения данной ситуации достаточно преобразовать UUID в GUID
     *
     * https://infostart.ru/public/99109/
     * @param $value
     * @return array|string
     */
    public static function OnecUuidToGuid($value){

        $ret = [];

        if($value && strlen($value) == 36){

            $ret [] = substr($value, 19, 4); // a01a - первый

            $ret [] = substr($value, 24); // 00155d12cb0e - второй

            $ret [] = substr($value, 14, 4); // 11ec - в середине

            $ret [] = substr($value, 9, 4); // 28f0 - предпоследний

            $ret [] = substr($value, 0, 8); // 5bcea6f6 - в конец

        }

        return implode($ret);

    }

}
