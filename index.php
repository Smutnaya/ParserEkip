<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
</head>

<body>
    <?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    require "vendor/autoload.php";

    use PHPHtmlParser\Dom;
    use PHPHtmlParser\Options;

    $dom = new Dom;
    //$dom->loadFromUrl('http://www.alrage.ru/exp.php');

    $dom->loadFromFile('ekip.html');
    $contents = $dom->find('.aTable');
    $contents = $dom->find('.aTable');

    $tableList = $contents->find('.tranTable');
    //$trList = $tableList->find('tr');

    //////echo count($tableList) . '<br>';


    $table_items = [];
    $items = [];
    $data = [];
    $damage = [];
    $hmp = [];
    $mf = [];
    $skm = [];
    $armor = [];
    $full = [];
    $point = [];
    $require = [];
    $skm_require = [];
    $perchi;

    $hp = 0;
    $sp = 0;
    $dp = 0;
    $dm = 0;
    $cp = 0;
    $cm = 0;
    $damage_min = 0;
    $damage_max = 0;
    $str = 0;
    $agi = 0;
    $luc = 0;
    $armor_fiz = 0;
    $armor_1 = 0;
    $armor_21 = 0;
    $armor_22 = 0;
    $armor_3 = 0;
    $armor_41 = 0;
    $armor_42 = 0;
    $str_require = 0;
    $agi_require = 0;
    $luc_require = 0;
    $id = 'bbb';
    $ii = '000';
    $t = '';
    echo '<pre>';
    

    foreach ($tableList as $table) {
        $trList = $table->find('tr');
        $i = 1;


        foreach ($trList as $tr) {
            $tdList = $tr->find('td');            
            $armor_1 = 0;
            $armor_21 = 0;
            $armor_22 = 0;
            $armor_3 = 0;
            $armor_41 = 0;
            $armor_42 = 0;
            
            $hp = 0;
            $sp = 0;
            $dp = 0;
            $dm = 0;
            $cp = 0;
            $cm = 0;
            $damage_min = 0;
            $damage_max = 0;
            $str = 0;
            $agi = 0;
            $luc = 0;
            $armor_fiz = 0;

            $str_require = 0;
            $agi_require = 0;
            $luc_require = 0;
            $items = [];
            $data = [];
            $damage = [];
            $hmp = [];
            $mf = [];
            $skm = [];
            $armor = [];
            $full = [];
            $point = [];
            $require = [];
            $skm_require = [];
            
                       
            
            foreach ($tdList as $td) {

                
                

                //////echo $td;

                if($i==1)
                {
                    $string = $td->find('h2');
                    $t = ($string->text); //name items

                    //echo '<br>'.$t;
                } 
                if($i == 2)
                {
                    $string = $td;
                    //////echo ('<br>' . $string . ' -- ');                    
                    list($info1, $price1, $weight1, $strength1) = explode(":", $string);

                    list($price, $price2) = explode(" дт", $price1);
                    list($weight2, $weight) = explode(" ", $weight1);
                    list($weight2, $weight1) = explode("&nbsp;&nbsp;&nbsp;", $weight);
                    list($strength2, $strength) = explode('0/', $strength1);

                    ////echo ' <br> price ' . $price; // цена
                    ////echo ' <br> weight ' . $weight2; // вес
                    ////echo ' <br> strength ' . $strength; //прочка                    
                } 
                if ($i == 5) {
                    $string = $td;
                   
                        $paramert = explode("<br />", $string);
                        // $paramert1 = explode("<br>", $string);

                        for ($y = 2; $y < count($paramert); $y++)
                        {    
                            
                            if (strpos($paramert[$y], 'Здоровье') !== false) {
                                $hp = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> hp ' . $hp);
                            }
                            if (strpos($paramert[$y], 'Сила') !== false) {

                                if ((strpos($paramert[$y], '+') == true) && (strpos($paramert[$y], '%') == true)) {

                                    list($str1, $sp1) = explode('(', $paramert[$y]);
                                    $str = preg_replace('#[^\d]#', '', $str1);
                                    $sp = preg_replace('#[^\d]#', '', $sp1);
                                    //echo ('<br> str ' . $str);
                                    //echo ('<br> sp ' . $sp);
                                }
                                if ((strpos($paramert[$y], '+') == true) && (strpos($paramert[$y], '%') == false)) {

                                    $str = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> str ' . $str);
                                }
                                if ((strpos($paramert[$y], '%')== true) && (strpos($paramert[$y], '+') == false)) {

                                    //echo ('<br> sp ' . $paramert[$y]);
                                }                               
                            }
                            if (strpos($paramert[$y], 'Ловкость') !== false) {
                                $agi = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> agi ' . $agi);
                                
                            }
                            if (strpos($paramert[$y], 'Удача') !== false) {
                                $luc = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> luc ' . $luc);
                            }
                            if (strpos($paramert[$y], 'Уворот себе') !== false) {
                                $dp = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> dp ' . $dp);
                            }
                            if (strpos($paramert[$y], 'Крит себе') !== false) {
                                $cp = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> cp ' . $cp);
                            }
                            if (strpos($paramert[$y], 'Уворот противнику') !== false) {
                                $dm = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> dm ' . $dm);
                            }
                            if (strpos($paramert[$y], 'Крит противнику') !== false) {
                                $cm = preg_replace('#[^\d]#', '', $paramert[$y]);
                                //echo ('<br> cm ' . $cm);
                            }
                            if (strpos($paramert[$y], 'Броня') !== false){                          
                                if(strpos($t, 'Шлем') !== false){
                                    $armor_1 = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_1 ' . $armor_1);
                                } else if (strpos($t, 'Доспех') !== false) {
                                    $armor_3 = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    $perchi = $armor_3;
                                    //echo ('<br> armor_3 ' . $armor_3);
                                } else if (strpos($t, 'Нарукавники') !== false) {
                                    $armor_21 = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_2 ' . $armor_2);
                                } else if (strpos($t, 'Поножи') !== false) {
                                    $armor_41 = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_4 ' . $armor_4);
                                } else if (strpos($t, 'Сандалии') !== false) {
                                    $armor_42 = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_4 ' . $armor_4);
                                } else if (strpos($t, 'Плащ') !== false) {
                                    $armor_fiz = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_fiz ' . $armor_fiz);
                                } else {
                                    $armor_fiz = preg_replace('#[^\d]#', '', $paramert[$y]);
                                    //echo ('<br> armor_fiz ' . $armor_fiz);
                                }
                            }

                                if ($sp != 0) {
                                    $mf['sp'] = $sp;
                                }
                                if ($dp != 0) {
                                    $mf['dp'] = $dp;
                                }
                                if ($cp != 0) {
                                    $mf['cp'] = $cp;
                                }
                                if ($dm != 0) {
                                    $mf['dm'] = $dm;
                                }
                                if ($cm != 0) {
                                    $mf['cm'] = $cm;
                                }

                                if ($str != 0) {
                                    $skm['str'] = $str;
                                }
                                if ($agi != 0) {
                                    $skm['agi'] = $agi;
                                }
                                if ($luc != 0) {
                                    $skm['luc'] = $luc;
                                }
                            
                            if (strpos($paramert[$y], 'Повреждения') !== false) {
                                if ((strpos($t, 'Перчатки') !== false) )
                                {
                                    $armor_22 = $perchi;
                                    //$armor_21 = 0;
                                    $damage_min = 0;
                                    $damage_max = 0;
                                    //echo ('<br> armor_2 ' . $armor_2);
                                }
                                else
                                {
                                    list($damage1, $damage2) = explode(': ', $paramert[$y]);
                                    list($damage4, $damage_min, $damage5, $damage_max) = explode(' ', $damage2);
                                    
                                    //echo ('<br>  damage_min ' . $damage_min);                                
                                    //echo ('<br>  damage_max ' . $damage_max);
                                }
                            }
                        }                 
                }
                if ($i == 6) {
                    $string = $td;

                    //echo '<br> Требования';

                    $paramert = explode("<br />", $string);
                    // $paramert1 = explode("<br>", $str);

                    for ($y = 2; $y < count($paramert); $y++) {
                        if (strpos($paramert[$y], 'Сила') !== false) {
                            $str_require = preg_replace('#[^\d]#', '', $paramert[$y]);
                            //echo ('<br> str_require ' . $str_require);                            
                        }
                        if (strpos($paramert[$y], 'Ловкость') !== false) {
                            $agi_require = preg_replace('#[^\d]#', '', $paramert[$y]);
                            //echo ('<br> agi_require ' . $agi_require);
                        }
                        if (strpos($paramert[$y], 'Удача') !== false) {
                            $luc_require = preg_replace('#[^\d]#', '', $paramert[$y]);
                            //echo ('<br> luc_require ' . $luc_require);
                        }

                    }

                    if ($str_require != 0) {
                        $skm_require['str'] = $str_require;
                    }
                    if ($agi_require != 0) {
                        $skm_require['agi'] = $agi_require;
                    }
                    if ($luc_require != 0) {
                        $skm_require['luc'] = $luc_require;
                    }

                    //echo '<br>';
                    if ($damage_min != 0 && $damage_max != 0) {
                        $damage = ['min' => $damage_min, 'max' => $damage_max];
                    }

                    if ($hp != 0) {
                        $hmp = ['hp' => $hp];
                    }

                    if ($armor_1 != 0) {
                        $point = ['1' => $armor_1];
                        $armor = ['point' => $point];
                    }
                    if ($armor_21 != 0) {
                        $point = ['21' => $armor_21];
                        $armor = ['point' => $point];
                    }
                    if ($armor_22 != 0) {
                        $point = ['22' => $armor_22];
                        $armor = ['point' => $point];
                    }
                    if ($armor_3 != 0) {
                        $point = ['3' => $armor_3];
                        $armor = ['point' => $point];
                    }
                    if ($armor_41 != 0) {
                        $point = ['41' => $armor_41];
                        $armor = ['point' => $point];
                    }
                    if ($armor_42 != 0) {
                        $point = ['42' => $armor_42];
                        $armor = ['point' => $point];
                    }
                    if ($armor_fiz != 0) {
                        $full = ['fiz' => $armor_fiz];
                        $armor = ['full' => $full];
                    }


                    if ($skm) {
                        $data['skm'] = $skm;
                    }
                    if ($hmp) {
                        $data['hmp'] = $hmp;
                    }
                    if ($armor) {
                        $data['armor'] = $armor;
                    }
                    if ($mf) {
                        $data['mf'] = $mf;
                    }
                    if ($damage) {
                        $data['damage'] = $damage;
                    }

                    if ($skm_require) {
                        $require['skm'] = $skm_require;
                    }
                    if ($require) {
                        $data['require'] = $require;
                    $items = [
                        'id' => $id,
                        't' => $t,
                        'i' => $ii,
                        'w' => $weight2 ,
                        'd' => $strength ,
                        'md' => $price
                    ];

                    if ($data) {
                        $items['data'] = $data;
                    }

                    }
                        $table_items[] = $items;


                }
                 
                
                //$str = $td;
                //////echo ('<br>' . $str . ' -- '. $i);
                $i++;
            }            
        }
    }
    
                    //print_r($table_items);
                    $print_string;
    $damage_min = null;
    $damage_max = null;
    $hp = null;
    $sp = null;
    $dp = null;
    $dm = null;
    $cp = null;
    $str = null;
    $agi = null;
    $luc = null;
    $fiz = null;
    $armor_1 = null;
    $armor_21 = null;
    $armor_22 = null;
    $armor_3 = null;
    $armor_41 = null;
    $armor_42 = null;
    $str_require = null;
    $agi_require = null;
    $luc_require = null;

	for ($i = 0; $i < count($table_items); $i++)
    {
        $damage_min = 0;
        $damage_max = 0;
        $hp = 0;
        $sp = 0;
        $dp = 0;
        $dm = 0;
        $cp = 0;
        $str = 0;
        $agi = 0;
        $luc = 0;
        $fiz = 0;
        $armor_1 = 0;
        $armor_21 = 0;
        $armor_22 = 0;
        $armor_3 = 0;
        $armor_41 = 0;
        $armor_42 = 0;
        $str_require = 0;
        $agi_require = 0;
        $luc_require = 0;
        $print_string = ('[\'id\' => \'' . $table_items[$i]['id'] . '\', \'t\' => \'' . $table_items[$i]['t'] . '\', \'i\' => \'' . $table_items[$i]['i'] . '\', \'w\' => ' . $table_items[$i]['w'] . ', \'d\' => ' . $table_items[$i]['d'] . ', \'md\' => ' . $table_items[$i]['md'] . ', \'data\' => [');
        //echo $table_items[$i]['data']['hmp']['hp'];
        //if($table_items[$i]['data']['damage']['min'] && $table_items[$i]['data']['damage'])
            $damage_min = $table_items[$i]['data']['damage']['min'];
        //if ($table_items[$i]['data']['damage']['max'] && $table_items[$i]['data']['damage']) 
            $damage_max = $table_items[$i]['data']['damage']['max'];
        $hp = $table_items[$i]['data']['hmp']['hp'];
        $sp = $table_items[$i]['data']['mf']['sp'];
        $dp = $table_items[$i]['data']['mf']['dp'];
        $dm = $table_items[$i]['data']['mf']['dm'];
        $cp = $table_items[$i]['data']['mf']['cp'];
        $str = $table_items[$i]['data']['skm']['str'];
        $agi = $table_items[$i]['data']['skm']['agi'];
        $luc = $table_items[$i]['data']['skm']['luc'];
        $fiz = $table_items[$i]['data']['armor']['full']['fiz'];
        $armor_1 = $table_items[$i]['data']['armor']['point']['1'];
        $armor_21 = $table_items[$i]['data']['armor']['point']['21'];
        $armor_22 = $table_items[$i]['data']['armor']['point']['22'];
        $armor_3 = $table_items[$i]['data']['armor']['point']['3'];
        $armor_41 = $table_items[$i]['data']['armor']['point']['41'];
        $armor_42 = $table_items[$i]['data']['armor']['point']['42'];
        $str_require = $table_items[$i]['data']['require']['skm']['str'];
        $agi_require = $table_items[$i]['data']['require']['skm']['agi'];
        $luc_require = $table_items[$i]['data']['require']['skm']['luc'];

        $print_string_damage = null;
        if ($damage_min != null) {
            $print_string_damage = '\'damage\' => [\'min\' => ' . $damage_min . ', \'max\' => ' . $damage_max . '],';
        }
        $print_string_hp = null;
        if ($table_items[$i]['data']['hmp']['hp'] != null) {
            $print_string_hp = '\'hmp\' => [\'hp\' => ' . $hp . '],';
        }
        $print_string_fiz = null;
        if ($table_items[$i]['data']['armor']['full']['fiz'] != null)  {
            $print_string_fiz = '\'armor\' => [\'full\' => [\'fiz\' => ' . $fiz . ']],';
        }
        $print_string_armor_1 = null;
        $print_string_armor_21 = null;
        $print_string_armor_22 = null;
        $print_string_armor_3 = null;
        $print_string_armor_41 = null;
        $print_string_armor_42 = null;
        if ($armor_1 != null) {
            $print_string_armor_1 = '[\'1\' => ' . $armor_1 . ']],';
        }
        if ($armor_21 != null) {
            $print_string_armor_21 = '[\'21\' => ' . $armor_21 . ']],';
        }
        if ($armor_22 != null) {
            $print_string_armor_22 = ' [\'22\' => ' . $armor_22 . ']],';
        }
        if ($armor_3 != null) {
            $print_string_armor_3 = '[\'3\' => ' . $armor_3 . ']],';
        }
        if ($armor_41 != null) {
            $print_string_armor_41 = '[\'41\' => ' . $armor_41 . ']],';
        }
        if ($armor_42 != null) {
            $print_string_armor_42 = '[\'42\' => ' . $armor_42 . ']],';
        }
        $print_string_armor_point = null;

        if($armor_1 != null or $armor_21 != null or $armor_22 != null or $armor_3 != null or $armor_41 != null or $armor_42 != null)
        {
            $print_string_armor_point = '\'armor\' => [\'point\' => ';
        }

        if ($armor_1 != null) {
            $print_string_armor_point = $print_string_armor_point.$print_string_armor_1 ;
        }
        if ($armor_21 != null) {
            $print_string_armor_point = $print_string_armor_point . $print_string_armor_21;
        }
        if ($armor_22 != null) {
            $print_string_armor_point = $print_string_armor_point . $print_string_armor_22;
        }
        if ($armor_3 != null) {
            $print_string_armor_point = $print_string_armor_point . $print_string_armor_3;
        }
        if ($armor_41 != null) {
            $print_string_armor_point = $print_string_armor_point . $print_string_armor_41;
        }
        if ($armor_42 != null) {
            $print_string_armor_point = $print_string_armor_point . $print_string_armor_42;
        }

        
        /*

        if ($str != null) {
            $print_string_skm = $print_string_skm. $print_string_str .'],';
        }
        if ($agi != null) {
            $print_string_skm = $print_string_skm . $print_string_agi . '],';
        }
        if ($luc != null) {
            $print_string_skm = $print_string_skm . $print_string_luc . '],';
        }
        */

        $print_string_sp = null;
        $print_string_dp = null;
        $print_string_cp = null;
        $print_string_dm = null;
        $print_string_cm = null;

        if ($sp != null) {
            $print_string_sp = '\'sp\' => ' . $sp . ',';
        }
        if ($dp != null) {
            $print_string_dp = '\'dp\' => ' . $dp . ',';
        }
        if ($cp != null) {
            $print_string_cp = '\'cp\' => ' . $cp . ',';
        }
        if ($dm != null) {
            $print_string_dm = '\'dm\' => ' . $dm . ',';
        }
        if ($cm != null) {
            $print_string_cm = '\'cm\' => ' . $cm . ',';
        }

        $print_string_mf = null;
        if($sp != null || $dp != null || $cp != null || $dm != null || $cm != null)
        {
            $print_string_mf = '\'mf\' => [';
        }
        /*
        if ($sp != null) {
            $print_string_mf = $print_string_mf.$print_string_sp . ',';
        }
        if ($dp != null) {
            $print_string_mf = $print_string_mf . $print_string_dp . ',';
        }
        if ($cp != null) {
            $print_string_mf = $print_string_mf .$print_string_cp . ',';
        }
        if ($dm != null) {
            $print_string_mf = $print_string_mf .$print_string_dm . ',';
        }
        if ($cm != null) {
            $print_string_mf = $print_string_mf .$print_string_cm . ',';
        }

*/
        $print_string_str = null;
        $print_string_agi = null;
        $print_string_luc = null;

        if ($str != null) {
            $print_string_str = '\'str\' => ' . $str . ',';
        }
        if ($agi != null) {
            $print_string_agi = '\'agi\' => ' . $agi . ',';
        }
        if ($luc != null) {
            $print_string_luc = '\'luc\' => ' . $luc . ',';
        }

        $print_string_skm = null;

        if ($str != null or $agi != null or $luc != null ) {
            $print_string_skm = '\'skm\' => [';
        }

        $print_string_require = '\'require\' => [';


        if ($str_require != null) {
            $print_string_require = $print_string_require . '\'skm\' => [\'str\' =>'  . $str_require . ',';
        }
        if ($agi_require != null) {
            $print_string_require = $print_string_require .  '\'agi\' => '. $agi_require . ',';
        }
        if ($luc_require != null) {
            $print_string_require = $print_string_require .  '\'luc\' => ' . $luc_require;
        }


            echo $print_string . $print_string_damage . $print_string_hp. $print_string_mf . $print_string_sp . $print_string_dp  . $print_string_cp . $print_string_dm . $print_string_cm . '],'. $print_string_skm. $print_string_str . $print_string_agi . $print_string_luc . '], ' . $print_string_fiz. $print_string_armor_point . $print_string_require.']]]],' . ' <br>';
    }

    echo count($table_items);
