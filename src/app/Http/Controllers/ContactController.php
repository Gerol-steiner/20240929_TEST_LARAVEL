<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest; // contactからcofirm呼び出し時のフォームリクエスト
use Illuminate\Support\Facades\Response;    # csvへエクスポートに使用（exportメソッド）

class ContactController extends Controller
{
    public function index()  // 問い合わせ画面の表示
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)  // 確認画面の表示
    {
        $tell = $request->input('phone_part1') . $request->input('phone_part2') . $request->input('phone_part3');

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['tell'] = $tell;
        $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];

        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        $genderNum = $request->input('gender');
        $genderName = $genders[$genderNum] ?? '不明';

        $categoryContent = Category::find($contact['category_id'])->content ?? '不明';

        return view('confirm', compact('contact', 'categoryContent', 'genderName'));
    }

    public function store(Request $request)  // 問い合わせ内容を保存
    {
        $contact = $request->only(['gender', 'email', 'address', 'building', 'category_id', 'tell', 'detail']);

        $nameParts = explode(' ', $request->input('name'), 2);
        $contact['first_name'] = $nameParts[0];
        $contact['last_name'] = isset($nameParts[1]) ? $nameParts[1] : '';

        Contact::create($contact);

        return view('thanks', compact('contact'));
    }

    public function admin(Request $request)     # contactsテーブルを7件ずつadmin画面に表示
    {
        $contacts = $this->buildSearchQuery($request)->paginate(7);
        return view('admin', compact('contacts'));
    }

    public function destroy(Request $request)   # admin画面モーダルウィンドウからcontactsを1件削除
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    // 共通の検索クエリを構築するメソッド
    public function buildSearchQuery(Request $request)
    {
        $query = Contact::with('category');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date_search')) {
            $query->whereDate('created_at', $request->date_search);
        }

        return $query;
    }

    public function search(Request $request)
    {
        $contacts = $this->buildSearchQuery($request)
            ->paginate(7)
            ->appends($request->query());  // ページネーションのリンクに検索条件を保持

        return view('admin', compact('contacts'));
    }

    public function export(Request $request)
    {
        $contacts = $this->buildSearchQuery($request)->get();

        // CSVデータの生成
        $csvData = "お名前,性別,メールアドレス,お問い合わせの種類\n";
        foreach ($contacts as $contact) {
            $csvData .= "{$contact->first_name} {$contact->last_name},{$contact->gender_label},{$contact->email},{$contact->category->content}\n";
        }

        // CSVファイル名
        $fileName = 'contacts_' . date('Ymd_His') . '.csv';

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
    }
}
