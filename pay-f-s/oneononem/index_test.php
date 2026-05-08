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


$redirect_url = URL_DOMAIN.'/LP/pay/pay_end.html';
$callback_url = URL_DOMAIN.'/LP/pay/pay_end.html';
$cancel_url = URL_DOMAIN.'/LP/pay/oneononem/bpm_payment.php';
// 获取对应金额
$goods_price = $input_form_obj->getGoodsInfo($goods_id,'goods_price');
$goods_name = $input_form_obj->getGoodsInfo($goods_id,'goods_name');
$g_desc = $input_form_obj->getGoodsInfo($goods_id,'g_desc');
$sub_img = $input_form_obj->getGoodsInfo($goods_id,'sub_img');

$order = 'order-'.date('YmdHis'.mt_rand(10,10000));
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>     <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />     <meta http-equiv="Pragma" content="no-cache" />     <meta http-equiv="Expires" content="0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=10.0, user-scalable=yes">
    <title>先乗り投資法</title>

    <link href="css/aos.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/featherlight.min.css" rel="stylesheet" type="text/css" />
    <link href="css/animate.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        .error-tip{
            text-align: left;
            color: red;
            display: none;
        }
    </style>
</head>

<body>


<ul>


    <li class="p1">
        <div class="content p1h">

            <div class="e1"><img src="img/u1.png" data-aos="fade-up" data-aos-easing="ease-out-cubic" data-aos-duration="300" data-aos-delay="300"></div>


        </div>
    </li>



    <li class="p8">
        <div class="content p8h">

            <div class="midashi1">大岩川源太のマンツーマン徹底指導で<br />
                誰よりも早く1億、10億、100億を目指す<br />
                スペシャルコースがあるのですが…</div>

            <div class="midashi2">実は、表で言えない「裏の情報」なども
                こっそりリーク（暴露）してるので、
                もし、あなたがそれを使ったら…
                <div class="head_1"><div class="head_in">今だけ期間限定<br />
                        ボーナス延長中！<br />
                        ＆大幅値引き中！</div></div>
            </div>



            <div class="uptxt">
                大人の事情もありまして、文章では書けないことばかり。そういった裏話は動画で語っておきました。<br />
                プロの投資家も希望してきたこのプログラム。<br />
                彼らからも「源太さんは自分を安売りし過ぎだ」と、かなり手厳しく叱られてしまうほどのお得過ぎるご提案だそうで…ですが私にとっては、年齢的にもこれが最後のご奉仕、貢献で、やりがいもやる気も十分。出せるものは全て出し尽くしてあなたに向き合う覚悟です。<br />
                その詳細については、まずはこちらの動画でご確認ください。
            </div>

            <div class="up_arrow"><img src="img/up_arrow.png"></div>


        </div>
    </li>

    <li class="p9">
        <div class="content p9h">

            <div class="mov1"><div class="youtube">
                    <iframe width="80%" src="https://www.youtube.com/embed/yMv3kjvtrkM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div></div>

            <div class="uptxt">
                From：大岩川源太<br />
                <br />
                <span class="wb">「ほっ、本気ですか…？」</span>
                <br />
                これは、上の動画の内容について、プロの投資家、機関投資家の仲間たちと話をしたとき、最初に言われた言葉です。こう言われるのもムリはありません。なぜなら…<br />
                <br />
                このご提案は、<span class="wb">超極秘な裏情報の数々をシェア</span>したり、個々人の方と<span class="wb">マンツーマンで、私の全てを継承</span>し、<span class="wbu">プロの投資家レベルへと徹底的に育て上げる</span>という、今までならなかなか実現しえなかった内容だからです。<br />
                <br />
                なぜなら、<span class="wb">プロを指導してきた私が、個人の方をプロ並みに育て上げるべく心血を注ぐ。このことの希少性を想像してみて欲しい</span>のです。<br />
                <br />
                私自身、ラジオやらDVDやら証券会社での講演や大口投資家との会合など、恐ろしく忙しく、なかなか時間も取れない身。<br />
                <br />
                想いはあっても、とてもではないですが、全員に対し個別で指導することは不可能です。ですから、今までは可能な限り避けてきたご提案だったのです。<br />
                <br />
                だからこそ、私が対応できるギリギリの「人数限定」で行う事を条件に、今回だけ特別に募集することにしました。<br />
                <br />
                当然、このご提案は一般の方には紹介していません。<br />
                正直、<span class="wb">受け手を選ぶから</span>です。<br />
                <br />
                つまり、このご提案は、先乗り株カレッジの中でも、さらに上流の成功を求める方向け。<br />
                <br />
                私と可能な限り密接につながり、私の思考法や相場の解読能力、セルフイメージの高さをインストールして、レベル０からでも一気にレベル９９にまで引き上げたいと思える、かなり意識の高い方だけが手にすることのできる内容だからです。<br />
                <br />
                そして、今からあなたをその
            </div>


        </div>
    </li>

    <li class="p8">
        <div class="content p8h">

            <div class="midashi1">「完全継承マンツーマンプログラム」に<br />
                ご招待します…</div>


            <div class="uptxt">
                完全継承マンツーマンプログラムは、先乗り株カレッジの中でもさらにスペシャルなアップグレード版。<br />
                <br />
                <span class="wbu">選ばれし精鋭だけが登録できる、人数限定の特別なコース</span>です。<br />
                <br />
                事実、このマンツーマンという形での指導は、先乗り株カレッジの開催を決めるずっと前から、繰り返し要望され続けてきてはいましたが、そのたびに、断り続けてきました。<br />
                <br />
                それでも、毎回毎回何かしらのスクール募集のたびに要望され続けるので、たまには要望に応えてはいたのですが…<br />
                <br />
                それなら<span class="wb">「最後のスクール」を開催する今回くらい、いっそ覚悟を決めて、自分で最初からご提案した方が、受講してくださる方にとっても喜ばしいことでは無いのか？</span><br />
                <br />
                その様に思い、催促されるよりも前に、先にご提案することにしたのです。<br />
                <br />
                ですから、人数限定なのは当然ですし、売込みするつもりも一切ありません。<br />
                売り込まれる感覚みたいに感じるのが好きではない方は、このままページを閉じて頂いても全然かまわないのです。<br />
                <br />
                ですが、それなりの<span class="wb">強いニーズ</span>があるのも事実。<br />
                <br />
                ですから、「マンツーマン」「億万長者」「大金持ち」「最短最速で」「１億」「１０億」「１００億」などの言葉にザワ付きを覚えた方は、是非見逃さず、参加を検討されることを強くお勧めします。<br />
                <br />
                特にあなたのような方にとって、このマンツーマン指導は…</div>

            <div class="up_arrow"><img src="img/up_arrow.png"></div>


        </div>
    </li>

    <li class="p9">
        <div class="content p9h">

            <div class="midashi1">あなたが本当に<br />
                求めていたものだと思うからです。</div>


            <div class="uptxt">
                というのも、先に、ちょっと想像してみて欲しい事があるのですが…<br />
                <br />
                まず、大前提として、私はいまだに機関投資家さんと繋がっており、<span class="wb">銀行や証券会社に招かれて、最近でも彼ら</span><span class="wbu">機関投資家さん向けに、運用の仕方のご指導をさせて頂いている身</span>。<br />
                <br />
                それどころか、普段から、<span class="col_blue wb">「ゲンちゃん、次はどんな銘柄が来そうかね？（上がりそうかね？）」</span>といった相談を、機関投資家さんから毎日のように受ける立場です。<br />
                <br />
                そして当然、<span class="wbu">私なりの回答を彼らに答え、そして彼らはその銘柄に投資したりしている</span>のです。<br />
                <br />
                それはどういうことなのか？<br />
                どういう<span class="wb">「重大な事」</span>を意味するのか？<br />
                <span class="wb">この状況が、どれほどとんでもない事なのか？</span><br />
                <br />
                つまり、</div>

        </div>
    </li>


    <li class="p8">
        <div class="content p8h">

            <div class="midashi1">あなたが私と繋がれるという凄さを<br />
                理由と共に洞察できるでしょうか？</div>


            <div class="uptxt">
                どうでしょう？<span class="wb">何で、それが凄い状況なのか？あなたは想像できますでしょうか？</span><br />
                <br />
                そこまでもったい付けて、聞いたわけですから、その答えをズバリ書きたいところ、なんですが…<br />
                <br />
                その答えは、やはり最後まであなたに察して頂きたいのです。<br />
                <br />
                というのも、そもそも、なぜこんなことを質問したかというと、これ以上は大人の事情でお話しできないからです。<br />
                <br />
                それでもなお、あなたに想像して欲しい事、<span class="wbu">私は機関投資家から日々、何を相談されて何を答えているのか？</span><br />
                <br />
                <span class="wbu">その答えを聞いた機関投資家は、どんな銘柄を買っているのか？</span><br />
                <br />
                それをイメージしてもらった上で、<span class="wb">そんなやり取りをしている私と、あなたは直接マンツーマンで、<br />
