<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
       Серверийн алдаа гарлаа. Интернет хөтчийн буцах товчийг дарж дахин оролдоно уу.
    </p>
    <p>
        Хэрвээ алдаа хэвээрээ байвал МТТөвтэй холбогдоно уу.
    </p>

</div>
