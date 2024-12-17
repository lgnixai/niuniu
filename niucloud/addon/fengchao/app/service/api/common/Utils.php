<?php

namespace addon\fengchao\app\service\api\common;


use http\Exception\InvalidArgumentException;

/**
 * 通用函数
 */
class Utils
{


    public static function getJson($Data)
    {
        if(!is_string($Data)){
            $Data=json_encode($Data,JSON_UNESCAPED_UNICODE);
        }
        $cleanData = str_replace(["\n", " "], "", $Data);
        $cleanData = str_replace(["\n", " "], "", $cleanData);
        // 解码 JSON 字符串
        $jsonData = json_decode($cleanData, true);
        return $jsonData;

    }


    public static function setJson($inputData) {
        // 如果输入是 JSON 字符串，则将其解码为数组
        if (is_string($inputData)) {
            $inputData = json_decode($inputData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException("Invalid JSON input");
            }
        }

        // 检查是否是数组
        if (!is_array($inputData)) {
            throw new InvalidArgumentException("Input data must be an array or a valid JSON string");
        }

        // 递归格式化数组
        return  formatArrayToRequestString($inputData);
    }




}
function formatArrayToRequestString($data, $indent = 0) {
    $output = "{\n";
    $indentation = str_repeat("    ", $indent + 1);  // 每一层增加缩进

    foreach ($data as $key => $value) {
        $formattedKey = "'$key'"; // 使用单引号包裹键

        if (is_array($value)) {
            // 如果值是数组，递归调用函数并增加缩进
            $formattedValue = formatArrayToRequestString($value, $indent + 1);
        } elseif (is_string($value)) {
            // 如果值是字符串，使用单引号包裹
            $formattedValue = "'$value'";
        } else {
            // 其他类型的值直接输出
            $formattedValue = $value;
        }

        $output .= "$indentation$formattedKey: $formattedValue,\n";
    }

    // 去除最后一个多余的逗号
    $output = rtrim($output, ",\n") . "\n";
    $output .= str_repeat("    ", $indent) . "}";

    return $output;
}