日々、情報交換ができる</span>この特別な状況をイメージして欲しいのです。<br />
                <br />
                その情景を思い浮かべるだけでも、あなたが得られる多大なるメリットは、容易に推測できるのではないでしょうか？<br />
                <br />
                特にあなたのような、直感の優れた方、洞察力の優れた方なら、私の言ってる重要性を、即座に推し量ることが出来るかもしれません。<br />
                <br />
                いずれにせよ、一つ明言できるのは、</div>

        </div>
    </li>

    <li class="p9">
        <div class="content p9h">


            <div class="midashi1">大きな成果をあげるような方は、この話や<br />
                この状況を聞いた瞬間に、秒で参加を決断していく</div>


            <div class="uptxt">
                という現実です。この事実からも、この凄さを推察して頂けると幸いです。<br />
                <br />
                なので今回も、<span class="wb">ピンときた方だけで大丈夫ですので、もし直感が働いたり、胸騒ぎがしたのでしたら、こちらのアップグレードも強く検討してみて下さい。</span><br />
                <br />
                特に私は今回、最終的に、<span class="wbu col_red">優秀な方をどんどんプロレベルに引き上げて行って最強集団を作りたい</span>と思っています。<br />
                <br />
                だからなおさら、<span class="wb">あなたのような優秀な方に、積極的にご参加頂きたい</span>のです。<br />
                <br />
                ただ、繰り返しますが、こちらは強制でも無いですし、押し売りするつもりもありませんのでご安心くださいね。通常の先乗り株カレッジでも、十分稼ぐことは出来ますので安心して下さい。<br />
                <br />
                しかしながら、私から直接マンツーマンの徹底指導を受ければ、誰よりも早く、大きく、<span class="wb">１億でも 2 億でも、さらには１０億、２０億、１００億を狙って行くことが可能なのは容易に想像つくと思います。</span><br />
                <br />
                ですので、それくらいのレベルを求めてらっしゃるのなら、参加を検討した方が良い、いや、<span class="wbu">参加するべきだ</span>と、最初に強く申し上げておきたいのです。<br />
                <br />
                特に見逃せないのは、
            </div>


        </div>
    </li>

    <li class="p8">
        <div class="content p8h">

            <div class="midashi1">
                今後の市場は、一発逆転の<br />
                チャンスだらけだから
            </div>


            <div class="uptxt">
                です。特に、今回のコロナで起こったような、株価大暴落からの大暴騰で、即座に最高な成果を上げたいと思ったら、<span class="wbu">マンツーマン指導に勝るものはありません。</span><br />
                <br />
                実際、今回のコロナ禍で、５０００万円を半年で、２０億円まで増やした生徒さんもいるくらいです。<br />
                <br />
                それくらいの、一発大逆転は、今からの市場でも十分あり得るから、だから、これだけ強く申し上げているという事も、深く推察してみて欲しいのです。<br />
                <br />
                正直申し上げて、今からの市場は、米国市場も含めて<span class="wbu">大チャンスでしか無い</span>と考えています。<br />
                <br />
                もちろん、調整の暴落なども入ったりもしますが、<span class="wb">大きくジャンプするためには、一旦大きくしゃがまなければならない</span>のも相場の常。<br />
                <br />
                そういう意味で、<span class="wbu">絶好の買い場</span><span class="wb">すらも、今後訪れると思っています。</span>ゆえに、<span class="wbu">資産を一気に大きく増やしたければ、今後は恐ろしい程のチャンスに溢れていると確信</span>しているのです。<br />
                <br />
                だからこそ、
            </div>


        </div>
    </li>


    <li class="p9">
        <div class="content p9h">

            <div class="midashi1">費用対効果で考えたら、<br />
                あまりに安すぎる投資</div>


            <div class="uptxt">
                だと断言すらできるのです。このマンツーマンの徹底指導は、<span class="wb col_red">先々の利益を考えれば「安すぎる先行投資」</span>。<br />
                <br />
                投資した金額以上に、もっと大きなリターンが見込める場合は、一気にそれに賭けるのも、投資家として間違いない決断だと思いませんでしょうか？<br />
                <br />
                そういう意味で、この<span class="wb">マンツーマン指導は参加費以上の、十分な効果は望めます</span>し、<span class="wb">今後の大チャンスばかりの市場を考えれば、なおさら有効な投資</span>だと、私は確信しているのです。<br />
                <br />
                ただし、その判断はもちろん、<span class="wbu">投資家であるあなた次第</span>です。<br />
                <br />
                ですので、<span class="wb col_red">後悔の無い賢明な決断を下すためにも、上の動画を十分にご覧になってみて欲しいのです。</span><span class="wb">とにかく後悔の無いように。</span><br />
                <br />
                そして、過去の大きな成果を出された生徒さんに、あなたも続いて欲しいと思います。<br />
                <br />
                その決断に際し、重要な真理とは
            </div>


        </div>
    </li>

    <li class="p8">
        <div class="content p8h">

            <div class="midashi1">成功は覚悟の<br />
                大きさに比例する</div>


            <div class="uptxt">
                という事です。もちろん、<span class="wb">「自分に出来るかなぁ？」</span>不安も心配も、あなたの気持ちは全部わかります。<br />
                <br />
                ですが、<span class="wb">過去の生徒さんも同様に、その不安を乗り越え、素晴らしい結果を出してくださっています。</span><br />
                <br />
                だから<span class="wbu">あなたに出来無い</span>はずが無いんです。出来る出来ないの問題では無くてやるかやらないかの問題でしか無いからです。<br />
                <br />
                それくらいの<span class="wb col_red">高い再現性とチャンスがある</span>という事です。<br />
                <br />
                だから、どうかあなたが、最高の決断を下せるよう導かれることを切に願うばかりです。<br />
                <br />
                その判断をするためにも、念のため今回のご提供内容をまとめます。
            </div>


        </div>
    </li>


    <li class="p10">
        <div class="content2 p10h">

            <div class="plan_list">
                <ul>
                    <li><div class="title_box"><div class="title">大岩川源太からの<span class="col_red">直接<br />
