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
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/LpPay.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/LogWrite.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/ProdMailSend.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/enq/class/JapanHoliday.php");
session_start();
$input_form_obj = new InputForm();
$lp_pay_obj = new LpPay();
$pre_reg_email = '';
$goods_id= 'PF';

$redirect_url = URL_DOMAIN . '/LP/thx1/thxpf.php';
$success_url = URL_DOMAIN . '/LP/thx1/thxpf.php';
$error_url = URL_DOMAIN . '/LP/thx1/thxpf.php';
$client_ip_credix = '1011004743';
$pay_url = 'https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl?clientip='.CONTINUE_CLIENT_IP.'&image=neo';
// 获取对应金额
$goods_id = $input_form_obj->getGoodsInfoBygId($goods_id);
$goods_price = $input_form_obj->getGoodsInfo($goods_id,'goods_price');

$user_id = isset($_COOKIE['id']) ? $_COOKIE['id'] : '';
$member_test = isset($_COOKIE['member_test']) ? json_decode($_COOKIE['member_test'],true) : [];
if (empty($user_id)) {   // 记住密码
    $user_id = isset($member_test['id']) ? $member_test['id'] : '';
}
$user_info = [];
if (!empty($user_id)) {
    $user_info = $input_form_obj->queryUserInfo($user_id);
}
// 获取对应金额
if (isset($_POST['check'])) {
    // 邮箱判断是否已经注册  没有则弹窗
    $res = $lp_pay_obj->checkPay($_POST);
    echo json_encode($res);
    die;
}

if (isset($_POST['name'])) {
    $res = $input_form_obj->addStudentLog($_POST, $goods_id);
//    if (isset($_POST['info_replay']) && $_POST['info_replay'] == '1') {
//    }
//    else {
//        $res = $input_form_obj->addNewLp($_POST, $goods_id);
//    }
    if ($res) {
        $info = $input_form_obj->getUserAllInfoFromTel($_POST);
        $mail_address = !empty($info['mail_address']) ? $info['mail_address'] : $info['mail_address2'];
        setcookie('p_email', $info['mail_address'], time() + 3600, '/');
        setcookie('p_name_kana', $info['name_phonetic'], time() + 3600, '/');
        setcookie('p_name_jp', $info['name'], time() + 3600, '/');
        setcookie('p_bank_tel', $info['tel'], time() + 3600, '/');
        setcookie('p_oneonone_id', $info['id'], time() + 3600, '/');
        echo json_encode(['code' => 0, 'id' => $info['id']]);
        die;
        //header("Location:/reservation/thx1-1");
        die;
    }
    echo json_encode(['code' => 1]);
    die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>ポートフォリオ構築術</title>

    <link href="css/aos.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/featherlight.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .error-tip{
            text-align: left;
            color: red;
            display: none;
        }
        #body{
            display: none;
        }
    </style>
</head>

<body id="body">


<ul>


    <li class="p1">
        <div class="content p1h">

            <div class="e1"><img src="img/PF007.png" data-aos="fade-up" data-aos-easing="ease-out-cubic"
                                 data-aos-duration="300" data-aos-delay="300"></div>

        </div>
    </li>

    <li class="p2">
        <div class="content2 p2h">
            <div class="p_box">
                <div class="p_right">
                    <div class="title">ご購入手続きへ進む</div>
                    <div class="txt">ご注文する商品をご確認いただき、よろしければご注文者情報を入力して、<br/>
                        決済方法のボタンを押して次にお進みください。
                    </div>
                    <form id="pay" method="post" action="https://www.kabu-college.com/LP/thx1/thxpf.php">
					<!--
                    <form id="pay" method="post" action="https://secure.credix-web.co.jp/cgi-bin/credit/order.cgi">
						-->
                    <div class="form_box">
                        <div class="ftitle">ご注文者情報</div>
