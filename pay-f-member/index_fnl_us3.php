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
$goods_id= '5';


//$redirect_url = URL_DOMAIN.'/LP/pay/pay_end.html';
$redirect_url = URL_DOMAIN.'/LP/pay/pay_end.html';
$client_ip = CLIENT_IP;
// 获取对应金额
$goods_price = $input_form_obj->getGoodsInfo($goods_id,'goods_price');

/**
 * 根据有效期天数计算金额
 * @param int $valid_days 有效期剩余天数
 * @return array ['billing_amount' => 请求额, 'discount_amount' => 割引额, ]
 */
function calculateAmountByValidDays($valid_days) {
    // 基础请求额（无有效期时的金额）
    $base_amount = 350000; // 通常価格
    $base_discount = 0; // 20万円割引

    if ($valid_days <= 0) {
        // 新用户或无有效期，使用基础金额
        return [
            'billing_amount' => $base_amount - $base_discount, // 350000 請求額
            'discount_amount' => 0,//割引額
        ];
    }

    // 根据有效期天数范围计算金额
    if ($valid_days >= 1 && $valid_days <= 37) {
        $billing_amount = 317000;
        $discount_amount = 33000;
    } elseif ($valid_days >= 38 && $valid_days <= 67) {
        $billing_amount = 284000;
        $discount_amount = 66000;
    } elseif ($valid_days >= 68 && $valid_days <= 97) {
        $billing_amount = 251000;
        $discount_amount = 99000;
    } elseif ($valid_days >= 98 && $valid_days <= 127) {
        $billing_amount = 218000;
        $discount_amount = 132000;
    } elseif ($valid_days >= 128 && $valid_days <= 157) {
        $billing_amount = 185000;
        $discount_amount = 165000;
    } else { // 158日以上
        $billing_amount = 152000;
        $discount_amount = 198000;
    }


    return [
        'billing_amount' => $billing_amount,
        'discount_amount' => $discount_amount,
    ];
}
if (isset($_POST['type']) && $_POST['type'] == 'get_valid_days'){
    if (empty($_POST['tel'])) {
        echo json_encode(['code'=>['amount_info'=>['billing_amount'=>350000,'discount_amount'=>0]],'valid_days'=>0]);die;
    } else {
        // 只用tel查询用户有效期天数，确保不传email参数
        $post_data = ['tel' => $_POST['tel']];
        $valid_days = $input_form_obj->getUserValidDays($post_data);
    }
    if ($valid_days > 0) {
        $amount_info = calculateAmountByValidDays($valid_days);
        echo json_encode(['code'=>['amount_info'=>$amount_info],'valid_days'=>$valid_days]);die;
    } else {
        // 未找到用户或有效期已过，返回默认金额
        echo json_encode(['code'=>['amount_info'=>['billing_amount'=>350000,'discount_amount'=>0]],'valid_days'=>0]);die;
    }
}

if(isset($_POST['check'])){
    // 用户还未支付成功
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
        setcookie('p_oneonone_id',$info['id'],time()+3600,'/');
        setcookie('p_goods_price',$_POST['goods_price'],time()+3600,'/');
        echo json_encode(['code'=>0,'id'=>$info['id']]);die;
        //header("Location:/reservation/thx1-1");
        die;
    }
    echo json_encode(['code'=>1]);die;
}
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

<!--
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PWJHKGB"

                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
-->

<!-- End Google Tag Manager (noscript) -->
<div class="e2"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e2.png" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="300" data-aos-delay="300"></div>