マンツーマン徹底指導</span></div><div class="subtitle">（個別で直通のチャット連携）</div></div></li>

                    <li><div class="title_box"><div class="title">回数無制限、<br />
                                大岩川源太との<span class="col_red">直接質疑、<br />
銘柄ディスカッション</span></div></div></li>

                    <li><div class="title_box"><div class="title">回数無制限、<span class="col_red">保有銘柄、<br />
資金配分</span>についての<br />
                                添削、指導</div></div></li>

                    <li><div class="title_box"><div class="title">先乗り株カレッジにも<br />
                                出せない、<span class="col_red">裏情報の数々</span></div></div></li>

                    <li><div class="title_box"><div class="title"><span class="col_red">機関投資家の動き</span>を、<br />
                                一緒に考察</div></div></li>

                    <li><div class="title_box"><div class="title"><span class="col_red">ポイントの日、トレンド<br />
転換日</span>を一緒に予測</div></div></li>

                    <li><div class="title_box"><div class="title">マンツーマン<br />
                                指導用の<span class="col_red">精鋭チーム<br />
チャット</span>にご招待</div></div></li>

                    <li><div class="title_box"><div class="title"><span class="col_red">裏技や秘儀を追加</span>で<br />
                                ご指導</div></div></li>

                    <li><div class="title_box"><div class="title"><span class="col_red">デイトレーダー</span>に<br />
                                なるための心得や、<br />
                                テクニック指導</div></div></li>

                    <li><div class="title_box"><div class="title">マンツーマン指導期間を<br />
                                <span class="col_red">１ヶ月間延長！</span><br />
                                （３ヶ月→<span class="col_red">４ヶ月間</span>）</div></div>
                        <div class="head_2"><div class="head_in">今だけ期間限定<br>
                                ボーナス延長中！</div></div>
                    </li>

                    <li><div class="title_box"><div class="title"><span class="col_red">今だけ<br />
