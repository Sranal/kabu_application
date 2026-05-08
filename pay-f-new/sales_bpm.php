<?php
//================================================================================
// 概要: ENQUETE SYSTEM 登録フォーム(PC)
//================================================================================

// DEBUG
ini_set("error_reporting", E_ALL);
ini_set("display_errors", "1");

// REQUIRE(INI)
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/ini/setting.php");

// REQUIRE(FUNCTION)
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/functions/functions.php");

// REQUIRE(CLASS)
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/EnqueteAnswer.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/InputForm.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/LogWrite.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/ProdMailSend.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/JapanHoliday.php");
session_start();
$input_form_obj = new InputForm();
$pre_reg_email = '';

$goods_id= '1002';
$goods_id = $input_form_obj->getGoodsInfoBygId($goods_id);

if(isset($_POST['check'])){
    $res = $input_form_obj->checkNewPay($_POST);
    echo json_encode(['code'=>$res]);die;
}

if(isset($_POST['name'])){
    if (isset($_POST['info_replay']) && $_POST['info_replay'] == '1') {
        $res = $input_form_obj->addStudentLog($_POST,$goods_id);
    } else {
        $res = $input_form_obj->addNewLp($_POST,$goods_id);
    }
    if($res) {
        $info = $input_form_obj->getUserAllInfoFromTel($_POST);
        $mail_address = !empty($info['mail_address']) ? $info['mail_address'] : $info['mail_address2'];
        setcookie('p_email',$info['mail_address'],time()+3600,'/');
        setcookie('p_name_kana',$info['name_phonetic'],time()+3600,'/');
        setcookie('p_name_jp',$info['name'],time()+3600,'/');
        setcookie('p_bank_tel',$info['tel'],time()+3600,'/');
        echo json_encode(['code'=>0,'id'=>$info['id']]);die;
        //header("Location:/reservation/thx1-1");
        die;
    }
    echo json_encode(['code'=>1]);die;
}
// 获取对应金额
$goods_price = $input_form_obj->getGoodsInfo($goods_id,'goods_price');
$goods_name = $input_form_obj->getGoodsInfo($goods_id,'goods_name');
$order = 'order-'.date('YmdHis'.mt_rand(10,10000));
$redirect_url = URL_DOMAIN.'/LP/pay/pay_end.html';
//$redirect_url = URL_DOMAIN.'/member/oneonone/pay_end.php';
$callback_url = URL_DOMAIN.'/LP/pay/pay_end.html';
$cancel_url = URL_DOMAIN.'/LP/pay/oneononem/bpm_payment.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />     <meta http-equiv="Pragma" content="no-cache" />     <meta http-equiv="Expires" content="0" />
<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-PWJHKGB');</script>

<!-- End Google Tag Manager -->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>購入申し込みページ｜先乗り投資法</title>

    <link href="https://www.kabu-college.com/LP/pay-f-new/css/aos.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-new/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-new/css/featherlight.min.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-new/css/animate.css" rel="stylesheet" type="text/css" />
    <link href="https://www.kabu-college.com/LP/pay-f-new/css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error-tip{
            text-align: left;
            color: red;
            display: none;
        }
    </style>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6KC6F063BS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6KC6F063BS');
</script>

</head>

<body>
<!-- Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PWJHKGB"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<!-- End Google Tag Manager (noscript) -->
<div class="e2"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e2.png" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="300" data-aos-delay="300"></div>