<ul>


    <li class="fnl_us3_p1">
        <div class="content fnl_us3_p1h">

            <div class="fnl_us2_02"><img src="https://www.kabu-college.com/LP/pay-f-new/img/fnl_us3_02.png" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="300" data-aos-delay="300"></div>


        </div>
    </li>

    <li class="p2">
        <div class="content2 p2h">
            <div class="p_box">
                <div class="p_right">
                    <div class="title">ご購入手続きへ進む</div>
                    <div class="txt pc">注文する商品をご確認いただき、よろしければご注文者情報を入力して、<br />
                        ご希望の決済方法のボタンを押して次にお進みください。</div>
                    <div class="txt sp">ご注文者情報を入力しお支払い方法を選択して「決済画面へ進む」を押してください。</div>
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

                        <!--<div class="sp">
                            <div class="ftitle">お支払方法</div>
                            <div class="form_sp"><select name="card_sp">
                                    <option value="1">クレジットカード（分割可）</option>
                                    <option value="0">銀行振込一括</option>
                                </select></div>
                        </div>-->

                    </div>

                    <!--<div class="sp"><a href="#" onclick="submit_sp()"><div class="sppbtn"><img src="https://www.kabu-college.com/LP/pay-f-new/img/spbtn.png"></div></a>-->

                    <div class="sp">
                        <div class="pbtn"><a href="#" onclick="submit_card()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                        <div class="pbtn"><a href="#" onclick="submit_bank()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/b_btn.png"></a></div>
                    </div>


                    <!--<div class="stxt" style="margin:0 0 5% 0">返金（返品）については
                        <a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">こちら</a>をご確認ください。</div>-->


                    <div class="white_box mb20">

                        <div class="wtitle">注文する商品</div>

                        <div class="com_list">
                            <ul>
                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e3.png"></div><div class="title_set"><div class="title1">【梅】スタンダード</div><div class="title2">プロ思考・個人実践プログラム</div><div class="title3"></div></div>
                                    <div class="num">440,000<span>円（税込）</span></div>
                                </li>
                                
                                <li class="member_special_discount" style="display: none;">
                                    <div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e4.png"></div>
                                    <div class="title_set"><div class="title1"></div>
                                        <div class="title2">現会員特别割引</div><div class="title3"></div></div>
                                    <div class="num cred ">
                                        ▲<div class="special_amount" style="display: inline-block;">0</div><span>円引き</span></div></li>
                            </ul>
                        </div>

                    </div>

                    <!-- <div class="num_set">
 <li><div class="title_set"><div class="title2">割引後の商品小計</div><div class="title3">※３日間限定特別価格</div></div></li>
                         <li><div class="num">300,000<span>円(税別)</span></div></li>
 </div>-->
                    <div class="num_set set2 sp">
                        <ul>
                            <li><div class="title_set"><div class="title2">消費税</div></div></li>
                            <li><div class="num">30,000<span>円</span></div></li>
                        </ul>
                    </div>
                    <div class="num_set set3 sp">
                        <ul>
                            <li><div class="title_set"><div class="title2">今回ご請求額</div></li>
                            <li><div class="num">330,000<span>円</span></div></li>
                        </ul>
                    </div>

                    <div class="wtitle">【梅】スタンダード</div><div class="tokuten_title">『プロ思考・個人実践プログラム』に付属する商品</div>


                    <div class="white_box">

                        <!--<div class="wtitle">付属する商品</div>-->

                        <div class="com_list">
                            <ul>
                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e5.png"></div><div class="title_set"><div class="title1">不定期レポート＆メッセージ配信（６カ月間）</div><div class="title2">富のカンニングペーパー：<br /></div>
                                            <div class="tokuten_title">『プロの自腹・銘柄選定「生」ログ』</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e6.png"></div><div class="title_set"><div class="title1">不定期チェック（６カ月間）</div><div class="title2">分析のズレを即座に矯正：</div> <div class="tokuten_title">源太直伝『最終ロジック監査』</div></li>

                                <li class="pborder e9_anchor"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e8.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">資産100倍をさらに加速：</div><div class="tokuten_title">『超加速・錬金ブースター４選』</div><div class="title1">※コンテンツには以下の4つが含まれます</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e9.png"></div><div class="title_set"><div class="tokuten_title">①　ポイントの日・最終実践編</div><div class="title1">ハゲタカの運用サイクルを逆手に取った利益最大化</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e10.png"></div><div class="title_set"><div class="tokuten_title">②　イベント・ドリブン爆速先取り法</div><div class="title1">新商品発表などのイベントなど、<br>ハゲタカが仕掛ける「上昇気流」で利益最大化</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e11.png"></div><div class="title_set"><div class="tokuten_title">③　規制解除V字ブースト・短期急騰術</div><div class="title1">信用規制解除の爆発エネルギーで、<br>短期間で資産をV字成長させるブースター</div></li>

                                <li class="pborder reset_anchor"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e12.png"></div><div class="title_set"><div class="tokuten_title">④　信用期日「強制点火」狙い手法</div><div class="title1">ハゲタカが仕掛けた空売りの、<br>期限切れ強制買いを狙い撃ちした爆益手法</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e13.png"></div><div class="title_set"><div class="title1">デジタルコンテンツ（視聴期限無し）</div><div class="title2">罠を逆利用して『爆益』に変える：</div><div class="tokuten_title">『ハゲタカ識別・板読みスキャナー』</div></li>
								
								<li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e13.png"></div><div class="title_set"><div class="title1">情報配信サービス（６カ月間）</div><div class="title2">富の先乗り強奪：</div><div class="tokuten_title">最上流『情報分析・速報レポート』</div></li>
								
								<li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e13.png"></div><div class="title_set"><div class="title1">情報配信サービス（６カ月間）</div><div class="title2">伝説の1428倍を徹底再現：</div><div class="tokuten_title">満中直伝『決算攻略・錬金プロトコル』</div></li>

                                <li class="pborder"><div class="th"><img src="https://www.kabu-college.com/LP/pay-f-new/img/e14.png"></div><div class="title_set"><div class="title1">シークレット交流（６カ月間）</div><div class="title2">最上流の情報と真の選民階級へ：</div><div class="tokuten_title">『億り人養成・シークレット晩餐会』</div></li>


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
                                <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/e18.png"></li>
                                <li><img src="https://www.kabu-college.com/LP/pay-f-new/img/e19.png"></li>

                            </ul>

                            <div class="ptitle">▶銀行振込：一括のみ</div>

                        </div>

                    </div>
					
					<div class="stxt" style="margin:0 0 5% 0">返金（返品）については
                        <a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">こちら</a>をご確認ください。</div>

                    <!--<div class="sp"><a href="#" onclick="submit_card()"><div class="sppbtn"><img src="https://www.kabu-college.com/LP/pay-f-new/img/spbtn.png"></div></a></div>-->

                    <div class="sp">
                        <div class="pbtn"><a href="#" onclick="submit_card()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                        <div class="pbtn"><a href="#" onclick="submit_bank()"><img src="https://www.kabu-college.com/LP/pay-f-new/img/b_btn.png"></a></div>
                    </div>

                    <div class="ssl_box">
                        <ul>
                            <li>
                                <div class="stitle">安全のための取り組み</div>
                                <div class="stxt">お客様情報はSSL暗号化技術を利用して厳重に送信いたします。<br />
                                    また、ご入力いただいたカード情報は株式会社CREDIXに決済代行を委託しております。<br />
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
                                <li>440,000円（税込）
                                    <div class="cnum gborder">
                                        <!--<ul>
                                            <li>消費税</li>
                                            <li>50,000円</li>
                                        </ul>-->
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <!--<div class="cnum gborder">
                            <ul>

                                <li class="">割引額</li>
                                <li class="">▲50,000円</li>
                            </ul>
                            <ul class="member_special_discount_pc" style="display: none;">
                                <li class="cred">現会員特别割引</li>
                                <li class="cred special">▲<span class="special_amount">0</span>円</li>
                            </ul>
                        </div>-->
                        <div class="cnum mb20">
                            <ul>

                                <li>今回のご請求額</li>
                                <li class="cred total"><span class="billing_amount">440,000</span>円</li>
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


	<div class="ptxt">株式投資で夢と感動を</div>
	<div class="ptitle">株式会社カイザー<br>　</div>
		
        <div class="f_menu">
            <ul>
                <li><a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">特定商取引法に基づく表示</a></li>
                <li><a href="https://www.kabu-college.com/LP/pay/privacy.html" target="_blank">プライバシーポリシー</a></li>
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





































        2016 © Sakinori KABU College.co.Ltd All rights reserved.
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
                メールアドレス：<span class="add_email"></span></br>
                <br>
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
<div class="modal fade" id="myModalNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel" style="color:red"></h4>
            </div>
            <div class="modal-body" style="font-size: 18px;text-align: left">
                ご入力いただきました情報で<br>
                こちらの商品は既にご購入済みのため<br>
                ご購入することはできません。<br><br>
                ご不明点があれば<br>
                サポートまでお問合せください。<br><br>

                mail：mail@kabu-sakinori.com<br>
                電話：050-5491-2858　（9：00-18：00）<br>
            </div>
            <div class="modal-footer" style="text-align: center;font-size: 18px">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<input type="hidden" name="type" class="info_type"/>
