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

        // gender属性を日本語に変換
        foreach ($contacts as $contact) {
            $contact->gender_label = $this->getGenderLabel($contact->gender);
        }

        return view('admin', compact('contacts'));

    }

    private function getGenderLabel($gender)
    {
        switch ($gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '不明';
        }
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

}
