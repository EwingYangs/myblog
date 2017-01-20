<?php
//*********************自定义函数放在这里*******************


/** 
 * 关键字提取方法 
 * 
 * @param $title string 
 *         进行分词的标题 
 * @param $content string 
 *         进行分词的内容 
 * @return array 得到的关键词数组 
 */  
function getKeywords($title = "", $content = "") {  
    if (empty ( $title )) {  
        return array ();  
    }  
    if (empty ( $content )) {  
        return array ();  
    }  
    $data = $title . $title . $title . $content; // 为了增加title的权重，这里连接3次  
       
    //这个地方写上phpanalysis对应放置路径  
    require_once __WEB__.'public/phpanalysis/phpanalysis.class.php';  
       
    PhpAnalysis::$loadInit = false;  
    $pa = new PhpAnalysis ( 'utf-8', 'utf-8', false );  
    $pa->LoadDict ();  
    $pa->SetSource ( $data );  
    $pa->StartAnalysis ( true );  
       
    $tags = $pa->GetFinallyKeywords ( 3 ); // 获取文章中的五个关键字  
       
    $tagsArr = explode ( ",", $tags );  
    return $tagsArr;//返回关键字数组  
}  




// 有选择性的过滤XSS --》 说明：性能非常低-》尽量少用
/*
*	输入要过滤的数据，返回过滤后的数据
*/
function removeXXS($data)
{
	require_once './public/HtmlPurifier/HTMLPurifier.auto.php';
	$_clean_xss_config = HTMLPurifier_Config::createDefault();
	$_clean_xss_config->set('Core.Encoding', 'UTF-8');
	// 设置保留的标签
	$_clean_xss_config->set('HTML.Allowed','div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]');
	$_clean_xss_config->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
	$_clean_xss_config->set('HTML.TargetBlank', TRUE);
	$_clean_xss_obj = new HTMLPurifier($_clean_xss_config);
	// 执行过滤
	return $_clean_xss_obj->purify($data);
}
