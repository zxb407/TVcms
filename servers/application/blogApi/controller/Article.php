<?php
/**
 * Created by bianquan
 * CommonUser: ZhuYunlong
 * Email: 920200256@qq.com
 * Date: 2019/1/19
 * Time: 20:29
 */

namespace app\blogApi\controller;
use app\blogApi\service\Article as ArticleService;
use app\common\controller\BaseController;
use app\common\validate\PagingParameter;
use app\blogApi\model\Article as ArticleModel;
use app\lib\exception\ResourcesException;
use app\lib\Response;

class Article extends BaseController
{
    public function getList($tagID,$userID,$page,$limit)
    {
        (new PagingParameter())->goCheck();
        $list = ArticleService::getList($tagID,$userID,$page,$limit);
        return new Response(['data'=>$list]);
    }

    public function getOne($ID) {
        $article = ArticleModel::getOne(['a_id'=>$ID]);
        if($article) {
            return new Response(['data'=>$article]);
        } else {
            throw new ResourcesException(['msg'=>找不到对应文章]);
        }
    }

    public function getAllPublished() {
        $articles = ArticleModel::all(['published'=>1,'status'=>1]);
        if(empty($articles)) {
            throw new ResourcesException();
        }
        return new Response(['data'=>$articles]);
    }

}