<ul>


    <li class="p1">
        <div class="content p1h">

            <div class="e1"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e1.png" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="300" data-aos-delay="300"></div>


        </div>
    </li>

    <li class="p2">
        <div class="content2 p2h">
            <div class="p_box">
                <div class="p_right">
                    <div class="title">ご購入手続きへ進む</div>
                    <div class="txt">注文する商品をご確認いただき、よろしければご注文者情報を入力して、<br />
                        ご希望の決済方法のボタンを押して次にお進みください。</div>

                    <form method="post" id="pay" action="https://payment.bpmc.jp/link/<?php echo BPM_CLIENT_IP; ?>/payment">
                    <div class="form_box">
                        <div class="ftitle">ご注文者情報</div>
                        <div class="form_e">
                            <input name="name" id="name" type="text" placeholder="氏名" />
                            <p class="error-tip error-name">お名前を入力してください。</p>
                        </div>
                        <div class="form_e"><input name="name_kana" id="name_kana" type="text" placeholder="フリガナ" />
                            <p class="error-tip error-name_kana">フリガナを入力してください。</p></div>
                        <div class="form_e">
                            <input name="tel" oninput="value=value.replace(/[^\d]/g,'')" id="tel" maxlength="11" pattern="[0-9]*" type="text" placeholder="電話番号" />
                            <p class="error-tip error-tel">電話番号の形式が正しくありません。</p></div>
                        <div class="form_e"><input name="email" id="email" type="text" placeholder="メールアドレス" />
                            <p class="error-tip error-email">メールアドレスの形式が正しくありません。</p></div>

                        <div class="sp">
                            <div class="ftitle">お支払方法</div>
                            <div class="form_sp"><select name="card_sp">
                                    <option value="1">クレジットカード一括</option>
                                    <option value="0">銀行振込一括</option>
                                </select></div>
                        </div>

                    </div>

                    <input type="hidden" name="product" value="<?php echo $goods_name; ?>" />
                    <input type="hidden" name="amount" value="<?php echo $goods_price; ?>" />
                    <input type="hidden" name="currency_code" value="JPY" />
                    <input type="hidden" name="shop_tracking" value="<?php echo $order; ?>" />
                    <input type="hidden" name="callback_url" value="<?php echo $callback_url; ?>" />
                    <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>" />
                    <input type="hidden" name="shop_data1" value="" />
                    <input type="hidden" name="shop_data2" value="<?php echo $goods_id; ?>" />
                    <input type="hidden" name="shop_data3" value="" />

                    <input type="hidden" id="api_token" value="<?php echo BPM_CLIENT_IP; ?>">
                    </form>

                    <div class="sp"><a href="#" onclick="submit_sp()"><div class="sppbtn"><img src="https://www.kabu-college.com/LP/pay-f-new/img/spbtn.png"></div></a></div>

                    <div class="white_box mb20">

                        <div class="wtitle">注文する商品</div>

                        <div class="com_list">
                            <ul>
                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e3.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">先乗り株カレッジ</div><div class="title3"></div></div><div class="num">350,000<span>円</span></div></li>
                            </ul>
                        </div>

                    </div>

                    <div class="num_set">
                        <ul>
                            <li><div class="title_set"><div class="title2">小計</div></div></li>
                            <li><div class="num">350,000<span>円（税別）</span></div></li>
                        </ul>
                    </div>

                    <div class="tokuten_title">更に、以下が特典として無料で付属されます</div>


                    <div class="white_box">

                        <div class="wtitle">付属する商品</div>

                        <div class="com_list">
                            <ul>
                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e7.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">市場の変化を先読みし利益最大化を狙う<br />
                                            「ポイントの日」の活用法＆実践編</div><div class="title3"></div></div><div class="num2">特典プレゼント</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e8.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">新商品発表等のイベントに向かった<br />
                                            株価高騰を捉える手法</div><div class="title3"></div></div><div class="num2">特典プレゼント</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e9.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">規制解除後の高確率反転を狙った<br />
                                            短期利食い手法</div><div class="title3"></div></div><div class="num2">特典プレゼント</div></li>

								<li class="pborder"><div class="th"><img src="img/e20.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">信用期日狙いの高確率利食い手法</div><div class="title3"></div></div><div class="num2">特典プレゼント</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e10.png"></div><div class="title_set"><div class="title1">自動ツール（６か月間）</div><div class="title2">「自動お宝発見ツール」利用権</div><div class="title3"></div></div><div class="num2">セット商品</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e11.png"></div><div class="title_set"><div class="title1">オンライン補講コミュニティ（６か月間）</div><div class="title2">「お宝銘柄発掘ディスカッション」参加権</div><div class="title3"></div></div><div class="num2">セット商品</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e12.png"></div><div class="title_set"><div class="title1">追加指導＆交流（６か月間）</div><div class="title2">「月１～2回の定例セミナー」参加権</div><div class="title3"></div></div><div class="num2">セット商品</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e13.png"></div><div class="title_set"><div class="title1">半自動システム（６か月間）</div><div class="title2">「簡単日記システム」利用権</div><div class="title3"></div></div><div class="num2">セット商品</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e14.png"></div><div class="title_set"><div class="title1">サポート（６か月間）</div><div class="title2">回数無制限、電話＆メールサポート</div><div class="title3"></div></div><div class="num2">セット商品</div></li>


                            </ul>
                        </div>

                    </div>




                    <div class="white_box">

                        <div class="wtitle">支払い方法</div>

                        <div class="paylist">
                            <div class="ptitle">▶クレジットカード：一括のみ</div>
                            <ul>
                                <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/e15.png"></li>
                                <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/e16.png"></li>
                                <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/e17.png"></li>

                            </ul>

                            <div class="ptitle">▶銀行振込：一括のみ</div>

                        </div>

                    </div>

                    <div class="sp"><a href="#" onclick="submit_card()"><div class="sppbtn"><img src="https://www.kabu-college.com/LP/pay-f-new/img/spbtn.png"></div></a></div>

                    <div class="ssl_box">
                        <ul>
                            <li>
                                <div class="stitle">安全のための取り組み</div>
                                <div class="stxt">お客様情報はSSL暗号化技術を利用して厳重に送信いたします。<br />
                                    また、ご入力いただいたカード情報はテレコムクレジット株式会社に決済代行を委託しております。<br />
                                    当社では保存されませんのでご安心ください。転売など、当社が不都合と判断した場合は<br />
                                    ご購入をお断りさせていただくことがございます。予めご了承ください。</div>
                            </li>
                            <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/ssl.png"></li>
                        </ul>

                    </div>


                </div>


                <div class="p_left pc">

                    <div class="cart_box">
                        <div class="ctitle">ご注文者情報</div>

                        <div class="cnum">
                            <ul>
                                <li>通常価格</li>
                                <li>350,000円</li>

                            </ul>
                        </div>
                        <div class="cnum gborder">
                            <ul>

                                <li>消費税</li>
                                <li>35,000円</li>
                            </ul>
                        </div>

                        <div class="cnum mb20">
                            <ul>

                                <li>今回のご請求額</li>
                                <li class="cred">385,000円</li>
                            </ul>
                        </div>

                        <div class="pbtn"><a href="#" onclick="submit_card()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                        <div class="pbtn"><a href="#" onclick="submit_bank()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/b_btn.png"></a></div>

                        <div class="ptxt">いずれかの決済方法を選んで<br />
                            ボタンを押してください。<br />
							<br />
							返金（返品）については<br />
							<a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">こちら</a>をご確認ください。<br />
						</div>

                    </div>


                </div>

            </div>


        </div>
    </li>






    <li class="cl">


