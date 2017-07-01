<?php

/*
 * 快速排序
 * args $array
 */


function qSort($array)
{
    $length = count($array);
    if( $length < 1)
    {
        return $array;
    }

    $value = $array[0];
    $left_array = [];
    $right_array = [];
    for($i = 1; $i < $length ; $i++)
    {
        if($array[$i] <= $value)
        {
            $left_array[] = $array[$i];
        }else
        {
            $right_array[] = $array[$i];
        }
    }
    $left_array = qSort($left_array);
    $right_array= qSort($right_array);
    return array_merge($left_array ,[$value] , $right_array);
}

/**
 * @param $array
 * @return mixed
 * 冒泡排序
 */
function mpSort($array)
{
    $length = count($array);
    if($length < 1)
    {
        return $array;
    }
    
    for($i = 1 ; $i < $length; $i++)
    {
        for($j = $length-1; $j > $i ; $j--)
        {
            if($array[$j] > $array[$i])
            {
                $temp = $array[$i];
                $array[$i] = $array[$j];
                $array[$j] = $temp;
            }
        }
    }
    return $array;

}

/**
 * 二分查找
 * 数据量大时使用
 */

function bin_search($search_arr , $low, $high , $k)
{
    if($low <= $high)
    {
        $mid = intval(($low+$high)/2);
        if($search_arr[$mid] == $k)
        {
            return $mid;
        }else if($k < $search_arr[$mid])
        {
            return bin_search($search_arr , $low , $mid-1 , $k);
        }else
        {
            return bin_search($search_arr , $mid+1 , $high , $k);
        }
    }

    return -1;
}

/**
 * 顺序查找
 * param $array  $k
 */
function sequence_sort($array  ,$k)
{
    $len =  count($array);
    for($i=0 ; $i < $len; $i++)
    {
        if($array[$i] == $k)
        {
            break;
        }
    }
    if($i < $len)
    {
        return $i;
    }else
    {
        return -1;
    }

}
/**
 * 遍历目录下所有文件和文件夹
 */
function scan_dir($dir)
{
    $result = [];
    if(is_dir($dir))
    {
        $dh = opendir($dir);
        while(false != ($file = readdir($dh)))
        {
            if($file != '.' and $file != '..')
            {
                $c_file = $dir.DIRECTORY_SEPARATOR .$file;
                if(is_dir($c_file))
                {
                    $result['dir'][$c_file] = scan_dir($c_file);
                }else
                {
                    $result['file'][] = $c_file;
                }
            }
        }
        closedir($dh);
    }
    return $result;
}
/*
 * --------------
 * 开发环境检测
 * --------------
 */
function checkEnv()
{
    echo phpinfo();
}
/*
 * --------------
 * 数猴子，找到踢出去
 * --------------
 */
function monkey($n , $m)
{
    $monkey_numbers = range(1, $n);

    $i = 0;

    while(count($monkey_numbers) > 1)
    {
        if(($i+1)%$m === 0)
        {
            unset($monkey_numbers[$i]);
        }else
        {
            array_push($monkey_numbers , $monkey_numbers[$i]);
            unset($monkey_numbers[$i]);
        }
        $i++;
    }
    return current($monkey_numbers);
}

/**
 * 二维数组排序算法函数
 */
function arr2_sort($array , $keys , $order = 0)
{
    if(is_array($array) == false)
    {
        return false;
    }
    $temp = [];
    foreach($array as $k=>$v)
    {
        $temp[$k] = $v[$keys];
    }
    $order == 0 ? asort($temp) :  arsort($temp);
    reset($temp);//数据指针重设，指向第一个单元
    $new_arr = [];
    foreach($temp as $key=>$val)
    {
        $new_arr[$key] = $array[$key];
    }
    return $new_arr;
}

/**
 * @param $array
 * exp $array = [
 *      ['id'  => 1,
 *      'pid' => 0,
 *      'name'=> '水果'
 *      ],
 *      ['id'  => 2,
 *      'pid' => 0,
 *      'name'=> '蔬菜'
 *      ],
 *      ['id'  => 3,
 *      'pid' => 1,
 *      'name'=> '香蕉'
 *      ],
 *      ['id'  => 4,
 *      'pid' => 2,
 *      'name'=> '黄瓜'
 *      ],
 *      ['id'  => 5,
 *      'pid' => 1,
 *      'name'=> '苹果'
 *      ],
 *      ['id'  => 6,
 *      'pid' => 2,
 *      'name'=> '茄子'
 *      ],
 *
 * ];
 */


function iterate($array , $pid = 0)
{
    if(count($array) > 0)
    {
        $temp = [];
        foreach ($array as $key=>$val)
        {
            if((int) $val['pid'] == $pid)
            {
                $temp[$key]= $val;
                $temp[$key]['child'] = iterate($array , $val['id']);
            }
        }
    }
    sort($temp);
    return $temp;
}