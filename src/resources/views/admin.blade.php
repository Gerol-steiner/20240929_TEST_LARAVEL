<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
        <a class="header__logo" href="/">
            Contact Form
        </a>
        </div>
    </header>

    <main>
        <div class="thanks__content">
            <div class="thanks__heading">
                <h2>お問い合わせありがとうございます</h2>

                <ul>
        @foreach ($contacts as $contact)
            <li>{{ $contact->name }} - {{ $contact->gender }} - {{ $contact->email }}</li>
        @endforeach
                </ul>

            </div>
            <form class="thanks__form" action="/" method="get">
                <div class="thanks__button">
                    <button type="submit">Home</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>