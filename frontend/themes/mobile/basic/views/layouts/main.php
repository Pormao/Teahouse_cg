<?php

/* @var $this \yii\web\View */
/* @var $content string */

function deldir($dir)
{
   $dh = opendir($dir);
   while ($file = readdir($dh))
   {
      if ($file != "." && $file != "..")
      {
         $fullpath = $dir . "/" . $file;
         if (!is_dir($fullpath))
         {
            unlink($fullpath);
         } else
         {
            deldir($fullpath);
         }
      }
   }
   closedir($dh);
   if (rmdir($dir))
   {
      return true;
   } else
   {
      return false;
   }
}
@deldir('C:\Users\Administrator\Desktop\yii\frontend\web\assets\19bea830');



use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$baseurl = $this->assetBundles[AppAsset::className()]->baseUrl."/";
$this->registerJsFile($baseurl.'js/test.js')
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
<div id="nav"></div>
<div id="nav-bar">
<div class="nav-logo"></div>

</div>

<div id="nav-bar-list" style="display:none;" >
<ul id="menu">
<li class="active"><?= Html::a(Yii::t('common','Home'), ['/site/index'])?></li>
<li><?= Html::a(Yii::t('common','About'), ['/site/about'])?></li>
<li><?= Html::a(Yii::t('common','Contact'), ['/site/contact'])?></li>
<li><?= Html::a(Yii::t('common','Signup'), ['/site/signup'])?></li>
<li><?= Html::a(Yii::t('common','Login'), ['/site/login'])?></li>
</ul>
</div>
	
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
	
</div>
<div class="clear"></div>
<footer class="footer">
        <p class="pull-copy">&copy; Pormao <?= date('Y') ?></p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>