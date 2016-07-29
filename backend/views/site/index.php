

            <div class="row">
                <div class="col s6">
                    <h4 class="header" style="text-align: center">Цахим хуудсын тохиргоо хийсэн байдал</h4>
                    <p>Цахим хуудсын онцлогуудыг бүрэн дүүрэн ашиглахын тулд тохиргоонуудыг бүгдийг оруулах шаардлагатай. Тохиргоог <b>"Ерөнхий мэдээлэл"</b> цэснээс удирдана.</p>
                    <table>
                        <?php if(sizeof($general)!=0):?>
                        <col width="500">
                        <tr>
                            <td>1. Цахим хуудасны гарчиг</td><td><input type="checkbox" id="test5" <?php if(strlen($general->title)>1){echo "checked";}?> disabled="disabled"/>
                              <label for="test5"></label></td>
                        </tr>
                        <tr>
                            <td>2. Нүүр хуудсан дээр YouTube бичлэг байгаа эсэх</td><td><input type="checkbox" id="test8" <?php if(strlen($general->youtube_url)>1){echo "checked";}?> disabled="disabled" />
                            <label for="test8"></label></td>
                        </tr>
                        <tr>
                            <td>3. Facebook хуудас холбосон эсэх</td><td><input type="checkbox" id="test9" <?php if(strlen($general->facebook_url)>1){echo "checked";}?> disabled="disabled"/>
                            <label for="test9"></label></td>
                        </tr>
                        <tr>
                            <td>4. Google map дээрх уртраг, өргөрөгийн мэдээлэл оруулсан эсэх</td><td><input type="checkbox" id="test10" <?php if(strlen($general->google_gps)>1){echo "checked";}?> disabled="disabled"/>
                            <label for="test10"></label></td>
                        </tr>
                        <tr>
                            <td>5. Утасны мэдээлэл оруулсан эсэх</td><td><input type="checkbox" id="test11" disabled="disabled" <?php if(strlen($general->contact_phone)>1){echo "checked";}?>/>
                            <label for="test11"></label></td>
                        </tr>
                         <tr>
                            <td>6. Факсын мэдээлэл оруулсан эсэх</td><td><input type="checkbox" id="test11" disabled="disabled" <?php if(strlen($general->fax)>1){echo "checked";}?>/>
                            <label for="test11"></label></td>
                        </tr>
                        <tr>
                            <td>7. Мэндчилгээ оруулсан эсэх</td><td><input type="checkbox" id="test12" disabled="disabled" <?php if(strlen($general->greeting)>1){echo "checked";}?>/>
                            <label for="test12"></label></td>
                        </tr>
                        <tr>
                            <td>8. Хаяг оруулсан эсэх</td><td><input type="checkbox" id="test13" disabled="disabled" <?php if(strlen($general->address)>1){echo "checked";}?>/>
                            <label for="test13"></label></td>
                        </tr>
                        <tr>
                            <td>9. Зургын цомгын тоо</td><td><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Falbum'?>"><?=$album?></a>
                            <label for="test13"></label></td>
                        </tr>
                        <tr>
                            <td>10. Холбоосын тоо</td><td><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Flink'?>"><?= $link?></a>
                            <label for="test13"></label></td>
                        </tr>
                        <tr>
                            <td>11. Түгээмэл асуулт хариултын тоо</td><td><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Ffaq'?>"><?=$faq?></a>
                            <label for="test13"></label></td>
                        </tr>
                        <tr>
                            <td>12. Шийдвэрлээгүй байгаа санал хүсэлтийн тоо</td><td><a href="<?=Yii::getAlias('@web').'/index.php?r=site%2Fcomplain'?>"><?php echo $unsolved;?></a>
                            <label for="test13"></label></td>
                        </tr>
                      <?php endif;?>
                    </table>
                </div>
                <div class="col s5" style="text-align: left">
                     <h4 class="header">Цахим хуудсанд зочилсон байдал</h4>
                     <table >
                        <col width="200">
                         <tr><td>Өчигдөр : </td><td><?=$counter->yesterday_value?></td></tr>
                         <tr><td>Өнөөдөр : </td><td><?=$counter->day_value?></td></tr>
                         <tr><td>Энэ долоо хоногт : </td><td><?=$counter->week_value?></td></tr>
                         <tr><td>Энэ сард : </td><td><?=$counter->month_value?></td></tr>
                         <tr><td>Энэ жилд : </td><td><?=$counter->year_value?></td></tr>
                         <tr><td>Нийт : </td><td><?=$counter->all_value?></td></tr>
                     </table>
                     <div class="divider"></div>
                     <h4 class="header">Хамгийн их уншигдсан 5-н мэдээ</h4>
                     <?php $i=1; foreach($mostView as $view):?>
                     <a href="index.php?r=site%2Fviewcontent&id=<?=$view->id?>"><p><?=$i; $i++; echo '.'.$view->title?></p></a>
                     <?php endforeach;?>
                </div>
            </div>
            <div class="divider"></div>
            <!--Pie & Doughnut Charts-->
            <div id="chartjs-pie-chart" class="section">
              <h4 class="header">Мэдээний ангилал</h4>
              <div class="row">
                <div class="col s12 m4 l3">
                  <p>Эхний диаграмм нь нийт мэдээг цэсний байдлаар харуулсан бол дараангийн диаграм нь мэдээний төрлөөр нь харуулсан болно.</p>
                </div>
                <div class="col s12 m8 l9">
                  <div class="row">
                    <div class="col s12 m6 l6">
                      
                      <div class="sample-chart-wrapper">
                        <canvas id="pie-chart-sample" ></canvas>
                      </div>
                      <p class="header center">Цэс</p>
                    </div>
                    <div class="col s12 m6 l6">
                      <div class="sample-chart-wrapper">
                        <canvas id="doughnut-chart-sample" ></canvas>
                      </div>
                      <p class="header center">Төрөл</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php if(sizeof($general)!=0){$string=""; $num = $totalCount-$countEq;
$array = ['#ff0000', '#008080', '#0000ff', '#40e0d0', '#ffd700', '#468499', '#00ff00', '#800080', '#800000', '#ffdab9']; $i=0;
foreach($count as $c){
    $name = \app\models\Menu::findOne($c->menu_id);
                        $string .= '{
        value: "'.$c->cnt.'",
        color: "'.$array[$i].'",
       
        label: "'.$name->menu_name.'"
    },'; 
                        unset($array[$i]);$i++;}
    $other = '{
        value: "'.$num.'",
        color: "#6dc066",
        label: "Бусад"
    },'; 
                       
    $spc = '{
        value: "'.$special.'",
        color: "#ff0000",
        label: "Онцгой мэдээ"
    },'; 

    $typ = '{
        value: "'.$typical.'",
        color: "#6dc066",
        label: "Энгийн мэдээ"
    },';}





                        else{$other =''; $string =''; $typ =''; $spc = '';} ?>


<script type="text/javascript">

//Sampel Pie Doughnut Chart
var PieDoughnutChartSampleData = [<?php echo $string.$other ?>]
var PeanutData = [<?php echo $spc.$typ ?>]
 window.onload = function() {
  
  window.PieChartSample = new Chart(document.getElementById("pie-chart-sample").getContext("2d")).Pie(PieDoughnutChartSampleData,{
   responsive:true
  });
  window.DoughnutChartSample = new Chart(document.getElementById("doughnut-chart-sample").getContext("2d")).Pie(PeanutData  ,{
   responsive:true
  });
  

 };
 

</script>
<?php
$this->registerCSSFile(Yii::$app->request->baseUrl.'/css/style.css');
$this->registerJSFile(Yii::$app->request->baseUrl.'/js/chart.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);

?>