<!--                        <input type="hidden" id="user_id" name="user_id" />-->

                        <div class="form_e">
                            <input name="name" id="name" type="text" value="<?php echo isset($user_info['name']) ? $user_info['name'] : ''; ?>" placeholder="氏名" disabled />
                            <p class="error-tip error-name">お名前を入力してください。</p>
                        </div>
                        <div class="form_e">
                            <input name="name_kana" id="name_kana" type="text" value="<?php echo isset($user_info['name_phonetic']) ? $user_info['name_phonetic'] : ''; ?>" disabled placeholder="フリガナ" />
                            <p class="error-tip error-name_kana">フリガナを入力してください。</p></div>
                        <div class="form_e">
                            <input name="tel" disabled value="<?php echo isset($user_info['tel']) ? $user_info['tel'] : ''; ?>"
                                   oninput="value=value.replace(/[^\d]/g,'')" id="tel" maxlength="11" pattern="[0-9]*" type="text" placeholder="電話番号" />
                            <p class="error-tip error-tel">電話番号の形式が正しくありません。</p></div>
                        <div class="form_e">
                            <input name="email" disabled value="<?php echo isset($user_info['mail_address']) ? $user_info['mail_address'] : ''; ?>"
                                   id="email" type="text" placeholder="メールアドレス" />
                            <p class="error-tip error-email">メールアドレスの形式が正しくありません。</p>
                        </div>

                        <div class="sp">
                            <div class="ftitle">お支払方法</div>
                            <div class="form_sp">
                                <select name="card_sp">
                                    <option value="0">銀行振込一括</option>
                                </select>
                            </div>
                        </div>

                        <input class="" type="hidden" name="clientip" value="<?php echo $client_ip_credix??''; ?>"/>
                        <input class="money" TYPE="hidden" NAME="money" value="">
                        <input class="sendid" TYPE="hidden" NAME="sendid" value="<?php echo $user_id??''; ?>">
                        <INPUT class="telno" TYPE="hidden" NAME="telno" value="">
                        <INPUT class="email" TYPE="hidden" NAME="email" value="">
                        <INPUT class="success_url" TYPE="hidden" NAME="success_url" VALUE="<?php echo $success_url??''; ?>">
                        <INPUT class="failure_url" TYPE="hidden" NAME="failure_url" VALUE="<?php echo $error_url??''; ?>">

                    </div>
                    </form>

                    <div class="sp"><a href="#" onclick="submit_sp()">
                            <div class="sppbtn"><img src="img/spbtn.png"></div>
                        </a></div>

                    <div class="white_box mb20">

                        <div class="wtitle">注文する商品</div>

                        <div class="com_list">
                            <ul>
                                <li class="pborder">
                                    <div class="th"><img src="img/PF002.png"></div>
                                    <div class="title_set">
                                        <div class="title2">「ポートフォリオ構築術」</div>
                                        <div class="title3"></div>
                                    </div>
                                    <div class="num">
                                        68,000<span>円（税込）</span></div>
                                </li>
                            </ul>
                        </div>

						
						
                    </div>
					
					

                    <div class="num_set">
                        <ul>
                            <li>
                                <div class="title_set">
                                    <div class="title2">商品小計=</div>
                                </div>
                            </li>
                            <li>
                                <div class="num">68,000<span>円（税込）</span></div>

                            </li>
                        </ul>
                    </div>





                    <div class="white_box">

                        <div class="wtitle">商品内容</div>

                        <div class="com_list">
                            <ul>

                                <li class="pborder">
                                    <div class="th"><img src="img/PF002.png"></div>
                                    <div class="title_set">
                                        <div class="title1">デジタルコンテンツ（視聴制限無し）</div>
                                        <div class="title2">ポートフォリオ構築術　講義＆解説動画　全３本</div>
                                    </div>
                                </li>

								 <li class="pborder">
                                    <div class="th"><img src="img/PF004.png"></div>
                                    <div class="title_set">
                                        <div class="title1">PDF形式（ダウンロード制限無し）</div>
                                        <div class="title2">ポートフォリオ作成用　自分で書き込める資産配分表</div>
                                    </div>
                                </li>
								





                            </ul>
							<div class="title_set">
								<div class="title1" align=left>
									※本商品の内容は、上記の通り「解説動画」と「PDF」のみとなります。<br/>
									※また本商品は、先乗り株カレッジの卒業生の方を対象とした商品となりますため、コンテンツ内容に関する個別サポートは提供しておりません。動画の視聴方法やお支払い方法など、操作や手続きに関するサポートのみとさせていただきます。ご了承ください。
								</div>
							</div>
						</div>
                    </div>


                    <div class="white_box">

                        <div class="wtitle">支払い方法</div>

                        <div class="paylist">


                            <div class="ptitle">▶銀行振込：一括のみ</div>

                        </div>

                    </div>

                    <div class="pay_txt">
                        ※単体でのご購入の場合は<span>「銀行振込決済」のみ</span>となります。<br/>
                        <br/>
						※お得な「ポートフォリオ構築術」「マイ投資カレンダー作成術」の<br/>
						<span>期間限定セット（65,000円 税込、クレジットカード決済 可）</span>は⇒<a href="/LP/sakinori_pay2_pf/index.php">こちら</a>
						<br/>
                    </div>

                    <div class="sp"><a href="#">
                            <div class="sppbtn" onclick="submit_card()"><img src="img/spbtn.png"></div>
                        </a></div>

                    <div class="ssl_box">
                        <ul>
                            <li>
                                <div class="stitle">安全のための取り組み</div>
                                <div class="stxt">お客様情報はSSL暗号化技術を利用して厳重に送信いたします。<br/>
                                    転売など、当社が不都合と判断した場合はご購入をお断りさせていただくことがございます。<br/>
									予めご了承ください。
                                </div>
                            </li>
                            <li><img src="img/ssl.png"></li>
                        </ul>

                    </div>


                </div>


                <div class="p_left pc">

                    <div class="cart_box">
                        <div class="ctitle">ご注文情報</div>

                        <div class="cnum">
                            <ul>
                                <li>商品小計</li>
                                <li>61,819円</li>

                            </ul>
                        </div>

                        <div class="cnum gborder">
                            <ul>

                                <li>消費税</li>
                                <li>6,181円</li>
                            </ul>
                        </div>

                        <div class="cnum mb20">
                            <ul>

                                <li>今回のご請求額</li>
                                <li class="cred">68,000円</li>
                            </ul>
                        </div>

                        <div class="pbtn"><a href="#" onclick="submit_bank()"><img src="img/b_btn.png"></a></div>

                        <div class="ptxt">決済方法を選んで<br/>
                            ボタンを押してください。

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
                <li><a href="https://www.kabu-college.com/LP/pay/tokusyo.html">特定商取引法に基づく表示</a></li>
                <li><a href="https://www.kabu-college.com/LP/pay/privacy.html">プライバシーポリシー</a></li>
            </ul>
        </div>


		
