<?php
/**
 * 冒泡排序
 * @param $data
 * @return array|false
 */
function maopao($data)
{
    if (!is_array($data)) return false;
    $count = count($data);
    $huan = $count - 1;
    if ($huan < 1) return $data;
    for ($i = $huan; $i > 1; $i--) {
        for ($j = 0; $j < $i; $j++) {
            if ($data[$j] > $data[$j + 1]) {
                $da = $data[$j];
                $data[$j] = $data[$j + 1];
                $data[$j + 1] = $da;
            }
        }
    }
    return $data;
}

/**
 * 快速排序
 * @param $array
 * @return mixed
 */
function quickSort($array)
{
    if (count($array) <= 1) {
        return $array;
    }

    $pivot = $array[0];
    $left = array();
    $right = array();

    for ($i = 1; $i < count($array); $i++) {
        if ($array[$i] < $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }
    }

    return array_merge(quickSort($left), array($pivot), quickSort($right));
}

/***
 * 插入排序
 * @param $data
 * @return array|false
 */
function insertSort($data)
{
    if (!is_array($data)) return false;
    $length = count($data);
    if ($length == 1) return $data;
    for ($i = 1; $i < $length; $i++) {
        if ($data[$i] < $data[$i - 1]) {
            $j = $i;
            $temp = $data[$i];
            while ($j > 0 && $data[$j - 1] > $temp) {
                $data[$j] = $data[$j - 1];
                $j--;
            }
            $data[$j] = $temp;
        }
    }
    return $data;

}

/**
 * 希尔排序
 * @param $arr
 * @return void
 */
function shellSort($arr)
{
    $length = count($arr);
    $gap = intval($length / 2);

    while ($gap > 0) {
        for ($i = $gap; $i < $length; $i++) {
            $temp = $arr[$i];
            $j = $i;

            while ($j >= $gap && $arr[$j - $gap] > $temp) {
                $arr[$j] = $arr[$j - $gap];
                $j -= $gap;
            }

            $arr[$j] = $temp;
        }

        $gap = intval($gap / 2);
    }
}

/**
 * 堆排序
 * @param $arr
 * @return mixed
 */
function heapSort($arr) {
    $n = count($arr);

    // 构建最大堆
    for ($i = ($n / 2) - 1; $i >= 0; $i--) {
        heapify($arr, $n, $i);
    }

    // 将最大元素移动到数组末尾，并重新构建最大堆
    for ($i = $n - 1; $i >= 0; $i--) {
        // 交换根节点和当前节点
        $temp = $arr[0];
        $arr[0] = $arr[$i];
        $arr[$i] = $temp;

        // 重新构建最大堆
        heapify($arr, $i, 0);
    }

    return $arr;
}

function heapify(&$arr, $n, $i) {
    $largest = $i; // 初始化最大元素为根节点
    $left = 2 * $i + 1; // 左子节点索引
    $right = 2 * $i + 2; // 右子节点索引

    // 如果左子节点比根节点大，则更新最大元素索引为左子节点索引
    if ($left < $n && $arr[$left] > $arr[$largest]) {
        $largest = $left;
    }

    // 如果右子节点比最大元素大，则更新最大元素索引为右子节点索引
    if ($right < $n && $arr[$right] > $arr[$largest]) {
        $largest = $right;
    }

    // 如果最大元素不是根节点，则交换它们，并递归地调用 heapify() 函数
    if ($largest != $i) {
        $temp = $arr[$i];
        $arr[$i] = $arr[$largest];
        $arr[$largest] = $temp;
        heapify($arr, $n, $largest);
    }
}

/**
 * 归并排序
 * @param $arr
 * @return void
 */
function mergeSort($arr) {
    if(count($arr) > 1) {
        $mid = count($arr) / 2;
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);

        mergeSort($left);
        mergeSort($right);

        merge($left, $right, $arr);
    }
}

function merge($left, $right, &$arr) {
    $i = $j = 0;
    $k = 0;

    while($i < count($left) && $j < count($right)) {
        if($left[$i] < $right[$j]) {
            $arr[$k] = $left[$i];
            $i++;
        } else {
            $arr[$k] = $right[$j];
            $j++;
        }
        $k++;
    }

    while($i < count($left)) {
        $arr[$k] = $left[$i];
        $i++;
        $k++;
    }

    while($j < count($right)) {
        $arr[$k] = $right[$j];
        $j++;
        $k++;
    }
}

/**
 * 计数排序
 * @param $arr
 * @return mixed
 */
function countingSort($arr)
{
    // 获取数组中的最大值和最小值
    $max = max($arr);
    $min = min($arr);

    // 计算每个数字出现的次数
    $count = array_fill(0, $max - $min + 1, 0);
    foreach ($arr as $num) {
        $count[$num - $min]++;
    }

    // 对计数数组进行累加
    for ($i = 1; $i < count($count); $i++) {
        $count[$i] += $count[$i - 1];
    }
    // 创建一个临时数组，用于存储排序后的结果
    $sorted = array_fill(0, count($arr), 0);

    // 根据计数数组将原始数组中的元素放入临时数组中
    for ($i = count($arr) - 1; $i >= 0; $i--) {
        $sorted[--$count[$arr[$i] - $min]] = $arr[$i];
    }

    // 将排序后的元素复制回原始数组
    for ($i = 0; $i < count($arr); $i++) {
        $arr[$i] = $sorted[$i];
    }

    return $arr;
}

/**
 * 桶排序
 * @param array $arr
 * @return void
 */
function bucketSort(array &$arr)
{
    // 获取数组中的最大值和最小值
    $min = min($arr);
    $max = max($arr);
    $range = $max - $min;

    // 桶的数量，根据实际情况进行调整
    $bucketNum = 10;

    // 初始化桶
    $buckets = array_fill(0, $bucketNum, []);

    // 将数据分配到桶中
    foreach ($arr as $value) {
        $index = floor($value - $min) / ($range / $bucketNum);
        $buckets[$index][] = $value;
    }

    // 对每个桶中的数据进行排序
    for ($i = 0; $i < $bucketNum; $i++) {
        sort($buckets[$i]);
    }

    // 将桶中的数据依次取出，放回原数组中
    $i = 0;
    foreach ($buckets as $bucket) {
        for ($j = 0; $j < count($bucket); $j++) {
            $arr[$i++] = $bucket[$j];
        }
    }
}

/**
 * 计数排序
 * @param $arr
 * @return void
 */
function radix_sort(&$arr) {
    if (count($arr) <= 1) {
        return;
    }

    // 获取最大值，确定需要比较的位数
    $max = max($arr);
    $digits = 0;
    while ($max > 0) {
        $digits++;
        $max /= 10;
    }

    // 初始化桶
    $buckets = array_fill(0, 10, []);

    // 进行digits次排序
    for ($i = 0; $i < $digits; $i++) {
        // 将每个数放入对应的桶中
        for ($j = 0; $j < count($arr); $j++) {
            $digit = (int)($arr[$j] / pow(10, $i)) % 10;
            array_push($buckets[$digit], $arr[$j]);
        }

        // 将桶中的数按顺序放回原数组
        $arr_idx = 0;
        foreach ($buckets as $bucket) {
            for ($j = 0; $j < count($bucket); $j++) {
                $arr[$arr_idx] = $bucket[$j];
                $arr_idx++;
            }
        }
        $buckets = array_fill(0, 10, []);
    }
}