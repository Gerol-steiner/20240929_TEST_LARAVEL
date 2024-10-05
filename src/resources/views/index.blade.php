<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>
            <form class="form" action="/confirm" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content first-item">
                        <div class="form__input--text">
                            <input type="text" name="first_name" placeholder="例: 山田" value="{{ old('first_name', session('first_name')) }}"/>
                        @if ($errors->has('first_name'))
                            @foreach ($errors->get('first_name') as $error)
                                <div class="error-message">{{ $error }}</div>
                            @endforeach
                        @endif
                        </div>
                        <div class="form__input--text">
                            <input type="text" name="last_name" placeholder="例: 太郎" value="{{ old('last_name', session('last_name')) }}"/>
                        @if ($errors->has('last_name'))
                            @foreach ($errors->get('last_name') as $error)
                                <div class="error-message">{{ $error }}</div>
                            @endforeach
                        @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__radio-container">
                            <div class="form__radio-option">
                                <!--デフォルトで選択状態-->
                                <input type="radio" id="gender-male" name="gender" value="1" {{ old('gender', session('gender', '1')) == '1' ? 'checked' : '' }}>
                                <label for="gender-male">男性</label>
                            </div>
                            <div class="form__radio-option">
                                <input type="radio" id="gender-male" name="gender" value="2" {{ old('gender', session('gender')) == '2' ? 'checked' : '' }}>
                                <label for="gender-female">女性</label>
                            </div>
                            <div class="form__radio-option">
                                <input type="radio" id="gender-male" name="gender" value="3" {{ old('gender', session('gender')) == '3' ? 'checked' : '' }}>
                                <label for="gender-other">その他</label>
                            </div>
                            @if ($errors->has('gender'))
                                @foreach ($errors->get('gender') as $error)
                                    <div class="error-message">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email', session('email')) }}"/>
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
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content fourth-item">
                        <div class="form__input--text">
                            <input type="tel" name="phone_part1" placeholder="080" maxlength="3" value="{{ old('phone_part1', session('phone_part1')) }}"/>
                            @if ($errors->has('phone_part1'))
                                @foreach ($errors->get('phone_part1') as $error)
                                    <div class="error-message">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <span class="separator"> - </span>
                        <div class="form__input--text">
                            <input type="tel" name="phone_part2" placeholder="1234" maxlength="4" value="{{ old('phone_part2', session('phone_part2')) }}"/>
                            @if ($errors->has('phone_part2'))
                                @foreach ($errors->get('phone_part2') as $error)
                                    <div class="error-message">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <span class="separator">-</span>
                        <div class="form__input--text">
                            <input type="tel" name="phone_part3" placeholder="5678" maxlength="4" value="{{ old('phone_part3', session('phone_part3')) }}"/>
                            @if ($errors->has('phone_part3'))
                                @foreach ($errors->get('phone_part3') as $error)
                                    <div class="error-message">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="name" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', session('address')) }}"/>
                            @if ($errors->has('address'))
                                @foreach ($errors->get('address') as $error)
                                    <div class="error-message">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="name" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building', session('building')) }}"/>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <select name="category_id" id="categorySelect"> <!---最下部のJavascriptとidで紐づけ-->
                                <option value="" class="default-option" disabled {{ old('category_id', session('category_id')) == '' ? 'selected' : '' }}>選択してください</option>
                                <option value="1" {{ old('category_id', session('category_id')) == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                                <option value="2" {{ old('category_id', session('category_id')) == '2' ? 'selected' : '' }}>商品の交換について</option>
                                <option value="3" {{ old('category_id', session('category_id')) == '3' ? 'selected' : '' }}>商品トラブル</option>
                                <option value="4" {{ old('category_id', session('category_id')) == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                                <option value="5" {{ old('category_id', session('category_id')) == '5' ? 'selected' : '' }}>その他</option>
                            </select>
                            @if ($errors->has('category_id'))
                                @foreach ($errors->get('category_id') as $error)
                                    <div class="error-message">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', session('detail')) }}</textarea>
                            @if ($errors->has('detail'))
                                @foreach ($errors->get('detail') as $error)
                                    <div class="error-message">{{ $error }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        const selectElement = document.getElementById('categorySelect');

        // 初期状態の色を設定
        selectElement.style.color = 'gray';

        selectElement.addEventListener('change', function() {
            if (this.value === "") {
                this.style.color = 'red';
            } else {
                this.style.color = '#8B7969'; //選択後の色
            }
        });
    </script>
</body>

</html>