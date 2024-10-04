<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> <!-- モーダルウィンドウ用 -->
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
                        {{ $contacts->links() }} <!-- ページネーションリンクを表示 -->
                    </div>
                </div>

                <div class="admin__group">
                    <div>
                        <ul>
                            @foreach ($contacts as $contact)
                                <li>
                                    {{ $contact->first_name }} {{ $contact->last_name }} -
                                    {{ $contact->gender_label }} -
                                    {{ $contact->email }} -
                                    {{ $contact->category->content }}
                                    <!-- 詳細ボタン -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $contact->id }}">
                                        詳細
                                    </button>
                                </li>

                                <!-- モーダル -->
                                <div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $contact->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $contact->id }}"><!-- モーダル標題 --></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>名前</th>
                                                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>性別</th>
                                                            <td>{{ $contact->gender_label }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>メールアドレス</th>
                                                            <td>{{ $contact->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>電話番号</th>
                                                            <td>{{ $contact->tell }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>住所</th>
                                                            <td>{{ $contact->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>建物名</th>
                                                            <td>{{ $contact->building }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>お問い合わせの種類</th>
                                                            <td>{{ $contact->category->content }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>お問い合わせ内容</th>
                                                            <td>{{ $contact->detail }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <form class="delete-form" action="/delete" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $contact->id }}">
                                                    <button type="submit" class="btn btn-secondary">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </form>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