<div class="f_menu">
<ul>
<li><a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">特定商取引法に基づく表示</a></li>
<li><a href="https://www.kabu-college.com/LP/pay/privacy.html" target="_blank">プライバシーポリシー</a></li>
</ul>
</div>


        Copyright (C) 先乗り投資法 - All Rights Reserved.
    </li>



</ul>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel" style="color:red">既に登録されているユーザー情報です。</h4>
            </div>
            <div class="modal-body" style="font-size: 18px">
                登録日時：<span class="add_time"></span></br>
                名前：<span class="add_name"></span></br>
                カナ：<span class="add_name_phonetic"></span></br>
                電話番号：<span class="add_tel"></span></br>
                メールアドレス：<span class="add_email"></span></br><br>
                前回のご注文を取り消して、</br>
                <span class="pay_type"></span> 新規のご注文でよろしいですか？
            </div>
            <div class="modal-footer" style="text-align: center;font-size: 18px">
                <button type="button" class="btn btn-primary" onclick="addNewInfo()" style="width: 100px;font-size: 18px" >はい</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width: 100px;font-size: 18px;background: #dd4b39;border-color: #dd4b39" >いいえ</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<input type="hidden" name="type" class="info_type"/>
<input type="hidden" name="type" class="info_replay"/>


<script src="https://www.kabu-college.com/LP/pay/js/jquery-2.2.4.min.js"></script>
<script src="/LP/pay/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://www.kabu-college.com/enq/reception/js/kana.js"></script>