<input type="hidden" name="type" class="info_replay"/>


<script src="/LP/pay/js/jquery-2.2.4.min.js"></script>
<script src="/LP/pay/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://www.kabu-college.com/enq/reception/js/kana.js"></script>

<script>
    $(function () {
        $.fn.autoKana2('#name', '#name_kana', {
            katakana: true  //true：カタカナ、false：ひらがな（デフォルト）
        });

        // 页面加载时，确保現会員特别割引默认隐藏
        $('.member_special_discount').hide();
        $('.member_special_discount_pc').hide();

        // 只用tel匹配用户，当用户输入电话后自动检查并更新金额
        $('#tel').on('blur', function() {
            if ($('#tel').val()) {
                // 延迟执行，避免频繁请求
                clearTimeout(window.amountCheckTimeout);
                window.amountCheckTimeout = setTimeout(function() {
                    checkAndUpdateAmount();
                }, 500);
            } else {
                // 如果输入框被清空，隐藏現会員特别割引
                $('.member_special_discount').hide();
                $('.member_special_discount_pc').hide();
                $('.billing_amount').text('350,000');
                currentAmountInfo = null;
            }
        });
    });

    // 检查并更新金额（不显示错误信息）- 只用tel匹配用户
    function checkAndUpdateAmount() {

        $.ajax({
            url:"",
            type:"post",
            async: false,
            dataType: 'json',
            data: {'tel':$('#tel').val(),'type':'get_valid_days'},
            success:function(data){
                // 后端返回格式：{'code'=>['amount_info'=>$amount_info],'valid_days'=>$valid_days}
                if (data && data.code && data.code.amount_info) {
                    updateAmountDisplay(data.code.amount_info);
                }
            },
            error:function (re) {
                // 静默失败，不影响用户体验
                console.log('金额更新失败:', re);
            }
        });
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
    var currentAmountInfo = null; // 存储当前金额信息

    // 更新页面显示的金额
    function updateAmountDisplay(amountInfo) {
        if (amountInfo && amountInfo.discount_amount !== undefined) {
            // 只有当有折扣金额（discount_amount > 0）时才显示現会員特别割引
            if (amountInfo.discount_amount > 0) {
                // 更新现会员特别割引额
                $('.special_amount').text(amountInfo.discount_amount.toLocaleString('ja-JP'));

                // 显示現会員特别割引部分（SP端和PC端）
                $('.member_special_discount').show();
                $('.member_special_discount_pc').show();
            } else {
                // 如果没有折扣，隐藏現会員特别割引
                $('.member_special_discount').hide();
                $('.member_special_discount_pc').hide();
            }

            // 更新最终请求额
            $('.billing_amount').text(amountInfo.billing_amount.toLocaleString('ja-JP'));

            // 存储金额信息供后续使用
            currentAmountInfo = amountInfo;
        }
    }

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
        if (currentAmountInfo) {
            goods_price = currentAmountInfo.billing_amount;
        } else {
            goods_price = goods_price;
        }
        var redirect_url = <?php echo "'".$redirect_url."'"; ?>;
        var client_ip = <?php echo "'".$client_ip."'"; ?>;
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
                'goods_price':goods_price,
                'type':type,
            },
            success:function(data){
                if(data.code==1) {
                    alert('error')
                }
                if(data.code==0) {
                    if(type==1) {
                        location.href = 'https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl?clientip='+client_ip+'&usrmail=' +
                            $('#email').val() + '&usrtel=' + $('#tel').val() + '&redirect_url='+redirect_url + '&money='+goods_price+'&sendid=' + data.id;
                    }else {
                        location.href = '/LP/thx1/thx1.php';
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



<script src="/LP/common/jquery.cookie.min.js"></script></body>
</html>

