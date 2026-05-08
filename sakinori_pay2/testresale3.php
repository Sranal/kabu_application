<?php
$goods_ids= ['1981'];
require_once __DIR__.'/../common/pay_header.php';
$pay_url = 'https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl?clientip='.$client_ip.'&image=neo';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>先乗り株カレッジ ネオ</title>

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

            <div class="e1"><img src="img/neo2.png" data-aos="fade-up" data-aos-easing="ease-out-cubic"
                                 data-aos-duration="300" data-aos-delay="300"></div>
            <div class="e2"><img src="img/neo1.png" data-aos="fade-up" data-aos-easing="ease-out-cubic"
                                 data-aos-duration="300" data-aos-delay="300"></div>

        </div>
    </li>

    <li class="p2">
        <div class="content2 p2h">
            <div class="p_box">
                <div class="p_right">
					<div class="tokuten_img">
                        <img src="img/neotokubetu.png">
                    </div>
					<div class="nokorikikan_img">
                       <script type="text/javascript" src="https://step.lme.jp/wm-popup/WM4K89sp1684551294.js"></script>
                    </div>
					
					
                    <div class="title">ご購入手続きへ進む</div>
                    <div class="txt">注文する商品をご確認いただき、よろしければご注文者情報を入力して、<br/>
                        ご希望の決済方法のボタンを押して次にお進みください。
                    </div>

                    <div class="form_box">
                        <div class="ftitle">ご注文者情報</div>
                        <input type="hidden" id="user_id" name="user_id" />

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

                        <input type='hidden' name='goods_id' class='goods_id' value='1981'>
                        <div class="sp">
                            <div class="ftitle">お支払方法</div>
                            <div class="form_sp">
                                <select name="card_sp">
                                    <option value="1">クレジットカード一括</option>
                                    <option value="0">銀行振込一括</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="sp"><a href="#" onclick="submit_sp()">
                            <div class="sppbtn"><img src="img/spbtn.png"></div>
                        </a></div>

                    <div class="white_box mb20">

                        <div class="wtitle">注文する商品</div>

                        <div class="com_list">
                            <ul>
                                <li class="pborder">
                                    <div class="th"><img src="img/e3.png"></div>
                                    <div class="title_set">
                                        <div class="title1">継続会員</div>
                                        <div class="title2">「先乗り株カレッジ・ネオ」</div>
                                        <div class="title3"></div>
                                    </div>
                                    <div class="num">
                                        <div class="campain_txt">6ヶ月分 一括払い金額</div>
                                        198,000<span>円</span></div>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="num_set">
                        <ul>
                            <li>
                                <div class="title_set">
                                    <div class="title2">月額 33,000 円×６ヶ月=</div>
                                </div>
                            </li>
                            <li>
                                <div class="num">198,000<span>円（税込）</span></div>
                            </li>
                        </ul>
                    </div>

                    <div class="tokuten_title">【安心と信頼の継続保障】</div>

                    <div class="tokuten_txt">
                        1. ネオ（継続会員）の開始日は、先乗り株カレッジの６ヶ月が満了した翌日か
                        らになります。
                        早めに申し込んでも損することはありませんのでご安心ください。
                    </div>

                    <div class="tokuten_txt">
                        2. ７カ月目以降は、月払い継続会員に自動更新
                        ⇒いつでも解約可
                    </div>
                    <div class="tokuten_img">
                        <img src="img/neo3.png">
                    </div>

                    <div class="tokuten_title">６ヶ月分を一括払いすることにより、<br/>
                        以下が追加で「無料プレゼント」されます。
                    </div>


                    <div class="white_box">

                        <div class="wtitle">付属する商品</div>

                        <div class="com_list">
                            <ul>

								
                                <li class="pborder">
                                    <div class="th"><img src="img/e12.png"></div>
                                    <div class="title_set">
                                        <div class="title1">特別特典</div>
                                        <div class="title2">次回から定例セミナー無料<br/>次回の対面セミナー懇親会を必ずご案内</div>
                                        <div class="title3">※懇親会のご案内は次回のみに限り</div><div class="title3">※開催場所や日時は未定</div>
                                    </div>
                                    <div class="num2"><b>期間限定</b></div>
                                </li>
								
                                <li class="pborder">
                                    <div class="th"><img src="img/e6.png"></div>
                                    <div class="title_set">
                                        <div class="title1">７万円から１億円を達成させた本人による</div>
                                        <div class="title2">「決算ギャンブルの手法」<br/>「リアルタイム銘柄配信サービス」</div>
                                        <div class="title3">※初期費用：110,000円（6ヶ月間)＆7ヶ月目以降：月額11,000円が無料</div>
                                    </div>
                                    <div class="num2">
                                        <div class="car_txt">カレッジ継続中は</div>
                                        永久に無料
                                    </div>
                                </li>

                                <li class="pborder">
                                    <div class="th"><img src="img/e5.png"></div>
                                    <div class="title_set">
                                        <div class="title1"></div>
                                        <div class="title2">「業界最高峰の、もっと先乗り情報分析サービス」</div>
                                        <div class="title3">※初期費用：110,000円（6ヶ月間)＆7ヶ月目以降：月額11,000円が無料</div>
                                    </div>
                                    <div class="num2">
                                        <div class="car_txt">カレッジ継続中は</div>
                                        永久に無料
                                    </div>
                                </li>

                                <li class="pborder">
                                    <div class="th"><img src="img/e20.png"></div>
                                    <div class="title_set">
                                        <div class="title1">生放送＆録画配信</div>
                                        <div class="title2">「源太ライブ視聴権」</div>
                                        <div class="title3">※初期費用：132,000円（6ヶ月間)＆7ヶ月目以降：月額22,000円が無料</div>
                                    </div>
                                    <div class="num2">
                                        <div class="car_txt">カレッジ継続中は</div>
                                        永久に無料
                                    </div>
                                </li>


                                <li class="pborder">
                                    <div class="th"><img src="img/e9.png"></div>
                                    <div class="title_set">
                                        <div class="title1">ブルームバーグ、クイック等</div>
                                        <div class="title2">一般には出回らない上流情報の視聴権</div>
                                        <div class="title3">※初期費用：33,000円（6ヶ月間)＆7ヶ月目以降：月額5,500円が無料</div>
                                    </div>
                                    <div class="num2">
                                        <div class="car_txt">カレッジ継続中は</div>
                                        永久に無料
                                    </div>
                                </li>


                                <li class="pborder">
                                    <div class="th"><img src="img/e8.png"></div>
                                    <div class="title_set">
                                        <div class="title1"></div>
                                        <div class="title2">「源太流、プロ投資手法を取得する<br/>基礎＆常識オンライン講座」追加分の視聴</div>
                                        <div class="title3">※コンテンツを順次追加、バージョンアップしてご提供</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>


                                <li class="pborder">
                                    <div class="th"><img src="img/e10.png"></div>
                                    <div class="title_set">
                                        <div class="title1">源太指数</div>
                                        <div class="title2">「自動お宝発見ツール」利用権</div>
                                        <div class="title3">※カレッジ継続中は無制限利用可</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>

                                <li class="pborder">
                                    <div class="th"><img src="img/e7.png"></div>
                                    <div class="title_set">
                                        <div class="title1"></div>
                                        <div class="title2">「源太カレンダー」視聴権</div>
                                        <div class="title3">※カレッジ継続中は無制限利用可</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>

                                <li class="pborder">
                                    <div class="th"><img src="img/e13.png"></div>
                                    <div class="title_set">
                                        <div class="title1">資金管理術</div>
                                        <div class="title2">「簡単日記システム」利用権</div>
                                        <div class="title3">※カレッジ継続中は無制限利用可</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>


                                <li class="pborder">
                                    <div class="th"><img src="img/e11.png"></div>
                                    <div class="title_set">
                                        <div class="title1">オンライン補講コミュニティ</div>
                                        <div class="title2">「お宝銘柄発掘ディスカッション」参加権</div>
                                        <div class="title3">※カレッジ継続中は無制限利用可</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>


                                <li class="pborder">
                                    <div class="th"><img src="img/e14.png"></div>
                                    <div class="title_set">
                                        <div class="title1">サポート</div>
                                        <div class="title2">回数無制限、電話＆メールサポート</div>
                                        <div class="title3">※カレッジ継続中は無制限利用可</div>
                                    </div>
                                    <div class="num2">セット商品</div>
                                </li>
						

                            </ul>
                        </div>

                    </div>


                    <div class="white_box">

                        <div class="wtitle">支払い方法</div>

                        <div class="paylist">
                            <div class="ptitle">▶クレジットカード：分割可能</div>
                            <ul>
                                <li><img src="img/e15.png"></li>
                                <li><img src="img/e16.png"></li>
                                <li><img src="img/e17.png"></li>
                                <li><img src="img/e18.png"></li>
                                <li><img src="img/e19.png"></li>
                            </ul>

                            <div class="ptitle">▶銀行振込：一括のみ</div>

                        </div>

                    </div>

                    <div class="sp"><a href="#">
                            <div class="sppbtn" onclick="submit_card()"><img src="img/spbtn.png"></div>
                        </a></div>

                    <div class="ssl_box">
                        <ul>
                            <li>
                                <div class="stitle">安全のための取り組み</div>
                                <div class="stxt">お客様情報はSSL暗号化技術を利用して厳重に送信いたします。<br/>
                                    また、ご入力いただいたカード情報はテレコムクレジット株式会社に決済代行を委託しております。<br/>
                                    当社では保存されませんのでご安心ください。転売など、当社が不都合と判断した場合は<br/>
                                    ご購入をお断りさせていただくことがございます。予めご了承ください。
                                </div>
                            </li>
                            <li><img src="img/ssl.png"></li>
                        </ul>

                    </div>


                </div>


                <div class="p_left pc">

                    <div class="cart_box">
                        <div class="ctitle">ご注文者情報</div>

                        <div class="cnum">
                            <ul>
                                <li>商品小計</li>
                                <li>180,000円</li>

                            </ul>
                        </div>

                        <div class="cnum gborder">
                            <ul>

                                <li>消費税</li>
                                <li>18,000円</li>
                            </ul>
                        </div>

                        <div class="cnum mb20">
                            <ul>

                                <li>今回のご請求額</li>
                                <li class="cred">198,000円</li>
                            </ul>
                        </div>

                        <div class="pbtn"><a href="#" onclick="submit_card()"><img src="img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                        <div class="pbtn"><a href="#" onclick="submit_bank()"><img src="img/b_btn.png"></a></div>

                        <div class="ptxt">いずれかの決済方法を選んで<br/>
                            ボタンを押してください

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
また、投資知識の学習のための参考となる情報の提供を目的としたもので、<br>
特定の銘柄や投資対象について、特定の投資行動や運用手法を推奨するものではありません。 <br>
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

		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

        Copyright (C) 先乗り株カレッジ ネオ - All Rights Reserved.
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
<script src="/member/js/common.js?v=20220726"></script>
<script>
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
    submitForm();
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

    // function goodsInfo(obj,goods_id) {
    //     $('.cp_e2 img').attr('src','/member/onlinePay/img/e2.png')
    //     $('.cp_e3 img').attr('src','/member/onlinePay/img/e3.png')
    //     if (goods_id == '217day') {
    //         $(obj).find('img').attr('src','/member/img/e2_over.png')
    //     } else if((goods_id == '31day')){
    //         $(obj).find('img').attr('src','/member/img/e3_over.png')
    //     }
    //
    //     $(":input[ name = 'goods_id' ]").val(goods_id)
    //     //设置商品id
    //     $.ajax({
    //         url:"",
    //         type:"post",
    //         async: false,
    //         dataType: 'json',
    //         data: {'goods_id':goods_id,'type':'goods_info'},
    //         success:function(data){
    //             if (data.code == 0) {
    //                 $('.goods_n').html(data.info.goods_price)
    //                 $('.goods_x').html(data.info.goods_x)
    //                 $('.xiao').html(data.info.xiao)
    //             }
    //         },
    //         error:function (re) {
    //             console.log(re)
    //         }
    //     })
    // }
    //
    // goodsInfo($('.cp_e2'),'31day')

    function submit_reg(type) {
        $('.info_type').val(type);
        $('.info_replay').val(0);
        if(check()==1){
            // 弹窗
            return;
        }
    }

    function addNewInfo() {
        var type = $('.info_type').val()
        var redirect_url = <?php echo "'".$redirect_url."'"; ?>;
        var pay_url = <?php echo "'".$pay_url."'"; ?>;
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
                'goods_id':$('.goods_id').val(),
                'info_replay':$('.info_replay').val(),
                'type':type,
            },
            success:function(data){
                if(data.code==1) {
                    alert('error')
                }
                if(data.code==0) {
                    $('input[name="shop_data1"]').val(data.id);

                    let goods_price = data.goods_price;
                    let rebill_param_id = data.rebill_param_id;

                    if(type==1) {
                        location.href = pay_url+'&usrmail=' +
                            $('#email').val() + '&usrtel=' + $('#tel').val()+'&sendid=' + data.id
                            + '&redirect_url='+redirect_url + '&money='+goods_price+
                            '&sendid=' + data.id;
                    } else {
                        location.href = '/member/thx4.php';
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
        var emailPat = /^([a-zA-Z0-9])+([a-zA-Z0-9\?\*\[|\]%'=~^\{\}\/\+!#&$\._-])*@([a-zA-Z0-9_-])+\.([a-zA-Z0-9\._-]+)+$/;
        var matchArray = email.match(emailPat);
        if (matchArray == null) {

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

