<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
        <a class="header__logo" href="/">
            FashionablyLate
        </a>
        </div>
    </header>

    <main>
        <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>

        <!--▼idでscriptのgoBack関数と紐づける-->
        <form class="form" action="/contacts" method="post" id="contactForm">
            @csrf
            <!--本ビューでは使わないが、indexに戻った時用に保存-->
            <input type="hidden" name="first_name" value="{{ old('first_name', $contact['first_name']) }}">
            <input type="hidden" name="last_name" value="{{ old('last_name', $contact['last_name']) }}">
            <input type="hidden" name="phone_part1" value="{{ old('phone_part1', $contact['phone_part1']) }}">
            <input type="hidden" name="phone_part2" value="{{ old('phone_part2', $contact['phone_part2']) }}">
            <input type="hidden" name="phone_part3" value="{{ old('phone_part3', $contact['phone_part3']) }}">
            <input type="hidden" name="building" value="{{ old('building', $contact['building']) }}">
            <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" name="name" value="{{ $contact['name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}"/>   <!--表示しない-->
                        <input type="text" value="{{ $genderName }}" readonly />    <!--nameを消してpost対象から除外-->
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="text" name="tell" value="{{ $contact['tell'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}"/>     <!--表示しない-->
                        <input type="text" value="{{ $categoryContent }}" readonly />     <!--nameを消してpost対象から除外-->
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                    </td>
                </tr>
            </table>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
                <button class="form__button-back" type="button" onclick="goBack()">修正</button> <!-- 修正ボタンにクリックイベント追加 -->
            </div>
        </form>
        </div>
    </main>

    <script>
        function goBack() {
            const form = document.getElementById('contactForm');
            form.action = '/back'; // /gobackにactionを変更
            form.method = 'post'; // methodをpostに設定
            form.submit(); // フォームを送信
        }
    </script>

    </body>

</html>