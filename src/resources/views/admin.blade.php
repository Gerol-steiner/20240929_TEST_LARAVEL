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
                <h3>Admin</h3>
            </div>

            <div class="admin__group">
                <form class="form__search" action="/search" method="GET">
                    <div class="form__search-text">
                        <!-- 検索条件を保持 -->
                        <input type="text" name="search" placeholder="名前やメールアドレスを入力してください" class="form__search-text-input" value="{{ request('search') }}" />
                    </div>
                    <div class="form__search-select">
                        <select name="gender" class="form__search-select">
                            <!-- 「性別」オプション -->
                            <option value="" disabled {{ is_null(request('gender')) ? 'selected' : '' }}>性別</option>
                            <!-- 「すべて」オプション -->
                            <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>すべて</option>
                            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                    <div class="form__search-select">
                        <select name="category_id" class="form__search-select">
                            <option value="" disabled {{ is_null(request('category_id')) ? 'selected' : '' }}>お問い合わせの種類</option>
                            <option value="all" {{ request('category_id') === 'all' ? 'selected' : '' }}>すべて</option>
                            <option value="1" {{ request('category_id') == '1' ? 'selected' : '' }}>商品のお届けについて</option>
                            <option value="2" {{ request('category_id') == '2' ? 'selected' : '' }}>商品の交換について</option>
                            <option value="3" {{ request('category_id') == '3' ? 'selected' : '' }}>商品トラブル</option>
                            <option value="4" {{ request('category_id') == '4' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                            <option value="5" {{ request('category_id') == '5' ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                    <div class="form__search-date"> <!-- 検索条件を保持 -->
                        <input type="date" name="date_search" class="form__search-date-input" value="{{ request('date_search') }}" />
                    </div>
                    <div class="form__search-button">
                        <button type="submit" class="btn btn-primary">検索</button>
                        <a href="/admin" class="btn btn-secondary">リセット</a>
                    </div>
                </form>
            </div>

            <div class="admin__group">
                <div>
                    <a href="{{ route('export', request()->query()) }}" class="btn btn-tertiary">エクスポート</a>
                </div>
                <div>
                    {{ $contacts->links() }} <!-- ページネーションリンクを表示 -->
                </div>
            </div>

    <div class="admin__group-table">
        <table class="table">   <!-- class名の変更は注意 -->
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
@foreach ($contacts as $contact)
    <tr>
        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
        <td>{{ $contact->gender_label }}</td>
        <td>{{ $contact->email }}</td>
        <td>{{ $contact->category->content }}</td>
        <td>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $contact->id }}">
                詳細
            </button>
        </td>
    </tr>

    <!-- モーダル -->
    <div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $contact->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel{{ $contact->id }}"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body__attribute">
                        <p>お名前</p>
                        <p>性別</p>
                        <p>メールアドレス</p>
                        <p>電話番号</p>
                        <p>住所</p>
                        <p>建物名</p>
                        <p>お問い合わせの種類</p>
                        <p>お問い合わせ内容</p>
                    </div>
                    <div class="modal-body__content">
                        <p>{{ $contact->first_name }} {{ $contact->last_name }}</p>
                        <p>{{ $contact->gender_label }}</p>
                        <p>{{ $contact->tell }}</p>
                        <p>{{ $contact->address }}</p>
                        <p>{{ $contact->building }}</p>
                        <p>{{ $contact->email }}</p>
                        <p>{{ $contact->category->content }}</p>
                        <p>{{ $contact->detail }}</p>
                    </div>
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
            </tbody>
        </table>
    </div>


        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