<br>
<font size="1.5">【免責事項】<br>
当サイトで提供しているコンテンツは、作成時点で得られる情報を元に、<br>
細心の注意を払って作成しておりますが、 その内容の正確性および安全性を保証するものではありません。<br>
また、当社は金融商品取引業の登録を行っていないことから、投資助言業者としてのサービスは提供しておらず、<br>
投資知識の学習のための参考となる情報の提供を目的としたもので、<br>
個別銘柄についての価値やその動向に関する情報の提供、売買の推奨などを行うものではございません<br>
投資に関する最終決定はお客様ご自身の判断でお願いします。<br>
なお、投資によって発生する損益は、すべて投資家の皆様へ帰属します。<br>
当該情報に基づいて被ったいかなる損害についても、<br>
情報提供者及び当社(株式会社カイザー)は一切の責任を負うことはありませんので、ご了承下さい。</font>	

<br>
<br>
<font size="1.5">【ご注意ください】<br>
当サイトの提供しているコンテンツの投資対象や投資手法は元本や利益を保証するものではなく、<br>
相場の変動や金利差により損失が生じる場合がございます。<br>
投資対象や取引の仕組およびリスクについて十分ご理解の上、<br>
お客様ご自身の判断と責任においてお取引いただきますようお願い申し上げます。<br>

信用取引、株価指数先物取引、株価指数オプション取引、<br>
商品先物取引などの保証金・証拠金設定のある投資対象については、<br>
お客様がお預けになった保証金・証拠金額以上のお取引額で取引を行うため、<br>
保証金・証拠金以上の損失が出る可能性がございます。
</font>	

<br>
<br>






		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

        Copyright (C) 先乗り株カレッジ - All Rights Reserved.
    </li>


    <input type="hidden" name="type" class="info_type"/>
    <input type="hidden" name="type" class="info_replay"/>
</ul>


<script src="js/jquery-2.2.4.min.js"></script>


<script>

    if (navigator.userAgent.match(/(iPhone|iPad|iPod|Android)/)) {
        $(function () {
            var target1 = $("#parallax-01");
            var targetPosOT1 = target1.offset().top;


            var targetFactor = 0.5;
            var windowH = $(window).height();
            var scrollYStart1 = targetPosOT1 - windowH;


            $(window).on('scroll', function () {
                var scrollY = $(this).scrollTop();
                if (scrollY > scrollYStart1) {
                    target1.css('background-position-y', (scrollY - targetPosOT1) * targetFactor + 'px');
                } else {
                    target1.css('background-position', 'center top');
                }


            });
        });
    }

</script>


<script src="js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/css3-animate-it.js"></script>

<script src="js/aos.js"></script>
<script src="/LP/common/jquery.cookie.min.js"></script>
<script src="/member/js/common.js"></script>
<script>
    submitForm();
    AOS.init();
</script>
<script>
    $(document).ready(function () {
        $.doTimeout(7000, function () {
            $('.repeat2.go').removeClass('go');
            return true;
        });
        $.doTimeout(7020, function () {
            $('.repeat2').addClass('go');
            return true;
        });

    });

</script>
<script>
    $(function () {
        $(window).scroll(function () {
            $('.alpha-target').each(function () {
                var position = $(this).offset().top;
                var scroll = $(window).scrollTop();
                var windowHeight = $(window).height();
                if (scroll > position - windowHeight + 200) {
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
                    }else if ($.inArray(4, data.code) >= 0){
                        let preInfoNew = data.msg;
                        showPreInfoNew(preInfoNew)
                    } else {
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

    function showPreInfoNew(preInfo) {
        $('#myModalNew').modal('show');
        isSubmitCheck = true
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
                        $('.sendid').val(data.id)
                        $('.telno').val($('#tel').val())
                        $('.email').val($('#email').val())
                        $('.money').val(goods_price)
                        setTimeout(function () {
                            $('#pay').submit()
                        }, 1000);
                    }else {
                        location.href = '/LP/thx1/thxpf.php';
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
        // var emailPat = /^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/;
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

</body>
</html>

