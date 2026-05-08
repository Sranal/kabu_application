<?php
$goods_ids= ['a7-error'];
require_once __DIR__.'/../common/pay_header.php';
$pay_url = 'https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>先乗り株カレッジ ネオ</title>

    <style>
        #body{
            display: none;
        }
    </style>
</head>

<body id="body">

<form method="post" id="pay" >
    <div class="form_box">
        <div class="ftitle">ご注文者情報</div>
        <div class="form_e">
            <input name="name" disabled id="name" type="text" value="<?php echo isset($user_info['name']) ? $user_info['name'] : ''; ?>" placeholder="氏名"  />
            <p class="error-tip error-name">お名前を入力してください。</p>
        </div>
        <div class="form_e">
            <input name="name_kana" disabled id="name_kana" type="text" value="<?php echo isset($user_info['name_phonetic']) ? $user_info['name_phonetic'] : ''; ?>"  placeholder="フリガナ" />
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
        <input type='hidden' name='goods_id' class='goods_id' value='<?php echo $goods_ids[0]; ?>'>

        <div class="sp form_e">
            <div class="ftitle">お支払方法</div>
            <div class="form_sp"><select name="card_sp">
                    <?php if($isShowP){ ?>
                        <option value="1">クレジットカード一括</option>
                    <?php } ?>
                    <option value="0">銀行振込一括</option>
                </select></div>
        </div>
    </div>


</form>

<script src="/LP/neoa_198/js/jquery-2.2.4.min.js"></script>
<script src="/LP/neoa_198/js/aos.js"></script>
<script src="/LP/common/jquery.cookie.min.js"></script></body>

<script>
    function submitForm() {
        var url = window.location.href;/* 获取完整URL */
        var utl_t = window.location.pathname;

        window.sessionStorage.removeItem('redirect_url');
        window.sessionStorage.setItem('redirect_url', url);
        $.ajax({
            type: "POST",
            url: "/contents/api/login_info.php",
            dataType: 'json',
            async: true,
            data: {
                'authkey': $.cookie('authkey')
            },
            success: function (res) {
                if (res.code == 0 && res.message == 'success') {
                    addNewInfo()
                } else {
                    window.location.href = '/member/login.html?a=out1';
                }
            },
            error: function (data) {
                console.log(data)
            }
        });
    }
    submitForm();

    function addNewInfo() {
        var type = 1
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

                    location.href = pay_url+'?clientip='+client_ip+'&usrmail=' +
                        $('#email').val() + '&usrtel=' + $('#tel').val()+'&sendid=' + data.id
                        + '&redirect_url='+redirect_url + '&money='+goods_price+
                        '&sendid=' + data.id;

                }
            },
            error:function (data) {
                console.log(data)
            }
        });
    }

</script>
</html>

