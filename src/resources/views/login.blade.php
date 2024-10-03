<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <div class="register__button">
                <form action="/register" method="get">
                    @csrf
                    <button class="register__button-submit" type="submit">register</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Login</h2>
            </div>
            <form class="form" action="/admin" method="post">
                @csrf
                <div class="form__inner">

                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">メールアドレス</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="email" name="address" placeholder="例: test@example.com" />
                            </div>
                            <div class="form__error">
                                <!--バリデーション機能を実装したら記述します。-->
                            </div>
                        </div>
                    </div>

                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">パスワード</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="password" name="address" placeholder="例: coachtech1106" />
                            </div>
                            <div class="form__error">
                                <!--バリデーション機能を実装したら記述します。-->
                            </div>
                        </div>
                    </div>


                    <div class="form__button">
                        <button class="form__button-submit" type="submit">ログイン</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>