消費税分お値引き！<br />
（期間限定）</span>
                            </div></div></li>

                </ul>
            </div>



        </div>
    </li>

    <li class="p8">
        <div class="content p8h">


            <div class="uptxt">
                以上は<span class="wb lth">３ヶ月間</span>（<span class="col_red wb">期間限定で４ヶ月間</span>） の提供で、人数限定です。<br />
                <br />
                私がもうこれ以上対応できないと成った時点で即、募集も終了します。しかも、私はもう年齢も年齢なので、<span class="wbu">今回のカレッジが最後の指導の場</span>になります。ゆえにこのマンツーマンすらも、もう二度と提供できなくなると思いますので、最後のチャンスとして、勇気を持って飛び込んできて欲しいのです。<br />
                <br />
                <span class="wb">飛び込んでしまえば、後は想像以上の喜びが待っているはず</span>ですから。<br />
                <br />
                そのかわり、私はこの指導を、ある意味命がけで行います。なぜなら、私にとって時間は命のように大切なもの。<span class="wb">時間さえあれば、いくらでもお金を生み出せる私にとって、その時間を捧げるのは命を捧げるのと同義。</span><br />
                <br />
                ゆえに、私は皆さんに対し命をかけて向き合うべく、あなたの成功のために真剣に対応します。その責任の重さを、私は今、真剣に受け止めています。<br />
                <br />
                そして、私と同じように命をかけてこれから成功していく事を願い、自分の夢や理想を叶えたり、周りの人たちを幸せにしてあげたいと想う…そんな気持ちを持った人だけに、このマンツーマン指導を受けてもらいたいのです。<br />
                <br />
                そして、<span class="wbu">あなたが幸せになり、その次に、ご家族をはじめ、あなたの本当に大切な人たちを絶対に幸せにしてあげて欲しい</span>のです。<br />
                <br />
                そのために、誰よりも最上の成果を出すためにも、私からのマンツーマン指導を活用してほしいと思います。<br />
                <br />
                あなたのような方こそ、私の一番弟子に成ってください。<span class="wb">あなた自身が最高の人生を歩み、あなたの大切な人たちを幸せにしていくことを、心から願っています。</span><br />
                <br />
                私と一番近い存在、最上級のマンツーマンという立場を活かし、あなたを筆頭に、私の仲間全員が大きく資産を築いて行けることを、心の底から楽しみにしています。<br />
                <br />
                あなたのアップグレード、楽しみにお待ちしております。
            </div>

        </div>
    </li>

    <li class="p11">
        <div class="content p11h">

            <div class="up_banner">



                <picture>
                    <source media="(min-width: 960px)" srcset="img/up_banner.png">
                    <img src="img/up_banner_sp.png">
                </picture>

            </div>



        </div>
    </li>

    <li class="p2">
        <div class="content2 p2h">
            <div class="p_box">


                <div class="white_box mt50 mb20">

                    <div class="wtitle">注文する商品</div>

                    <div class="com_list">
                        <ul>
                            <li class="pborder">
                                <div class="th">
                                    <img src="<?php echo $sub_img; ?>">
                                    </div><div class="title_set">
                                    <div class="title1"><?php echo $goods_name; ?></div>
                                    <div class="title2"><?php echo $g_desc; ?></div>
                                    <div class="title3"></div></div><div class="num"><?php
                                    echo number_format((int)$goods_price); ?><span>円</span></div></li>
                        </ul>
                        <div class="up_txt2">
                            １．大岩川源太からの直接マンツーマン徹底指導（個別で直通のチャット連携）<br />
                            ２．回数無制限、大岩川源太との直接質疑、銘柄ディスカッション<br />
                            ３．回数無制限、保有銘柄、資金配分についての添削、指導<br />
                            ４．先乗り株カレッジにも出せない、裏情報の数々<br />
                            ５．機関投資家の動きを、一緒に考察<br />
                            ６．ポイントの日、トレンド転換日を一緒に予測<br />
                            ７．マンツーマン指導用の精鋭チームチャットにご招待<br />
                            ８．裏技や秘儀を追加でご指導<br />
                            ９．デイトレーダーになるための心得や、テクニック指導<br />
                            １０．マンツーマン指導期間を１ヶ月間延長！！<span class="col_red">（期間限定）</span><br />
                            １１．今だけ消費税分お値引き！<span class="col_red">（期間限定）</span><br />
                        </div>
                    </div>

                </div>


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
                            <div class="form_e">
                                <input name="email" id="email" type="text" placeholder="メールアドレス" />
                                <p class="error-tip error-email">メールアドレスの形式が正しくありません。</p>
                            </div>

                            <!--<div class="sp form_e">
                                <div class="ftitle">お支払方法</div>
                                <div class="form_sp"><select name="card_sp">
                                        <option value="1">クレジットカード一括</option>
                                        <option value="0">銀行振込一括</option>
                                    </select></div>
                            </div>-->
                        </div>
                        <input type="hidden" name="product" value="<?php echo $goods_name; ?>" />
                        <input type="hidden" name="amount" value="<?php echo $goods_price; ?>" />
                        <input type="hidden" name="currency_code" value="JPY" />
                        <input type="hidden" name="shop_tracking" value="<?php echo $order; ?>" />
                        <!--                        <input type="hidden" name="callback_url" value="https://www.kabu-test.com/pay_callback.php" />-->
                        <input type="hidden" name="callback_url" value="<?php echo $callback_url; ?>" />
                        <input type="hidden" name="cancel_url" value="<?php echo $cancel_url; ?>" />
                        <!--                            <input type="text" name="email" value="test@example.com" />-->
                        <!--                            <input type="text" name="phone" value="08012341234" />-->
                        <!--                            <input type="text" name="tel" value="08012341234" />-->
                        <input type="hidden" name="shop_data1" value="" />
                        <input type="hidden" name="shop_data2" value="<?php echo $goods_id; ?>" />
                        <input type="hidden" name="shop_data3" value="" />

                        <input type="hidden" id="api_token" value="<?php echo BPM_CLIENT_IP; ?>">
                        <!--                            <button>submit</button>-->


                    </form>

                    <!--<div class="sp"><a href="javascript:void(0)" onclick="submit_sp()"><div class="sppbtn"><img src="img/spbtn.png"></div></a></div>-->

					<div class="sp">
					<div class="pbtn"><a href="javascript:void(0)" onclick="submit_card()"><img src="img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                    <div class="pbtn"><a href="javascript:void(0)" onclick="submit_bank()"><img src="img/b_btn.png"></a></div>
					</div>

