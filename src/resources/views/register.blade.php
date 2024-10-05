<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <div class="login__button">
                <form action="/login" method="get">
                    @csrf
                    <button class="login__button-submit" type="submit">login</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Register</h2>
            </div>
            <form class="form" action="/register" method="post">
                @csrf
                <div class="form__inner">
                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">お名前</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="text" name="name" placeholder="例: 山田 太郎" />
                                @if ($errors->has('name'))
                                    @foreach ($errors->get('name') as $error)
                                        <div class="error-message">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">メールアドレス</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="email" name="email" placeholder="例: test@example.com" />
                                @if ($errors->has('email'))
                                    @foreach ($errors->get('email') as $error)
                                        <div class="error-message">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">パスワード</span>
                        </div>
                        <div class="form__group-content">
                            <div class="form__input--text">
                                <input type="password" name="password" placeholder="例: coachtech1106" />
                                @if ($errors->has('password'))
                                    @foreach ($errors->get('password') as $error)
                                        <div class="error-message">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form__button">
                        <button class="form__button-submit" type="submit">登録</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>