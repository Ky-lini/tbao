<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
    function test()
    {
        $arr = [
            'sex' => ['性别不能为空'],
            'age' => ['年龄不能为空'],
        ];
        $res = array_shift($arr);
        dump($res);
    }

    public function index()
    {
        // 新品鲜知
        $url = 'http://openapi.qingtaoke.com/qingsoulist?sort=9&page=1&app_key=' . config('ak') . '&v=1.0&min_price=1&max_price=100&new=0&is_ju=1&is_tqg=0&is_ali=0';
        $def_arr = $this->curl_get($url);

        // 人气商品
        $bao_url = 'http://openapi.qingtaoke.com/baokuan?app_key=' . config('ak') . '&v=1.0&page=1&sort=8&page=1';
        $ren_arr = $this->curl_get($bao_url);

        // 店长推荐
        $tui_url = 'http://openapi.qingtaoke.com/qingsoulist?sort=1&page=1&app_key=' . config('ak') . '&v=1.0&min_price=1&&new=0';
        $tui_arr = $this->curl_get($tui_url);

//        halt($def_arr);
        $this->assign('data',$def_arr['data']['list']);
        $this->assign('ren_data',$ren_arr['data']);
        $this->assign('tui_data',$tui_arr['data']['list']);
        return $this->fetch();
    }
    // 上拉加载
    function ()
    {
        // 人气商品
        $bao_url = 'http://openapi.qingtaoke.com/baokuan?app_key=' . config('ak') . '&v=1.0&sort=8&page=2';
        $ren_arr = $this->curl_get($bao_url);

//        dump($ren_arr);
        echo json_encode($ren_arr);
    }

    function lists()
    {
        $desc = input('param.desc','','strip_tags');
//        halt($desc);
        $url = 'http://openapi.qingtaoke.com/search?s_type=1&key_word=' . $desc . '&app_key=' . config('ak') . '&v=1.0&min_price=1&sort=1';

        $res = $this->curl_get($url);
        $this->assign('data',$res['data']['list']);
        return $this->fetch('index/lists');
    }
    function sp_()
    {


    }
    function curl_get($url)
    {
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);
        //打印获得的数据
        $output = json_decode($output,true);
        return $output;
    }
    function buy_now()
    {
        return $this->fetch();
    }
    function buy_now_next()
    {
        return $this->fetch();
    }

    function center()
    {
        return $this->fetch();
    }
    function fenlei()
    {
        return $this->fetch();
    }
    function lists1()
    {
        return $this->fetch();
    }
    function my_list()
    {
        return $this->fetch();
    }
    function my_mingxi()
    {
        return $this->fetch();
    }
    function my_new()
    {
        return $this->fetch();
    }
    function shopping_car()
    {
        return $this->fetch();
    }
    function sp_detail()
    {
        $desc = input('param.id','','strip_tags');
        $url = 'http://openapi.qingtaoke.com/search?s_type=2&key_word=' . $desc . '&app_key=' . config('ak') . '&v=1.0&cat=2&min_price=1&max_price=100&sort=1';
        $res = $this->curl_get($url);

        $this->assign('data',$res['data']['list'][0]);
        return $this->fetch();
    }
    function youhuijuan()
    {
        return $this->fetch();
    }


}