/*
    ['id' => 'dd', 't' => 'Топор Каратель',  'i' => '24',    'w' => 100, 'd' => 70, 'md' => 230.00, 'data' => ['damage' => ['min' => 19, 'max' => 27], 
    'mf' => ['sp' => 15, 'cp' => 20], 'skm' => ['str' => 3, 'luc' => 2], 'require' => ['skm' => ['luc' => 24]]]],
    //////echo count($trList);  


/*
    $table = [];
    $result6;
    $id = 0;

    foreach($trList as $tr)
    {
        $t = [];

        $tdList = $tr->find('td');
        $thList = $tr->find('th');

        $thCount = count($thList);         
        if($thCount == 1)
        {
            //////echo '<br>'.$thList->innerHtml;
            $thList->firstChild();
            $str = $thList->firstChild();

            $result6 = preg_replace('#[\[Уровень\]]#', '', $str);
        }
        else
        if($thCount == 0)
        {
            //////echo '<br>'.$tdList[1]->innerHtml;
            $str = $tdList[1]->innerHtml;
            $result = preg_replace('#[^\d]#', '', $str);
            $str1 = $tdList[0]->innerHtml;
            $result1 = preg_replace('#[^\d]#', '', $str1);
            $str2 = $tdList[3]->innerHtml;
            $result2 = preg_replace('#[^\d]#', '', $str2);
            $str3 = $tdList[6]->innerHtml;
            $result3 = preg_replace('#[^\d]#', '', $str3);
            $str4 = $tdList[5]->innerHtml;
            $result4 = preg_replace('#[^\d]#', '', $str4);
            $str5 = $tdList[4]->innerHtml;
            $result5 = preg_replace('#[^\d]#', '', $str5);

            //////echo '<br>' . 'ap '. $result1.' exp '. $result . ' stat ' . $result2 . ' stamina ' . $result3 . ' dt ' . $result4 . ' weapon ' . $result5 ;

            //array_push($t,['exp' =>  $result], [ 'up' =>  $result1], ['stats' => $result2], ['stamina' => $result3], ['dt' => $result4],['we apon' => $result5]);
            if($result1 == 0)
            {
                $t = [
                    'id' => $id,
                    'level' => $result6,
                    'up' =>$result1,
                    'exp' => $result,
                    'stats' => $result2,
                    'race' => 1,
                    'stamina' => $result3, 
                    'md' => $result4,
                    'weapon' => $result5
                ];
            } else{
                $t = [
                    'id' => $id,
                    'level' => $result6,
                    'up' => $result1,
                    'exp' => $result,
                    'stats' => $result2,
                    'race' => 0,
                    'stamina' => $result3,
                    'md' => $result4,
                    'weapon' => $result5
                ];
            }

        }

        //var_dump($table);


        // if(count($thList) > 0)
        // {
        //     print_r($thList);
        // }

        if ($t)
        {
            $table[] = $t;
            $id++;
        }
        //array_push($table, $t);
    }

    ////echo '<pre>';
    //print_r($t);

        for ($i = 19; $i < count($table); $i++)
        {
            ////echo '[\'id\' => ' . $table[$i]['id'] . ',\'level\' => ' . $table[$i]['level'] . ',\'up\' => ' . $table[$i]['up'] .',\'exp\' => ' . $table[$i]['exp'] . ',\'stats\' => ' . $table[$i]['stats'] . ',\'race\' => ' . $table[$i]['race'] . ',\'stamina\' => ' . $table[$i]['stamina'] . ',\'md\' => ' . $table[$i]['md'] . ',\'weapon\' => ' . $table[$i]['weapon'] . '], <br>';
        } 




    ////echo '<pre>';
    //print_r($table);
    //////echo $contents;
    //$html = $dom->outerHtml;
    //$a = $dom->find('.aTable')[1];

    //var_dump($a);

    //////echo $a;
*/


    ?>
</body>

</html>