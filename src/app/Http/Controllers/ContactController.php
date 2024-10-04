<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;    # リレーション用

class ContactController extends Controller
{

    public function index()     # 問い合わせ画面の表示
    {
        return view('index');
    }

    public function confirm(Request $request)   # 確認画面の表示
    {
        // 各部分の電話番号を取得して結合
        $tell = $request->input('phone_part1') . $request->input('phone_part2') . $request->input('phone_part3');

        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);
        $contact['tell'] = $tell;
        $contact['name'] = $contact['first_name'] . ' ' . $contact['last_name'];

        // genderの数字と名前の対応配列
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        $genderNum = $request->input('gender');       // POSTされたgender(数字)を取得
        $genderName = $genders[$genderNum] ?? '不明';     // 対応するカテゴリー名を取得

        // category_idに対応するcontentをリレーションを使って取得
        $categoryContent = Category::find($contact['category_id'])->content ?? '不明';

        return view('confirm', compact('contact', 'categoryContent', 'genderName'));
    }

    public function store(Request $request)     # 問い合わせ内容をcontactsテーブルに保尊
    {
        $contact = $request->only(['gender', 'email', 'address', 'building', 'category_id', 'tell', 'detail']);

        // 'name'を分割してfirst_nameとlast_nameを取得
        $nameParts = explode(' ', $request->input('name'), 2);
        $contact['first_name'] = $nameParts[0];
        $contact['last_name'] = isset($nameParts[1]) ? $nameParts[1] : '';

        Contact::create($contact);

        return view('thanks', compact('contact'));

    }

    public function admin(Request $request)
    {
        // $contacts = Contact::with('category')->get();    「Contact::all()」と「各Contactに関連するCategory」を取得
        $contacts = Contact::with('category')->paginate(7); // ページネーションを使用

        return view('admin', compact('contacts'));

    }


    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function search(Request $request)
    {
    $searchTerm = $request->input('search');
    $gender = $request->input('gender');
    $categoryId = $request->input('category_id');
    $dateSearch = $request->input('date_search');

    $contacts = Contact::where(function ($query) use ($searchTerm, $gender, $categoryId, $dateSearch) {
        // 検索文字列がある場合
        if (!empty($searchTerm)) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('first_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // genderが選択された場合
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        // category_idが選択された場合
        if (!empty($categoryId) && $categoryId !== 'all') {
            $query->where('category_id', $categoryId);
        }

        // date_searchがある場合
        if (!empty($dateSearch)) {
            $query->where(function ($query) use ($dateSearch) {
                $query->whereDate('created_at', $dateSearch)
                    ->orWhereDate('updated_at', $dateSearch);
            });
        }
    })->paginate(7)->appends([
        'search' => $searchTerm,
        'gender' => $gender,
        'category_id' => $categoryId,
        'date_search' => $dateSearch
    ]);

    return view('admin', compact('contacts'));
}



}
