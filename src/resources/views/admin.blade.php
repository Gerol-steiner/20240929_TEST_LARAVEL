<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
        <a class="header__logo" href="/">
            FashionablyLate
        </a>
                    <div class="logout__button">
                <form action="/logout" method="post">
                    @csrf
                    <button class="logout__button-submit" type="submit">logout</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        <div class="thanks__content">
            <div class="thanks__heading">
                <h2>Admin</h2>
            </div>

            <form class="form" action="/xxxx" method="xxx">
                @csrf

                <div class="admin__group">
                    <div>
                        <button>エクスポート</button>
                    </div>
                    <div>
                    {{ $contacts->links() }}    <!-- ページネーションリンクを表示 -->
                    </div>
                </div>

                <div class="admin__group">
                    <div>
                        <ul>
                        @foreach ($contacts as $contact)
                            <li>{{ $contact->first_name }}  {{ $contact->last_name }} -
                                {{ $contact->gender_label }} -
                                {{ $contact->email }} -
                                {{  $contact->category->content }}
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>

            </form>
        </div>
    </main>
</body>

</html>