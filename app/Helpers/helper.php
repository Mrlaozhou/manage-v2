<?php
if( !function_exists('Trees') )
{
    /**
     * @ 递归 树形结构
     * @param $object
     * @param string $pid
     * @param int $level
     * @return array
     */
    function Trees($object,$pid='',$level=1)
    {
        $trees = [];
        foreach ( $object as $item )
        {
            if ( $item->pid != $pid )   continue;
            $item->level    =   $level;
            $item->son      =   Trees($object,$item->uuid,$level+1);
            $trees[]        =   $item;
        }
        return $trees;
    }
}
if( !function_exists('Sorts') )
{
    /**
     * @ 递归 排序结构
     * @param $object
     * @param bool $isClear
     * @param string $pid
     * @param int $level
     * @return array
     */
    function Sorts( $object, $isClear=false, $pid="", $level=1 )
    {
        static $sorts = [];
        if ($isClear)   $sorts=[];
        foreach ( $object as $key => $item )
        {
            if( is_object( $item ) ){
                if ( $item->pid != $pid )   continue;
                $item->level    =   $level;
                $sorts[]        =   $item;
                unset($object[$key]);
                Sorts( $object, $isClear=false, $item->uuid,$level+1 );
            }else{
                if ( $item['pid'] != $pid )   continue;
                $item['level']    =   $level;
                $sorts[]        =   $item;
                unset($object[$key]);
                Sorts( $object, $isClear=false, $item['uuid'],$level+1 );
            }
        }
        return $sorts;
    }
}
if( !function_exists('Ancestor') )
{
    function Ancestor ($object,$pid)
    {
        $ancestor   =   '';
        foreach ( $object as $key =>$item ){
            if( $item['uuid'] != $pid )   continue;
            if( $item['pid'] == '' ){
                return $ancestor=$item;
            };
            $ancestor = Ancestor($object,$item['pid']);
        }
        return $ancestor;
    }
}
if( !function_exists('dump_sql') )
{
    /**
     * @ 打印sql
     * @param Closure $exec
     */
    function dump_sql(Closure $exec)
    {
        DB::enableQueryLog();
        $exec();
        dump(DB::getQueryLog());
    }
}
if( !function_exists('curl') )
{
    function curl ($url, Array $data=[], int $post=1, int $header=0)
    {
        // 拼接请求地址
        $url = $post ? $url : $url.'?'.http_build_query($data);
        // 初始化
        $ch = curl_init();
        // 设置抓取的url
        curl_setopt($ch, CURLOPT_URL, $url);
        // 设置头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_HEADER, $header);
        // 设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 设置post方式提交、设置post数据
        $post && curl_setopt($ch, CURLOPT_POST, 1) && curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // 执行
        $data = curl_exec($ch);
        // 关闭URL请求
        curl_close($ch);
        // 显示获得的数据
        return $data;
    }
}