<script>
    $(function () {
        $.fn.autoKana2('#name', '#name_kana', {
            katakana: true  //true：カタカナ、false：ひらがな（デフォルト）
        });
    });

</script>




<script>
    function checkMobile(str) {

        var re = /^0(50|70|80|90)\d{8}$/
        var re10 = /^\d{10}$/
        if (re10.test(str)) {
            return 0;
        }

        if (re.test(str)) {
            return 0;
        } else {
            return 1;
        }
    }
    var preInfo = [];
    function checktel() {
        //#b94a48
        $('#tel').css("border-color",'#999999');
        var code=1;
        if($('#tel').val()==''){
            $('#tel').css('border-color','#b94a48');
            $('.error-tel').html('電話番号を入力してください。');
            $('.error-tel').show();
            return code;
        }
        if(checkMobile($('#tel').val())){
            $('#tel').css('border-color','#b94a48');
            $('.error-tel').html('電話番号の形式が正しくありません。');
            $('.error-tel').show();
            return code;
        }

        // if(code==1){
        //     $('.error-tel').show();
        //     $('#tel').css('border-color','#b94a48');
        // }
        // return code;
    }
    function checkemail() {
        $('#email').css("border-color",'#999999');
        var code=1;

        if($('#email').val()==''){
            $('#email').css('border-color','#b94a48');
            $('.error-email').html('メールアドレスを入力してください。');
            $('.error-email').show();
            return code;
        }
        if(!emailCheck($('#email').val())){
            $('#email').css('border-color','#b94a48');
            $('.error-email').html('メールアドレスの形式が正しくありません。');
            $('.error-email').show();
            return code;
        }
    }
    function check() {
        $('input[type="text"]').css("border-color",'#999999');

        $('.error-tip').hide();

        var  error = 0;

        if($('#name').val()==''){
            $('#name').css('border-color','#b94a48');
            $('.error-name').show();
            error =1;
        }

        if($('#name_kana').val()==''){
            $('#name_kana').css('border-color','#b94a48');
            $('.error-name_kana').show();
            error =1;
        }

        var checkTel = checktel();
        if(checkTel==1){
            error =1;
        }

        var checkemial = checkemail()
        if(checkemial == 1){
            error =1;
        }

        if (error != 1) {
            $.ajax({
                url:"",
                type:"post",
                async: false,
                dataType: 'json',
                data: {'email':$('#email').val(),'tel':$('#tel').val(),'check':'1'},
                success:function(data){
                    var data=data.code;

                    if($.inArray(1, data.code) >= 0) {
                        $('.error-tel').html('電話番号の形式が正しくありません。')
                        $('.error-tel').show();
                        $('#tel').css('border-color','#b94a48');
                        return false;
                    }
                    if($.inArray(2, data.code) >= 0) {
                        $('.error-tel').html('既に登録されている番号です。');
                        $('.error-tel').show();
                        $('#tel').css('border-color','#b94a48');
                    }
                    if($.inArray(3, data.code) >= 0){
                        $('.error-email').show();
                        $('.error-email').html('すでに登録されているメールアドレスです。');
                        $('#email').css('border-color','#b94a48');
                    }
                    if ($.inArray(2, data.code) >= 0 || $.inArray(3, data.code) >= 0 ){
                        preInfo = data.msg;
                        showPreInfo(preInfo)
                    }else{
                        addNewInfo()
                    }
                },
                error:function (re) {
                    console.log(re)
                }
            })
        } else {
            return error;
        }
    }

    function submit_reg(type) {
        $('.info_type').val(type);
        $('.info_replay').val(0);
        if(check()==1){
            // 弹窗
            return;
        }
    }
    function showPreInfo(preInfo) {
        $('.add_time').html(preInfo.created_at);
        $('.add_name').html(preInfo.name);
        $('.add_name_phonetic').html(preInfo.name_phonetic);
        $('.add_tel').html(preInfo.tel);
        $('.add_email').html(preInfo.mail_address);
        var type = $('.info_type').val()
        if (type == 0) {
            str = '銀行決済'
        }
        if (type == 1) {
            str = 'クレジット決済'
        }
        $('.pay_type').html(str);
        $('#myModal').modal('show');
        $('.info_replay').val(1);
        return ;
    }

    function addNewInfo() {
        var type = $('.info_type').val()
        var info_replay = $('.info_replay').val()
        var goods_price = <?php echo $goods_price; ?>;
        var redirect_url = <?php echo "'".$redirect_url."'"; ?>;
        $.ajax({
            url:"",
            type:"post",
            async: false,
            dataType: 'json',
            data: {
                'name':$('#name').val(),
                'name_kana':$('#name_kana').val(),
                'tel':$('#tel').val(),
                'email':$('#email').val(),
                'info_replay':$('.info_replay').val(),
                'type':type,
            },
            success:function(data){
                if(data.code==1) {
                    alert('error')
                }
                if(data.code==0) {
                    if(type==1) {
                        $('input[name="shop_data1"]').val(data.id);
                        $('#pay').submit();
                    }else {
                        location.href = '/LP/thx1/thx2.php';
                    }
                }
            },
            error:function (data) {
                console.log(data)
            }
        });
    }

    function submit_card() {
        submit_reg(1);
    }

    function submit_bank() {
        submit_reg(0);
    }

    function submit_sp() {
        var card_sp = $("select[name='card_sp']").val();
        if (card_sp == '1') {
            submit_reg(1);
        } else if (card_sp == '0') {
            submit_reg(0);
        }
    }

    if(navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)){
        $(function(){
            var target1 = $("#parallax-01");
            var targetPosOT1 = target1.offset().top;


            var targetFactor = 0.5;
            var windowH = $(window).height();
            var scrollYStart1 = targetPosOT1 - windowH;


            $(window).on('scroll',function(){
                var scrollY = $(this).scrollTop();
                if(scrollY > scrollYStart1){
                    target1.css('background-position-y', (scrollY - targetPosOT1) * targetFactor + 'px');
                }else{
                    target1.css('background-position','center top');
                }


            });
        });
    }

