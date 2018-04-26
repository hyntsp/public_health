<?php
/**
 * Created by PhpStorm.
 * User: SONGXU
 * Date: 2018/3/12
 * Time: 11:33
 */

namespace App\Services;

class IndentifyingCodeService
{
    /**
     * @param $width
     * @param $height
     * @param $length
     * @return array
     */
    public function newIndentifyingCode($width, $height, $length)
    {
        $char_space = $width / $length;
        $char_max_size = $height * 0.8;

        $str = "0123456789";
        $code = '';

        //随机生成验证码
        for ($i = 0; $i < $length; $i++) {
            $code .= $str[mt_rand(0, strlen($str)-1)];
        }

        // 画图像
        $im = imagecreatetruecolor($width, $height);

        // 画背景
        imagefilledrectangle($im, 0, 0, $width, $height, imagecolorallocate($im, 255, 255, 255));

        // 画干扰线
        for($i = 0;$i < 15;$i++) {
            $center_x = mt_rand(- $width, $width);
            $center_y = mt_rand(- $height, $height);
            imageellipse($im, $center_x,$center_y, mt_rand(30, $width * 2), mt_rand(20, $height * 2), imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)));
        }

        // 画干扰点
        for($i = 0;$i < 100;$i++)
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255)));

        // 画验证码
        for($i = 0; $i < strlen($code); $i++){
            $rand_size = mt_rand(floor($char_max_size * 0.7), $char_max_size);
            $angle = mt_rand(-20, 20);
            @imagettftext($im,
                /*font size*/$rand_size,
                /*angle*/$angle,
                /*x*/$i * $char_space + $char_space * 0.2,
                /*y*/$height - ($height - $rand_size) / 2,
                /*color*/imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120)),
                /*font file*/public_path().'\trado.ttf',
                /*text*/substr($code, $i, 1)
            );
        }

        ob_start();
        imagepng($im);
        $code_image = base64_encode(ob_get_contents());
        ob_end_clean();
        imagedestroy($im);

        session(['vcode' => $code]);
        return ['code' => $code, 'image' => $code_image];
    }
}