<!--                    <div class="sp"><a href="#" onclick="submit_sp()"><div class="sppbtn"><img src="https://www.kabu-college.com/LP/pay-f-s/img/spbtn.png"></div></a>-->
<!--                        <div class="stxt" style="margin:0 0 5% 0">返金（返品）については-->
<!--                            <a href="https://www.kabu-college.com/LP/pay/tokusyo.html" target="_blank">こちら</a>をご確認ください。</div>-->
<!--                    </div>-->









                    <div class="white_box">

                        <div class="wtitle">支払い方法</div>

                        <div class="paylist">
                            <div class="ptitle">▶クレジットカード：一括のみ</div>
                            <ul>
                                <li><img src="img/e15.png"></li>
                                <li><img src="img/e16.png"></li>
                                <li><img src="img/e17.png"></li>

                            </ul>

                            <div class="ptitle">▶銀行振込：一括のみ</div>

                        </div>

                    </div>

                    <!--<div class="sp"><a href="javascript:void(0)" onclick="submit_sp()"><div class="sppbtn"><img src="img/spbtn.png"></div></a></div>-->

					<div class="sp">
					<div class="pbtn"><a href="javascript:void(0)" onclick="submit_card()"><img src="img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                    <div class="pbtn"><a href="javascript:void(0)" onclick="submit_bank()"><img src="img/b_btn.png"></a></div>
					</div>

                    <div class="ssl_box">
                        <ul>
                            <li>
                                <div class="stitle">安全のための取り組み</div>
                                <div class="stxt">お客様情報はSSL暗号化技術を利用して厳重に送信いたします。<br />
                                    また、ご入力いただいたカード情報はBPM株式会社に決済代行を委託しております。<br />
                                    当社では保存されませんのでご安心ください。転売など、当社が不都合と判断した場合は<br />
                                    ご購入をお断りさせていただくことがございます。予めご了承ください。</div>
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
                                <li>500,000円</li>

                            </ul>
                        </div>

                        <div class="cnum">
                            <ul>
                                <li>消費税</li>
                                <li>50,000円</li>

                            </ul>
                        </div>

                        <div class="cnum gborder">
                            <ul>

                                <li>値引き</li>
                                <li class="cred">-50,000円</li>
                            </ul>
                        </div>

                        <div class="cnum mb20">
                            <ul>

                                <li>ご請求額</li>
                                <li class="cred">500,000円</li>
                            </ul>
                        </div>

                        <div class="pbtn"><a href="javascript:void(0)" onclick="submit_card()"><img src="img/c_btn.png"></a></div>
                        <div class="ptxt">または</div>
                        <div class="pbtn"><a href="javascript:void(0)" onclick="submit_bank()"><img src="img/b_btn.png"></a></div>


                        <div class="ptxt">いずれかの決済方法を選んで<br />
                            ボタンを押してください</div>

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
<input type="hidden" name="type" class="info_type"/>
<input type="hidden" name="type" class="info_replay"/>



<script src="js/jquery-2.2.4.min.js"></script>
<script src="/LP/pay/js/bootstrap.min.js"></script>


<script>

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


<script src="js/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/css3-animate-it.js"></script>

<script src="js/aos.js"></script>
<script>
    AOS.init();
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

        // if (type == 1) {
        //     $('#pay').submit();
        //     return false;
        // }

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
                        // location.href = 'https://secure.telecomcredit.co.jp/inetcredit/secure/order.pl?clientip=75703&usrmail=' +
                        //     $('#email').val() + '&usrtel=' + $('#tel').val() + '&redirect_url='+redirect_url + '&money='+goods_price+'&sendid=' + data.id;
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
</script>



<script src="/LP/common/jquery.cookie.min.js"></script></body>
</html>