</script>


<script src="https://www.kabu-college.com/LP/pay/js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://www.kabu-college.com/LP/pay/js/css3-animate-it.js"></script>

<script src="https://www.kabu-college.com/LP/pay/js/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    $(document).ready(function(){
        $.doTimeout(7000, function(){
            $('.repeat2.go').removeClass('go');
            return true;
        });
        $.doTimeout(7020, function(){
            $('.repeat2').addClass('go');
            return true;
        });

    });

</script>
<script>
    $(function(){
        $(window).scroll(function (){
            $('.alpha-target').each(function(){
                var position = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > position - windowHeight + 200){
                    $(this).addClass('active');
                }
            });
        });
    });
</script>

<script>
    if (navigator.userAgent.indexOf('iPhone') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('iPhone');
    }

    if (navigator.userAgent.indexOf('Macintosh') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('Macintosh');
    }
    if (navigator.userAgent.indexOf('iPad') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('iPad');
    }

    if (navigator.userAgent.indexOf('Android') > 0) {
        let body = document.getElementsByTagName('body')[0];
        body.classList.add('Android');
    }
    function emailCheck (email) {
        var listd = [
            'gmail.com',
            'yahoo.co.jp',
            'icloud.com',
            'outlook.jp',
            'hotmail.com',
            'ybb.ne.jp',
            'nifty.com',
            'me.com',
            'hotmail.co.jp',
            'yahoo.com'
        ];
        console.log(getCaption(email),jQuery.inArray( getCaption(email), listd ));

        if(jQuery.inArray( getCaption(email), listd )> -1){
            $('.annotation').hide()
        }else{
            $('.annotation').show()
        }
        var emailPat = /^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/;
        var matchArray = email.match(emailPat);
        if (matchArray == null) {

            return false;
        }
        if (email.indexOf("'") !== -1 || email.indexOf('"') !== -1) {
            return false;
        }
        return true;
    }
    function getCaption(obj){

        var index=obj.lastIndexOf("\@");
        obj=obj.substring(index+1,obj.length);
// console.log(obj);
        return obj;
    }
</script>



<script src="/LP/common/jquery.cookie.min.js"></script></body>
</html>

